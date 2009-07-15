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
 include_once('class/class.xmlserialize.php');
 include_once('class/xml2json.php');
  
 ini_set('auto_detect_line_endings', true);
 
 //initialization
 $debug 		= 1;
 $currentTime 	= time();
 $request		= '';

 $proxy			= new Proxy;
 
 //proxy parameters
 $service 		= $_REQUEST['bwsp_service'];					// service name
 $format		= $_REQUEST['bwsp_response_format'];			// row|json|capsule
 $serviceUrl	= $_REQUEST['bwsp_url'];						// service url
 $callback		= $_REQUEST['bwsp_callback'];					// Callback function name
 $forceNoCache	= $_REQUEST['bwsp_force_no_cache'];				// Empty cache for this query 
 
 
 if (!isset($service) or  !isset($format)){
 	exit;
 }
 $type = $proxy->getServiceType($_REQUEST);
 
 switch ($type){
 
 	//REST services
 	case 'REST':
 		
 		if (!isset($serviceUrl))
 			exit; 
 		$rest = new Rest;
 	 	if ($rest->callService($_REQUEST))
 			$rest->printResponse($format,$callback);
 		break;
 			
 	//EBI SOAP services		
 	case 'EBISOAP':
 		
 		switch($service){
 			
 			case 'ebiNcbiblast':
 				
 				include_once('class/class.ebi.ncbiblast.php');
 				$blast = new EbiNCBIblast;
 				if($blast->callService($_REQUEST))
 					$blast->printResponse($format,$callback);
 				break;	
 				
 		}
 		
 	//NCBI SOAP services		
 	case 'NCBISOAP':
 		
 		switch($service){
 			
 			case 'efetchSeq':
 				
 				include_once('class/class.ncbi.efetchseq.php');
 				$blast = new EfetchSeq;
 				if($blast->callService($_REQUEST))
 					$blast->printResponse($format,$callback);
 				break;	
 				
 		}	 		
 				
 }

?>