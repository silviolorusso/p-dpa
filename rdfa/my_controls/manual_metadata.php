<?php

/**
/ Extracts and send the metadata of a post to the SPARQL DB
*/


// avoid the creation of HTTP headers: http://stackoverflow.com/a/9709170/1205102
ob_start();

// ************************************************************
// Extracting metadata part from HTML
// ************************************************************

require '../../wp/addons/simple_html_dom.php';
require '../../wp/addons/arc2/ARC2.php';
	
// Graph

$base = "http://localhost:8888/p-dpa/wp/author/giulia_ciliberto/";	
	
	
// ************************************************************
// Connecting to the DB
// ************************************************************

include_once('connect_to_store.php');
	
$store->query('LOAD '.$base);

// ************************************************************
/* ask if graph exists */
// ************************************************************


$query = 'ASK { GRAPH <'.$base.'> { ?s ?p ?o } }';
$result = $store->query($query);

print_r($result);


// ************************************************************
/* clear graph */
// ************************************************************

/*
$query = 'DELETE FROM <'.$base.'> { ?s ?p ?o } WHERE { ?s ?p ?o }';
$store->query($query);
*/

?>