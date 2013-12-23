<?php

/**
/ Extracts and send the metadata of a post to the SPARQL DB
*/

// avoid the creation of HTTP headers: http://stackoverflow.com/a/9709170/1205102
ob_start();

// ************************************************************
// Extracting metadata part from HTML
// ************************************************************

require 'lib/simple_html_dom.php';
require 'lib/arc2/ARC2.php';

function send_record($base, $post_id){ 
	// If item doesn't exist yet: do nothing
	if (!file_get_html($base)) {
		return;
	} else {
		$html = file_get_html($base);		
	}
	$HTMLmetadata = $html->find('section[id=metadata]', 0);
	if (empty($HTMLmetadata)) {
		return;
	}
		
	// Extracting RDFa from HTML
	$config = array('auto_extract' => 0);
	$parser = ARC2::getSemHTMLParser();
	$parser->parse($base, $HTMLmetadata);
	$parser->extractRDF('rdfa');
	
	$triples = $parser->getTriples();
	
	// Extracting prefixes
	$prefixes = $HTMLmetadata->prefix;
    $explode = explode(' ', $prefixes);
    $lines = array();
    for ($i = 0; $i < count($explode); $i += 2) {
        $lines[] = 'PREFIX ' . $explode[$i] . ' <' . $explode[$i + 1] . '>';
    }
    $prefixes = implode("\n", $lines);
	
	// ************************************************************
	// Connecting to the DB
	// ************************************************************
	
	include_once('connect_to_store.php');
		
	$store->query('LOAD '.$base);
	
	// ************************************************************
	/* clear other instances of the graph */
	// ************************************************************	
	
	$query = '
	SELECT ?graph 
	WHERE {
		?graph <http://purl.org/dc/terms/identifier> "'.$post_id.'"	
	}
	';
	$result = $store->query($query, 'rows');
	if (!empty($result)) {
		$graph = $result[0]['graph'];
		// if url is changed
		if ($graph != $base) {
			$query = 'DELETE FROM <'.$graph.'> { ?s ?p ?o } WHERE { ?s ?p ?o }';
			$result = $store->query($query);
		} else {
			$query = 'DELETE FROM <'.$base.'> { ?s ?p ?o } WHERE { ?s ?p ?o }';
			$store->query($query);
		}
	}
	
	// ************************************************************
	/* insert data */
	// ************************************************************
	
	$queries = '';
	foreach ($triples as $row) {
		// manage URI and literals for ?s;
		if ($row['s_type'] == 'literal') {
			$s = '"'.$row['s'].'"';
		} else if ( $row['s_type'] == 'uri' && preg_match('/http:/',$row['s']) ) {
			$s = '<'.$row['s'].'>';
		} else {
			$s = $row['s'];
		}
		// manage URI and literals for ?s;
		if ( preg_match('/http:/',$row['p']) ) {
			$p = '<'.$row['p'].'>';
		} else {
			$p = $row['p'];
		}
		// manage URI and literals for ?o;
		if ($row['o_type'] == 'literal') {
			$o = '"'.$row['o'].'"';
		} else if ($row['o_type'] == 'uri' && preg_match('/http:/',$row['o']) ) {
			$o = '<'.$row['o'].'>';
		} else {
			$o = $row['o'];
		}
		$query = '
' .$prefixes. '
INSERT INTO <'.$base.'> {
	'.$s.' '.$p.' '.$o.' . 
}
		';
		$store->query($query);
		$queries .= $query;
	}
	
	// ************************************************************
	/* Keep a log of the queries */
	// ************************************************************
	
	$currentDate = date("D M j G:i:s T Y");
	$toWrite = $currentDate . "\n\n" . $queries . "\n\n";
	$filename = "../wp-content/themes/p-dpa/rdfa/query-log.txt";
	if (is_writable($filename)) {
	    if (!$handle = fopen($filename, 'a+')) {
	         echo "Can't open ($filename)";
	         exit;
	    }
	    if (fwrite($handle, $toWrite) === FALSE) {
	        echo "Can't write into ($filename)";
	        exit;
	    }
	    echo "Done!";
	    fclose($handle);
	} else {
		    echo "Can't access $filename";
	}
}
?>