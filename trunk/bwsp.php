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

 $proxy			= new Proxy;
 
 //proxy parameters
 $service 		= $_REQUEST['bwsp_service'];					// service name
 $format		= $_REQUEST['bwsp_response_format'];			// row|json
 $restUrl 		= $_REQUEST['bwsp_url'];						// service url
 $callback		= $_REQUEST['bwsp_callback'];					// Callback function name
 
 
 if (!isset($service) or  !isset($format) or (!isset($soap) and !isset($restUrl))){
 	//exit;
 }
 
 $type = $proxy->getServiceType($_REQUEST);
 
 //REST services 
 if ($type == 'REST'){
 	
 	$rest = new Rest;
 	
 	if ($rest->callService($_REQUEST))
 		$rest->printResponse($format,$callback);
 }




?>