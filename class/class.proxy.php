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
		
		$currentTime 	= time();
		$fingerprint 	= $this->serializeRequest($param);

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