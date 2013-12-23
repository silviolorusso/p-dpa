<?php

/**
/ Connect to store
*/

require '../lib/arc2/ARC2.php';

// ************************************************************
// Connecting to the DB
// ************************************************************

/* MySQL and endpoint configuration */ 
$config = array(
  /* db */
  'db_host' => 'localhost', /* optional, default is localhost */
  'db_name' => 'p-dpa-sparql',
  'db_user' => 'root',
  'db_pwd' => 'root',

  /* store name */
  'store_name' => 'my_endpoint_store',

  /* endpoint */
  'endpoint_features' => array(
    'select', 'construct', 'ask', 'describe', 
    'load', 'insert', 'delete', 
    'dump' /* dump is a special command for streaming SPOG export */
  ),
  'endpoint_timeout' => 60, /* not implemented in ARC2 preview */
  'endpoint_write_key' => 'Super1985!', /* optional, but without one, everyone can write! */
  // 'endpoint_max_limit' => 300, /* optional */
);

/* instantiation */
$store = ARC2::getStoreEndpoint($config);

if (!$store->isSetUp()) {
  $store->setUp(); /* create MySQL tables */
}

$store->go();
?>

