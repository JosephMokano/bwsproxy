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
 
 class Whatizit extends Proxy{
 
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
 	 
 		$service    = ($p['service'])?$p['service']:'queryPmid';
 		
 		$soapParameters = array();
 		if ($p['pipelineName'])
 			$soapParameters['pipelineName'] = $p['pipelineName'];
 		if ($p['pmid'])
 			$soapParameters['pmid'] = $p['pmid'];
 		if ($p['text'])
 			$soapParameters['text'] = $p['text'];
 		if ($p['convertToHtml'])
 			$soapParameters['convertToHtml'] = $p['convertToHtml'];			

 		$this->parameters = $soapParameters;
 
 		return $p;
 	}
 	
 	/**
 	 * runeSearch function.
 	 * 
 	 * @access public
 	 * @return void
 	 */
 	function runQueryPmid(){
		
		try{ 	
			$res 	= $this->client->queryPmid($this->parameters);
		
		}catch(Exception $e) {
			return '<error>'.$e->getMessage().'</error>';
		}
		$oxml = new xmlserialize ($res);
		$oxml->getProps(); 
		$resxml = $oxml->varsToXml(); 
	 	return $resxml;
 	}
 	
 	function runContact(){

		try{ 
			$res 	= $this->client->contact($this->parameters);
		
		}catch(Exception $e) {
			return '<error>'.$e->getMessage().'</error>';
		}
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
 	 	 	
 	 	 $this->client = new SoapClient($param['bwsp_url']); 
 	 	  	
 	 	if ($p = $this->setParameters($param)){
 	 		switch ($p['service']){
 	 			case 'queryPmid':
 	 				$content = $this->runQueryPmid();
 	 				break;
 	 			case 'contact':
 	 				$content = $this->runContact();
 	 				break;		
 	 		}
 	 		
 	 		if ($content){
 	 			$this->rawResponse 	= $content;
				$this->jsonResponse = xml2json::transformXmlStringToJson($this->rawResponse);
				return true;
			}else{
				return false;
			}
	 	}else
	 		return false;		
 	}
 }
?>