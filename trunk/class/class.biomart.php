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
 
 class Biomart extends Rest{
    
	
 	function _parseUrl($param){

		$url = $param['bwsp_url'];

		if (!$url)
			return false;
		
		$u = parse_url($url);
		
		if ($u['query'])
			$u['query'] = str_replace('\\','',$u['query'])."\n";
		
			
  		return $u;
	}  
	
	function getServiceResponse($param){

		if (!$u = $this->_parseUrl($param))
			return false;	
		
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
		    
		    //echo $line.'<br>';
		    //handle redirections
		    if (stristr($line,"location:")!="") {
			    $redirect=preg_replace("/location:/i","",$line);
			    $redirect = trim($redirect);
			    $param['bwsp_url'] = $redirect;
			    $this->getServiceResponse($param);
			    return;
			}
		    
		    
		    if ($line === false)
		       break;  
		    
		    $content.= $line;  

 	    } while(true);
 	    
 	    $tmp = split("\r\n\r\n",$content);
 	    
		fclose($fp);
		
		if (!$tmp[1])
			return false;
			
		$this->rawResponse 	= $this->_clearExceptions($tmp[1]);
		return true;
	}
 
 }	
?>