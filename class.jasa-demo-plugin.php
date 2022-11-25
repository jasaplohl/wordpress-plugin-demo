<?php

class JasaDemoPlugin {
    public static function pluginActivation(): void {
//        $this->generateTransactionPostType();
        flush_rewrite_rules();
    }

    public static function pluginDeactivation(): void {
        flush_rewrite_rules();
    }

    public static function generateTransactionPostType(): void {
        register_post_type(
            'transactions',
            array(
                'public' => true,
                'label' => 'Transactions',
                'menu_icon' => 'dashicons-money-alt'
            )
        );
    }
}