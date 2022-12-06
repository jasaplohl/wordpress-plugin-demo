<?php

class TaxonomyController {
    public static function init(): void {
        add_action(
            hook_name: 'admin_menu',
            callback: array('TaxonomyController', 'addSubPage')
        );
    }

    /**
     * Create the admin subpage.
     * @return void
     */
    public static function addSubPage(): void {
        add_submenu_page(
            parent_slug: 'jasa_demo',
            page_title: 'Taxonomy Manager',
            menu_title: 'Taxonomy Manager',
            capability: 'manage_options',
            menu_slug: 'taxonomy_manager',
            callback: function() { return require_once(PLUGIN_PATH . '/templates/taxonomy_manager.php'); }
        );
    }
}