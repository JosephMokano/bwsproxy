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
		return '<response>'.$res.'</response>';
	}
	
 	/**
 	 * get_best_best_neighbors_by_gene function.
 	 * 
 	 * @access public
 	 * @param mixed $gene
 	 * @return void
 	 */
 	function get_best_best_neighbors_by_gene($gene){
	
		$res = $this->client->get_best_best_neighbors_by_gene($gene,1,10);
		
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
 		
 		switch ($_REQUEST['bwsp_service']){
 		
 			case 'bconv':
			
 				$this->rawResponse 	= $this->bconv($_REQUEST['database'],$_REQUEST['id']);
 				$this->jsonResponse = xml2json::transformXmlStringToJson($this->rawResponse);
				return true;
				break;

 		}
 	}
  }
?>