<?php
/*
Plugin Name: SBC Estimator
Plugin URI: http://github.com/WillBickerstaff/sbcestimator
Description: A building cost estimaor for http://www.stablebuildcompany.co.uk
Version: 1.0a
Author: Will Bickerstaff
License: GPLv3
*/

/*  Copyright 2013 Will Bickerstaff (email: will.bickerstaff@gmail.com)

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

global $sbc_estimator_db_version;
$sbc_estimator_db_version = "1.0";

register_activation_hook( __FILE__, 'sbc_estimator_install');

add_action( 'admin_menu', 'sbc_plugin_menu' );

function sbc_plugin_menu() {
  add_options_page('Estimator Options', 'SBC Estimator', 'manage_options', 'sbcestimator', 'sbc_options');
}

function sbc_options() {

}

function sbc_estimator_install () {
  global $wpdb;
  global $sbc_estimator_db_version;

  $tablename = $wpdb->prfix . "sbc_estimator_datatypes";

  require_once( ABSPATH . "wp-admin/includes/upgrade.php" );

  $sql = "CREATE TABLE $tablename (
    id mediumint(9) NOT NULL AUTO_INCREMENT,
    name tinytext NOT NULL,
    PRIMARY KEY id (id)
  );";
  
  dbDelta ( $sql );

  $rows_affected = $wpdb->insert( $tablename, array( 'name' => 'building', 'name' => 'option' ) );

  $tablename = $wpdb->prefix . "sbc_estimator_data";

  $sql = "CREATE TABLE $tablename (
    id mediumint(9) NOT NULL AUTO_INCREMENT,
    type mediumint NOT NULL,
    name tinytext NOT NULL,
    description text,
    units tinytext NOT NULL,
    price_unit DOUBLE NOT NULL,
    PRIMARY KEY id (ID)
  );";

  dbDelta ( $sql );

  add_option ('sbc_estimator_db_version', $sbc_estimator_db_version );
}
?>