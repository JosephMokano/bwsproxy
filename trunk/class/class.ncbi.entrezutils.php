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
 
 class EntrezUtils extends Proxy{
 
 	public $client;
 	public $parameters;
 	public $data;
 	
 	/**
 	 * __construct function.
 	 * 
 	 * @access private
 	 * @return void
 	 */
 	function __construct(){
  		 $this->client = new SoapClient('http://www.ncbi.nlm.nih.gov/entrez/eutils/soap/v2.0/eutils.wsdl');
 	}
 	
 	/**
 	 * setParameters function.
 	 * 
 	 * @access public
 	 * @param mixed $param
 	 * @return void
 	 */
 	function setParameters($param){
 	 
 		$service    = ($param['service'])?$param['service']:'eSearch';
 		
 		$soapParameters = array();
 		if ($param['db'])
 			$soapParameters['db'] = $param['db'];
		if ($param['term'])
		    $soapParameters['term'] = $param['term'];
		if ($param['reldate'])
		    $soapParameters['reldate'] = $param['reldate'];
		if ($param['retstart'])
		    $soapParameters['retstart'] = $param['retstart'];
		if ($param['retmax'])
		    $soapParameters['retmax'] = $param['retmax'];        
		if ($param['datetype'])
		    $soapParameters['datetype'] = $param['datetype']; 
		if ($param['usehistory'])
		    $soapParameters['usehistory'] = $param['usehistory']; 
		if ($param['tool'])
		    $soapParameters['tool'] = $param['tool']; 

 		$this->parameters = $soapParameters;
 		return true;
 	}
 	
 	/**
 	 * runeSearch function.
 	 * 
 	 * @access public
 	 * @return void
 	 */
 	function runeSearch(){

		$res 	= $this->client->run_eSearch($this->parameters);
		
		
/*
		print "Request: \n".
		htmlspecialchars($this->client->__getLastRequestHeaders()) ."\n";
		print "Request: \n".
		htmlspecialchars($this->client->__getLastRequest()) ."\n";
		print "Response: \n".
		$this->client->__getLastResponseHeaders()."\n";
		print "Response: \n".
		$this->client->__getLastResponse()."\n"; 
*/
		
		
		$oxml = new xmlserialize ($res);
		$oxml->getProps(); 
		$resxml = $oxml->varsToXml(); 
 		return $resxml;
 	}
 	
 	/**
 	 * getServiceResponse function.
 	 * 
 	 * @access public
 	 * @param mixed $param
 	 * @return void
 	 */
 	function getServiceResponse($param){
 	 	 	
 	 	 	
 	 	if ($this->setParameters($param)){
 	 		switch ($param['service']){
 	 			case 'eSearch':
 	 				$content = $this->runeSearch();
 	 				break;		
 	 		}
 	 		
 	 		$this->rawResponse 	= $content;
			$this->jsonResponse = xml2json::transformXmlStringToJson($this->rawResponse);
			return true;
 	 		
	 	}else
	 		return false;		
 	}
 }
?>