<?php

/**
 * Trigger this file on plugin uninstall
 *
 * @package JasaDemoPlugin
 */

defined('WP_UNINSTALL_PLUGIN') or die("You can not call uninstall outside of WordPress.");

global $wpdb;

// Clean up the DB
$wpdb->query('DELETE FROM wp_posts WHERE post_type = "transactions"'); // Delete all transactions
$wpdb->query('DELETE FROM wp_postmeta WHERE post_id NOT IN (SELECT ID FROM wp_posts)'); // Delete transaction metadata
$wpdb->query('DELETE FROM wp_term_relationships WHERE object_id NOT IN (SELECT ID FROM wp_posts)');