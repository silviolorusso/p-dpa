<?php

/**
/ Connect to store
*/

// ************************************************************
// Connecting to the DB
// ************************************************************

require 'lib/arc2/ARC2.php';
include_once('connect_to_store.php');

/* instantiation */
$store = ARC2::getStoreEndpoint($config);

if (!$store->isSetUp()) {
  $store->setUp(); /* create MySQL tables */
}

$store->go();
?>

