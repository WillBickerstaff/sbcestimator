<?php

if ( !defined( 'WP_UNINSTALL_PLUGIN' ) )
  exit();

global $wpdb;
global $sbcprefix;

$tables = array('datatypes', 'data', 'dims', 'units');

foreach($tables as $tablename) {
  $table = $wpdb->prefix . $sbcprefix . $tablename;
  $wpdb->query("DROP TABLE IF EXISTS $table");
}