<?php

/**
/ Show the metadata
*/

ini_set('display_errors', 'On');
error_reporting(E_ALL);

require 'lib/arc2/ARC2.php';
include_once('connect_to_store.php');

// ************************************************************
/* retrieve data */
// ************************************************************

// All triples
$query = '
	SELECT distinct ?s ?p ?o
	WHERE {
	  ?s ?p ?o.
	}
';
$result = $store->query($query, 'rows');
echo '<pre>';
print_r($result);
echo '</pre>';

// Artists						
$query = '
	SELECT distinct ?s ?o
	WHERE {
	  ?s <foaf:name> ?o.
	}
';
$result = $store->query($query, 'rows');
echo '<h3>Artists</h3>';
foreach ($result as $row) {
	echo '<a href="'. $row['s'] .'"> <p>' . $row['o'] . '</p></a>';
}

//Titles
$query = '
	SELECT distinct ?o ?s
	WHERE {
	  ?s <dc:title> ?o.
	}
';
$result = $store->query($query, 'rows');
echo '<h3>Artworks</h3>';
foreach ($result as $row) {
	echo '<a href="'. $row['s'] .'"> <p>' . $row['o'] . '</p></a>';
}

// What is the name of the author of X project?
echo '<h3>What is the name of the author(s) of Blank on Demand project?</h3>';
$query = '
	PREFIX  dc:  <http://purl.org/dc/elements/1.1/>
	PREFIX  foaf:  <http://xmlns.com/foaf/0.1/>
	SELECT distinct ?url ?nameurl ?name
	WHERE {
	  ?url ?p "Blank on Demand".
	  ?url dc:creator ?nameurl .
	  ?nameurl foaf:name ?name .
	} 
';
$result = $store->query($query, 'rows');
echo $result[0]['name'];

/*



?>

