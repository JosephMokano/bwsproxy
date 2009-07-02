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
 
 include_once('class/class.proxy.php');
 include_once('class/class.rest.php');
 include_once('class/ez_sql.php');
 include_once('class/xml2json.php');
 
 //initialization
 $debug 		= 1;
 $currentTime 	= time();
 $request		= '';
 
 //proxy parameters
 $service 		= $_REQUEST['bwsp_service'];					// service name
 $format		= $_REQUEST['bwsp_response_format'];			// row|json
 $soap	 		= $_REQUEST['bwsp_soap'];						// soap call
 $restUrl 		= $_REQUEST['bwsp_rest'];						// rest call
 $cache			= $_REQUEST['bwsp_cache'];						// 0|1|2|3|4|5
 $callback		= $_REQUEST['bwsp_callback'];					// Callback function name
 
 
 if (!isset($service) or  !isset($format) or !isset($cache) or (!isset($soap) and !isset($restUrl))){
 	//exit;
 }

 //calling a rest service (XML-RPC)
 if ($restUrl){
 	 $rest 	= new Rest;
 	 if ($rest->callService($_REQUEST))
 		$rest->printResponse($format,$callback);
 }

?>