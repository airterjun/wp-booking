<?php

/**
 * Created by PhpStorm.
 * User: macbookpro
 * Date: 8/5/16
 * Time: 9:17 PM
 */
class GoSurf
{

	/*
	 * Will use later
	 */
	public $version = '1.0';




	public function __construct()
	{

		$this->run_plugin();

	}


	public function run_plugin()
	{

		$this->create_table();

	}

	private function create_table()
	{
		global $wpdb;

		$wpdb->hide_errors();

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

		dbDelta($this->get_table_schema());

	}


	private function get_table_schema()
	{
		global $wpdb;

		$collate = '';

		if ($wpdb->has_cap('collation')) {
			if (!empty($wpdb->charset)) {
				$collate .= "DEFAULT CHARACTER SET $wpdb->charset";
			}
			if (!empty($wpdb->collate)) {
				$collate .= " COLLATE $wpdb->collate";
			}
		}

		return "
			CREATE TABLE {$wpdb->prefix}go_surf_session (
			  session_id bigint(20) NOT NULL AUTO_INCREMENT,
			  session_key char(32) NOT NULL,
			  session_value longtext NOT NULL,
			  session_expiry bigint(20) NOT NULL,
			  UNIQUE KEY session_id (session_id),
			  PRIMARY KEY  (session_key)
			) $collate;
			CREATE TABLE {$wpdb->prefix}go_surf_client_data (
			  client_id bigint(20) NOT NULL auto_increment,
			  client_name varchar(200) NOT NULL,
			  client_email varchar(100) NULL,
			  client_phone varchar(200) NOT NULL,
			  client_hotel varchar(200) NOT NULL,
			  client_name_in_hotel varchar(200) NOT NULL,
			  client_arrival varchar(200) NOT NULL,
			  client_country varchar(200) NOT NULL,
			  client_nationality varchar(200) NOT NULL,
			  client_message longtext NOT NULL,
			  PRIMARY KEY  (client_id)
			) $collate;
			CREATE TABLE {$wpdb->prefix}go_surf_order_item (
			  order_id bigint(20) NOT NULL auto_increment,
			  client_id bigint(20) NOT NULL,
			  order_create TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
			  order_status char(10) NOT NULL,
			  PRIMARY KEY  (order_id)
			) $collate;
		";
	}
}