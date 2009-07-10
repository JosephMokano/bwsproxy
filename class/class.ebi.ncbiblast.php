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
 
 class EbiNCBIblast extends Proxy{
 
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
 	
  		 $this->client = new SoapClient('http://www.ebi.ac.uk/Tools/webservices/wsdl/WSNCBIBlast.wsdl');
 	}
 	
 	/**
 	 * setParameters function.
 	 * 
 	 * @access public
 	 * @param mixed $param
 	 * @return void
 	 */
 	function setParameters($param){
 	
 		$async 		= ($param['async'])?$param['async']:0;
 		$email		= ($param['email'])?$param['email']:'vdelatorre@cnio.es';
 		$program	= ($param['progam'])?$param['progam']:'blastn';
 		$database	= ($param['database'])?$param['database']:'embl';
 	
 		$this->parameters = array('async' => $async,'email' => $email, 'program' => $program,'database' => $database);
 		
		return true;
 	}
 	
 	/**
 	 * setData function.
 	 * 
 	 * @access public
 	 * @param mixed $param
 	 * @return void
 	 */
 	function setData($param){
 	
 		$sequence	= $param['sequence'];
 		
  		if (!$sequence)
 			return false;
 	
 		$this->data = array(array('type' => 'sequence','content' => $sequence));
 		
 		return true;
 	}
 	
 	/**
 	 * runNCBIBlast function.
 	 * 
 	 * @access public
 	 * @return void
 	 */
 	function runNCBIBlast(){
	
		$jobid 	= $this->client->runNCBIBlast($this->parameters,$this->data);
 		$res = $this->client->poll($jobid,'toolxml');
 		return $res;
 	}
 	
 	/**
 	 * getServiceResponse function.
 	 * 
 	 * @access public
 	 * @param mixed $param
 	 * @return void
 	 */
 	function getServiceResponse($param){
 	 	
 	 	if ($this->setParameters($param) and $this->setData($param) ){
 	 		$content = $this->runNCBIBlast();
 	 		$this->rowResponse 	= $content;
			$this->jsonResponse = xml2json::transformXmlStringToJson($this->rowResponse);
			return true;
 	 		
	 	}else
	 		return false;		
 	}
 }
 ?>
 