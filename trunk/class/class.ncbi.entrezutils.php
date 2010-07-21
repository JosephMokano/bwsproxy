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
  		
 	}
 	
 	/**
 	 * setParameters function.
 	 * 
 	 * @access public
 	 * @param mixed $param
 	 * @return void
 	 */
 	function setParameters($param){
 		
 		$p=$this->getParameters($param);
 		
 		$service    = ($p['service'])?$p['service']:'eSearch';
 		
 		$soapParameters = array();
 		if ($p['db'])
 			$soapParameters['db'] = $p['db'];
 		if ($p['id'])
 			$soapParameters['id'] = $p['id'];	
		if ($p['term'])
		    $soapParameters['term'] = $p['term'];
		if ($p['reldate'])
		    $soapParameters['reldate'] = $p['reldate'];
		if ($p['retstart'])
		    $soapParameters['retstart'] = $p['retstart'];
		if ($p['retmax'])
		    $soapParameters['retmax'] = $p['retmax'];        
		if ($p['datetype'])
		    $soapParameters['datetype'] = $p['datetype']; 
		if ($p['usehistory'])
		    $soapParameters['usehistory'] = $p['usehistory']; 
		if ($p['tool'])
		    $soapParameters['tool'] = $p['tool']; 

 		$this->parameters = $soapParameters;
 		return $p;
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
 	
 	 function runeFetch(){

		$res 	= $this->client->run_eFetch($this->parameters);
		
		
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
 	 	 	
 	 	
 	 	if ($p = $this->setParameters($param)){
 	 	
	 	 	if ($p['db'] == 'pubmed')
	 	 		$this->client = new SoapClient('http://www.ncbi.nlm.nih.gov/entrez/eutils/soap/v2.0/efetch_pubmed.wsdl'); 
	 	 	else
	 	 		$this->client = new SoapClient('http://www.ncbi.nlm.nih.gov/entrez/eutils/soap/v2.0/eutils.wsdl');
 	 	
 	 		switch ($p['service']){
 	 			case 'eSearch':
 	 				$content = $this->runeSearch();
 	 				break;	
 	 			case 'eFetch':
 	 				$content = $this->runeFetch();
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