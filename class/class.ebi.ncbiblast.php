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
 
 class EbiNCBIblast extends Rest{
 
 	public $client;
 	public $parameters;
 	public $data;
 	
 	public $jobId;
 	public $jobStatus;
 	
 	
 	function _parseUrl($param){
		  		
  		$url = str_replace(',','&',$param['bwsp_url']);

		if (!$url)
			return false;
		
		$u = parse_url($url);
		
  		return $u;
	}  
	
	function runBlast($param){
		
		if (!$u = $this->_parseUrl($param))
			return false;	
			
		$u['path'] .= 'run/';		
		
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
		    
		    $content.= $line;  

 	    } while(true);
 	    
 	    $tmp = split("\r\n\r\n",$content);
 	    
		fclose($fp);
		
		if (!$tmp[1])
			return false;
			
		$this->jobId = $this->_clearExceptions($tmp[1]);
	}
	
	function getStatus($param){
		
		if (!$u = $this->_parseUrl($param))
			return false;	
			
		$u['path'] .= 'status/'.$this->jobId;	
		
		$buf = $this->_buildGET($u);
		
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
		    
		    $content.= $line;  

 	    } while(true);
 	    
 	    $tmp = split("\r\n\r\n",$content);
 	    
		fclose($fp);
		
		if (!$tmp[1])
			return false;
			
		$this->jobStatus 	= 	$this->_clearExceptions($tmp[1]);
 	}

	
	
	
	function getResults($param){
		
		if (!$u = $this->_parseUrl($param))
			return false;	
			
		$u['path'] .= 'result/'.$this->jobId.'/xml';	
		
		$buf = $this->_buildGET($u);
		
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
		    
		    $content.= $line;  

 	    } while(true);
 	    
 	    $tmp = split("\r\n\r\n",$content);
 	    
		fclose($fp);
		
		if (!$tmp[1])
			return false;
			
		$this->rawResponse 	= 	$this->_clearExceptions($tmp[1]);
		return true;	
			
 	}
	
	
	function getServiceResponse($param){

		$this->runBlast($param);
		
		if ($this->jobId){
			//echo $this->jobId.'<br>'; 
			$this->getStatus($param);
			while (preg_match('/RUNNING/',$this->jobStatus)){
				$this->getStatus($param);
				sleep(5);
			} 
			$this->getResults($param);
		}
		
		return true;
	}
 	
  }
 ?>