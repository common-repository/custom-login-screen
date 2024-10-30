<?php

// style dialog
wp_enqueue_style( 'wp-jquery-ui-dialog' );
wp_enqueue_style( 'about-style-admin', plugin_dir_url( __FILE__ ) . "assets/style-admin.css" );

// script
wp_enqueue_script( 'jquery' );
wp_enqueue_script( 'jquery-ui-dialog' );