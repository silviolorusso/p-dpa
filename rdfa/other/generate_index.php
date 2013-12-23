<?php

/**
/ Generate Index
*/

// avoid the creation of HTTP headers: http://stackoverflow.com/a/9709170/1205102
ob_start();

$index = '';

$index .= "<h5>All Authors</h5>\n\n";

/*
PREFIX foaf: <http://xmlns.com/foaf/0.1/>
SELECT distinct ?url ?name 
WHERE {
    ?url foaf:name ?name.
}
*/
$authors = simplexml_load_file("http://localhost:8888/p-dpa/wp/wp-content/themes/p-dpa/rdfa/my_controls/endpoint.php?query=PREFIX+foaf%3A+%3Chttp%3A%2F%2Fxmlns.com%2Ffoaf%2F0.1%2F%3E%0D%0ASELECT+distinct+%3Furl+%3Fname+%0D%0AWHERE+%7B%0D%0A++++%3Furl+foaf%3Aname+%3Fname.%0D%0A%7D&output=xml");				
foreach ($authors->results->result as $result) {
	$url = $result->binding[0]->uri;
	$name = $result->binding[1]->literal;
	$index .= "<p><a href=\"".$url."\">".$name."</a></p>\n";
}


$index .= "\n<h5>All Works</h5>\n\n";									
/*
PREFIX dcterms: <http://purl.org/dc/terms/>
SELECT  ?url ?title
WHERE {
    ?url ?p dcterms:MediaType .
    ?url dcterms:title ?title
}
*/
$works = simplexml_load_file("http://localhost:8888/p-dpa/wp/wp-content/themes/p-dpa/rdfa/my_controls/endpoint.php?query=PREFIX+dcterms%3A+%3Chttp%3A%2F%2Fpurl.org%2Fdc%2Fterms%2F%3E%0D%0ASELECT++%3Furl+%3Ftitle%0D%0AWHERE+%7B%0D%0A++++%3Furl+%3Fp+dcterms%3AMediaType+.%0D%0A++++%3Furl+dcterms%3Atitle+%3Ftitle%0D%0A%7D&output=xml");
foreach ($works->results->result as $result) {
	$url = $result->binding[0]->uri;
	$title = $result->binding[1]->literal;
	$index .= "<p><a href=\"".$url."\">".$title."</a></p>\n";
}

$filename = "../wp-content/themes/p-dpa/rdfa/index.txt";
if (is_writable($filename)) {
    if (!$handle = fopen($filename, 'w+')) {
         echo "Can't open ($filename)";
         exit;
    }
    if (fwrite($handle, $index) === FALSE) {
        echo "Can't write into ($filename)";
        exit;
    }
    echo "Done!";
    fclose($handle);
} else {
	echo "Can't access $filename";
}
?>


