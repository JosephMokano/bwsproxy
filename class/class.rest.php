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
 
 class Rest extends Proxy{
    
	
	/**
	 * parseRestUrl function.
	 * 
	 * @access public
	 * @param mixed $param
	 * @return void
	 */
	function parseRestUrl($param){
		  		
  		$url = $param['bwsp_rest'];
		
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
 	function serializeRequest($request){

		 $fingerprint = '';
		 foreach ($request as $k=>$v){
			 
			 if (preg_match('/bwsp_rest/',$k))
			  	$fingerprint .= base64_encode($k.$v);
 	
		 }
		 return md5($fingerprint); 	
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
		if (!$u = $this->parseRestUrl($param))
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
		$fingerprint 	= $this->serializeRequest($param);
		
		$strSQL = "DELETE FROM queries WHERE fingerprint='".$fingerprint."'";
		$db->query($strSQL);
		
		$strSQL = "INSERT INTO queries SET serviceid=".$service.", fingerprint='".$fingerprint."', row='".base64_encode($this->rowResponse)."', json='".base64_encode($this->jsonResponse)."', unixtime=".$currentTime;
		$db->query($strSQL);
  	}


    /**
     * getServiceResponse function.
     * 
     * @access public
     * @param mixed $param
     * @return void
     */
    function getServiceResponse($param){
	
		if (!$u = $this->parseRestUrl($param))
			return false;	
		
		//force GET DAS request for the uniprot DAS
		if (preg_match('/\/das\/uniprot/',$param['bwsp_rest']))
			$buf = $this->buildGET($u);
		else
			$buf = $this->buildPOST($u);
		
		$fp = @fsockopen ($u['host'], 80);
	
		if (!$fp)
			return false;

		fputs($fp, $buf);
		$buf ="";
		while (!feof($fp))
			$buf .=@fgets($fp,128);
		fclose($fp);
				
		if (!$buf)
			return false;

		// split the result header from the content
		$result = explode("\r\n\r\n", $buf, 2);
		$header = isset($result[0]) ? $result[0] : '';
		$content = isset($result[1]) ? $result[1] : '';
			
		if (!$content)
			return false;

		$this->rowResponse 	= $content;
		$this->jsonResponse = xml2json::transformXmlStringToJson($this->rowResponse);
		return true;
	}

 
	/**
	 * buildPOST function.
	 * 
	 * @access public
	 * @param mixed $u
	 * @return void
	 */
	function buildPOST($u){
		
		$buf ="POST ".$u['path']." HTTP/1.0\r\n";
		$buf .="Host: ".$u['host']."\r\n";
		$buf .="Content-type: application/x-www-form-urlencoded; charset=UTF-8\r\n";
		$buf .="Content-length: ".strlen($u['query'])."\r\n";
		$buf .="\r\n";
		$buf .=$u['query'];
		
		return $buf;
	}
	
	/**
	 * buildGET function.
	 * 
	 * @access public
	 * @param mixed $u
	 * @return void
	 */
	function buildGET($u){
		
		$buf ="GET ".$u['path']."?".$u['query']." HTTP/1.0\r\n";
		$buf .="Host: ".$u['host']."\r\n";
		$buf .="Content-type: application/x-www-form-urlencoded; charset=UTF-8\r\n";
		$buf .="Content-length: ".strlen($u['query'])."\r\n";
		$buf .="\r\n";
		$buf .=$u['query'];

		return $buf;
	}
}	
?>