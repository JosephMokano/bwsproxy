<?php
/*
 * Vlabs Biological Web Services Proxy
 *
 * Copyright (c) 2009 Victor de la Torre (vdelatorre@cnio.es)
 * Dual licensed under the MIT (MIT-LICENSE.txt)
 * and GPL (GPL-LICENSE.txt) licenses.
 * 
 * http://code.google.com/p/bwsproxy/
 *
 */

 class Proxy {
  
 	public $error 			= 0;
 	public $rowResponse		= ''; 
 	public $jsonResponse	= '';
 	
 	/**
	 * parseRestUrl function.
	 * 
	 * @access public
	 * @param mixed $param
	 * @return void
	 */
	function _parseUrl($param){
		  		
  		$url = $param['bwsp_url'];
		
		if (!$url)
			return false;
		
		$u = parse_url($url);
		
  		return $u;
	}
 	
 	/**
 	 * serializeRequest function.
 	 * 
 	 * @access public
 	 * @param mixed $request
 	 * @return void
 	 */
 	function _serializeRequest($request){

		 $fingerprint = '';
		 foreach ($request as $k=>$v){
			 
			 if (preg_match('/bwsp_url/',$k) or preg_match('/bwsp_service/',$k))
			  	$fingerprint .= base64_encode($k.$v);
 	
		 }
		 return md5($fingerprint); 	
  	}
  	
  	
  	/**
  	 * getServiceType function.
  	 * 
  	 * @access public
  	 * @param mixed $param
  	 * @return void
  	 */
  	function getServiceType($param){
	
		global $db;
		if (!$u = $this->_parseUrl($param))
			return false;	
			
		$name 	= $param['bwsp_service'];
		$host	= $u['host'];
		
		if (!$name or !$host)
			return false;	

		$strSQL = "SELECT t.type FROM services s, types t WHERE s.typeid=t.typeid AND s.name='".$name."' AND s.host='".$host."'";
		$row = $db->get_row($strSQL);
		return $row->type;

  	}

  	
  	/**
  	 * getServiceCache function.
  	 * 
  	 * @access public
  	 * @param mixed $param
  	 * @return void
  	 */
  	function getServiceCache($param){
	
		if ($param['bwsp_force_no_cache'])
			return false;
	
		global $db;
		if (!$u = $this->_parseUrl($param))
			return false;	
			
		$name 	= $param['bwsp_service'];
		$host	= $u['host'];
		
		if (!$name or !$host)
			return false;	

		$strSQL = "SELECT s.cache FROM services s WHERE s.name='".$name."' AND s.host='".$host."'";
		$row = $db->get_row($strSQL);
		return $row->cache;

  	}

	/**
  	 * getMaxTime function.
  	 * 
  	 * @access public
  	 * @param mixed $mode
  	 * @return void
  	 */
  	function getMaxTime($currentTime,$mode){
  		
  		switch ($mode){
			
			case 0:
				$maxTime = 0;											//no cache
				break;													
			case 1:
				$maxTime = $currentTime - (60*60);						//1 hour
				break;
			
			case 2:
				$maxTime = $currentTime - (24*60*60);					//1 day
				break;
				
			case 3:
				$maxTime = $currentTime - (7*24*60*60);					//1 week
				break;
			
			case 4:
				$maxTime = $currentTime - (30*24*60*60);				//1 month
				break;	
				
			case 5:
				$maxTime = $currentTime - (365*24*60*60);				//1 year
				break;	
								
		}
		return $maxTime;
  	}

  	
  	/**
	 * _saveService function.
	 * 
	 * @access private
	 * @param mixed $param
	 * @return void
	 */
	function _saveService($param){
	
		global $db;
		if (!$u = $this->_parseUrl($param))
			return false;	
			
		$name 	= $param['bwsp_service'];
		$host	= $u['host'];
		
		if (!$name or !$host)
			return false;	
		
		$strSQL	= "INSERT IGNORE INTO services SET name='".$name."',host='".$host."',cache=0";
		$db->query($strSQL);

		if ($db->getLastId())
			return $db->getLastId();
		else{
			$strSQL = "SELECT serviceid FROM services WHERE name='".$name."' AND host='".$host."'";
			$row = $db->get_row($strSQL);
			return $row->serviceid;
		}	
  	}
  	
  	/**
  	 * _saveQuery function.
  	 * 
  	 * @access private
  	 * @param mixed $param
  	 * @param mixed $service
  	 * @return void
  	 */
  	function _saveQuery($param,$service){
	
		global $db;

		$currentTime 	= time();
		$fingerprint 	= $this->_serializeRequest($param);
		
		$strSQL = "DELETE FROM queries WHERE fingerprint='".$fingerprint."'";
		$db->query($strSQL);
		
		if ($this->getServiceCache($param)){
			$strSQL = "INSERT INTO queries SET serviceid=".$service.", fingerprint='".$fingerprint."', row='".base64_encode($this->rowResponse)."', json='".base64_encode($this->jsonResponse)."', unixtime=".$currentTime;
		$db->query($strSQL);
		}
  	}

  
 	/**
 	 * saveCache function.
 	 * 
 	 * @access public
 	 * @param mixed $param
 	 * @param mixed $mode
 	 * @return void
 	 */
 	function saveCache($param){
		
		global $db;
		if($service = $this->_saveService($param)){
			$this->_saveQuery($param,$service);
		}	
		
  	}
  	
  	/**
  	 * getCache function.
  	 * 
  	 * @access public
  	 * @param mixed $param
  	 * @return void
  	 */
  	function getCache($param){
  	
  		global $db;
		
		if (!$this->getServiceCache($param))
			return false;
			
		$currentTime 	= time();
		$fingerprint 	= $this->_serializeRequest($param);

		$strSQL = "SELECT * FROM services s, queries q WHERE s.serviceid=q.serviceid AND q.fingerprint='".$fingerprint."'";
		
		$r = $db->get_row($strSQL);
		
		if ($r){
			
			if ($r->cache == 0)
				return false;
		
			if ($r->unixtime >= $this->getMaxTime($currentTime,$r->cache)){
				
				$this->rowResponse = base64_decode($r->row);
				$this->jsonResponse =  base64_decode($r->json);
				return true;
			}
		}
		return false;
  	}
  	
  	
  	/**
  	 * callService function.
  	 * 
  	 * @access public
  	 * @param mixed $param
  	 * @return void
  	 */
  	function callService($param){
  	
  		if (!$this->getCache($param)){
  			$this->getServiceResponse($param);
  			$this->saveCache($param);
  		}
  		return true;
  	
  	}
  	
  	/**
  	 * printResponse function.
  	 * 
  	 * @access public
  	 * @param mixed $format
  	 * @param mixed $callback
  	 * @return void
  	 */
  	function printResponse($format,$callback){
  		
  		
  		if ($format == 'row')
  			echo $this->rowResponse; 
  		else if ($format == 'json'){
  			//header('Content-type: application/json');
  			if ($callback)
  				echo $callback.'('.$this->jsonResponse.');';
  			else
  				echo $this->jsonResponse;	
  		}	
  	}
 	
 }

?>