<?php

include_once('access_sparql_db.php');

// ************************************************************
// Connecting to the Store
// ************************************************************

/* MySQL and endpoint configuration */ 
$config = array(
  /* db */
  'db_host' => $db_host, /* optional, default is localhost */
  'db_name' => $db_name,
  'db_user' => $db_user,
  'db_pwd' => $db_pass,

  /* store name */
  'store_name' => 'my_endpoint_store',

  /* endpoint */
  'endpoint_features' => array(
    'select', 'construct', 'ask', 'describe', 
    'load', 'insert', 'delete', 
    'dump' /* dump is a special command for streaming SPOG export */
  ),
  'endpoint_timeout' => 60, /* not implemented in ARC2 preview */
  'endpoint_write_key' => $sparql_key, /* optional, but without one, everyone can write! */
  // 'endpoint_max_limit' => 300, /* optional */
);

/* instantiation */
$store = ARC2::getStoreEndpoint($config);

if (!$store->isSetUp()) {
  $store->setUp(); /* create MySQL tables */
}
?>