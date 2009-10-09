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
     * getServiceResponse function.
     * 
     * @access public
     * @param mixed $param
     * @return void
     */
    function getServiceResponse($param){

		if (!$u = $this->_parseUrl($param))
			return false;	
		
		//force GET DAS request for the uniprot DAS
		if (preg_match('/\/das\/uniprot/',$param['bwsp_url']) or preg_match('/partsregistry.org\/das/',$param['bwsp_url']) or preg_match('/madas/',$param['bwsp_url'])  or preg_match('/ws.bioinfo.cnio.es/',$param['bwsp_url']))
			$buf = $this->_buildGET($u);
		else
			$buf = $this->_buildPOST($u);
		
		$fp = @fsockopen ($u['host'], 80);
		stream_set_timeout($fp, 100);
	
		if (!$fp)
			return false;
		fputs($fp, $buf);

		$content = "";
		$start = false;
	    do {
		    $line = fgets($fp);
		    if ($line === false)
		       break;  
		    if (preg_match('/xml/',$line))
		    	$start = true;   
		    if ($start and (preg_match('/^ /',$line) or preg_match('/^</',$line) or preg_match('/>/',$line) or strlen($line) >40) ){
		    	if (!preg_match('/^</',$line))
		    		$content = trim($content);
		    	$content.= $line;   	
		    }   
		    $first = false;	
 	    } while(true);
		fclose($fp);
		
		if (!$content)
			return false;

		$this->rowResponse 	= $content;
		$this->jsonResponse = str_replace('@attributes','attributes',xml2json::transformXmlStringToJson($this->rowResponse));
		return true;
	}

 
	/**
	 * buildPOST function.
	 * 
	 * @access public
	 * @param mixed $u
	 * @return void
	 */
	function _buildPOST($u){
		
		$buf  = "POST ".$u['path']." HTTP/1.0\r\n";
		$buf .= "Host: ".$u['host']."\r\n";
		$buf .= "Content-type: application/x-www-form-urlencoded; charset=UTF-8\r\n";
		$buf .= "Content-length: ".strlen($u['query'])."\r\n";
		$buf .= "\r\n";
		$buf .= $u['query'];
		return $buf;
	}
	
	/**
	 * buildGET function.
	 * 
	 * @access public
	 * @param mixed $u
	 * @return void
	 */
	function _buildGET($u){
		
		$buf  = "GET ".$u['path'].'?'.$u['query']." HTTP/1.1\r\n";
		$buf .= "Host: ".$u['host']."\r\n";
		$buf .= "Connection: Close\r\n\r\n";
		//echo $buf;
		return $buf;

	}
}	
?>