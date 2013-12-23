<?php
/**
/ Delete the metadata of a post to the SPARQL DB
*/
ini_set('display_errors', 'On');
error_reporting(E_ALL);

// ************************************************************
// Extracting metadata part from HTML
// ************************************************************

require '../lib/arc2/ARC2.php';

$base = $_GET['graphname'];

// ************************************************************
// Connecting to the DB
// ************************************************************

include_once('../connect_to_store.php');

$store->query('LOAD '.$base);

// ************************************************************
/* clear graph */
// ************************************************************

// Check if graph exists
$query = 'ASK { GRAPH <'.$base.'> { ?s ?p ?o } }';
$result = $store->query($query);
if ($result['result'] != 0) {
	$query = 'DELETE FROM <'.$base.'> { ?s ?p ?o } WHERE { ?s ?p ?o }';
	$result = $store->query($query);
	print_r($result);
} else {
	echo 'nothing was deleted';
}
?>