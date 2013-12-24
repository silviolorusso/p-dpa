<?php

/**
/ Connect to store
*/

require 'lib/arc2/ARC2.php';

// ************************************************************
// Connecting to the DB
// ************************************************************

include_once('connect_to_store.php');

/* instantiation */
$store = ARC2::getStoreEndpoint($config);

if (!$store->isSetUp()) {
  $store->setUp(); /* create MySQL tables */
}

$store->go();
?>

