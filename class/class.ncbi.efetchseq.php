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
 
 class EfetchSeq extends Proxy{
 
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
 	
  		 $this->client = new SoapClient('http://www.ncbi.nlm.nih.gov/entrez/eutils/soap/v2.0/efetch_seq.wsdl');
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
 	 
 		$db 		= ($p['db'])?$p['db']:'genome';
 		$id		    = ($p['id'])?$p['id']:'';
 		$rettype	= ($p['rettype'])?$p['rettype']:'';
 		$retmode	= ($p['retmode'])?$p['retmode']:'xml';
 	
 		$this->parameters = array('retmode' => $retmode,'rettype' => $rettype , 'db' => $db,'id' => $id);
 		//var_dump($u);
 		//echo $u['id'].'<br>';
 		//var_dump($this->parameters);
 		
		return true;
 	}
 	
 	/**
 	 * runNCBIBlast function.
 	 * 
 	 * @access public
 	 * @return void
 	 */
 	function runEfetchSeq(){
	
		$res 	= $this->client->run_eFetch($this->parameters);
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
 	 		$content = $this->runEfetchSeq();
 	 		$this->rawResponse 	= $content;
			//$this->jsonResponse = xml2json::transformXmlStringToJson($this->rawResponse);
			return true;
 	 		
	 	}else
	 		return false;		
 	}
 }
?>