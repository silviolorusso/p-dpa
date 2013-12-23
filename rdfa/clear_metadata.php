<?php

/**
/ Delete the metadata of a post to the SPARQL DB
*/

// avoid the creation of HTTP headers: http://stackoverflow.com/a/9709170/1205102
ob_start();

require 'lib/arc2/ARC2.php';

function clear_record($base){

	// ************************************************************
	// Connecting to the DB
	// ************************************************************
	
	include_once('connect_to_store.php');
	
	$store->query('LOAD '.$base);
	
	// ************************************************************
	/* clear graph */
	// ************************************************************
	
	// Check if graph exists
	$query = 'ASK { GRAPH <'.$base.'> { ?s ?p ?o } }';
	$result = $store->query($query);
	if ($result['result'] != 0) {
		$query = 'DELETE FROM <'.$base.'> { ?s ?p ?o } WHERE { ?s ?p ?o }';
		$store->query($query);
	}
}
?>