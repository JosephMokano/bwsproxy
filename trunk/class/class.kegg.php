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
 
  class Kegg extends Proxy{
  	
  	 /**
 	 * __construct function.
 	 * 
 	 * @access private
 	 * @return void
 	 */
 	function __construct(){
 	
  		 $this->client = new SoapClient('http://soap.genome.jp/KEGG.wsdl', array( 'trace' => true, "exceptions" => 0));
 	}
 	
	/**
	 * bget function.
	 * 
	 * @access public
	 * @param mixed $feature
	 * @param mixed $id
	 * @return void
	 */
	function bget($feature,$id){
	
		try {
			$param = new SoapParam($feature.':'.$id,"string");
			$res = $this->client->bget($param);
			
		}catch (SoapFault $fault){
			 trigger_error("SOAP Fault: (faultcode: {$fault->faultcode}, faultstring: {$fault->faultstring})", E_USER_ERROR);
		}

		return '<response><![CDATA['.trim($res).']]></response>';
	}
 	
	/**
	 * bconv function.
	 * 
	 * @access public
	 * @param mixed $database
	 * @param mixed $id
	 * @return void
	 */
	function bconv($database,$id){
	
		try {
			$param = new SoapParam($database.':'.$id,"string");
			$res = $this->client->bconv($param);
			
		}catch (SoapFault $fault){
			 trigger_error("SOAP Fault: (faultcode: {$fault->faultcode}, faultstring: {$fault->faultstring})", E_USER_ERROR);
		}

		return '<response>'.trim($res).'</response>';
	}
	
	
	function get_pathways_by_genes($genes){
	
		try {
			$param = new SoapParam($genes,"string");
			$res = $this->client->get_pathways_by_genes(array('string' => $genes));
			
		}catch (SoapFault $fault){
			 trigger_error("SOAP Fault: (faultcode: {$fault->faultcode}, faultstring: {$fault->faultstring})", E_USER_ERROR);
		}
		 		//debug
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
				$out .= '<pathway>'.str_replace('path:','',$r).'</pathway>';
		}	
		$out .= "</response>";
		return $out;
	}
	
	
	

 	
 	/**
 	 * getServiceResponse function.
 	 * 
 	 * @access public
 	 * @param mixed $param
 	 * @return void
 	 */
 	function getServiceResponse($param){
 		
 		switch ($_REQUEST['bwsp_service']){
 		
 			case 'bget':
			
 				$this->rawResponse 	= $this->bget($_REQUEST['feature'],$_REQUEST['id']);
 				return true;
				break;
				
 			case 'bconv':
			
 				$this->rawResponse 	= $this->bconv($_REQUEST['database'],$_REQUEST['id']);
 				return true;
				break;
			
			case 'get_pathways_by_genes':
			
 				$this->rawResponse 	= $this->get_pathways_by_genes($_REQUEST['genes']);
 				return true;
				break;	

 		}
 		$this->jsonResponse = xml2json::transformXmlStringToJson($this->rawResponse);
 		

 	}
  }
?>