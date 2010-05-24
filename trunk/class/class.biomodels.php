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
 
  class Biomodels extends Proxy{
  	
  	 /**
 	 * __construct function.
 	 * 
 	 * @access private
 	 * @return void
 	 */
 	function __construct(){
 	
  		 $this->client = new SoapClient('http://biomodels.caltech.edu/services/BioModelsWebServices?wsdl', array( 'trace' => true, "exceptions" => 0));
 	}
 	

	function getModelsIdByUniprotId($uniprotId){
	
		try {
			$param = new SoapParam($uniprotId,"uniprotId");
			$res = $this->client->getModelsIdByUniprotId($param);
			
		}catch (SoapFault $fault){
			 trigger_error("SOAP Fault: (faultcode: {$fault->faultcode}, faultstring: {$fault->faultstring})", E_USER_ERROR);
		}
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
		
		$out = "<response>";
		if ($res){
			foreach ($res as $r)
				$out .= '<biomodel>'.$r.'</biomodel>';
		}	
		$out .= "</response>";
		return $out;
	}
	
	function getModelByID($id){
	
		try {
			$param = new SoapParam($id,"id");
			$res = $this->client->getModelByID($param);
			
		}catch (SoapFault $fault){
			 trigger_error("SOAP Fault: (faultcode: {$fault->faultcode}, faultstring: {$fault->faultstring})", E_USER_ERROR);
		}
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
 	
 		$p=$this->getParameters($param);
 		
		switch ($_REQUEST['bwsp_service']){
		
			case 'getModelsIdByUniprotId':
		
				$this->rawResponse 	= $this->getModelsIdByUniprotId($p['uniprotId']);
				return true;
				break;

			case 'getModelByID':
		
				$this->rawResponse 	= $this->getModelByID($p['id']);
				return true;
				break;

		}
 		$this->jsonResponse = xml2json::transformXmlStringToJson($this->rawResponse);
 	}
  }
?>