<?php

/**
 * Add the username of people who shouldn't be restricted
 */
$excluded_users = [
    'smarterdigitalltd',
    'admin',
];

if ( is_admin() && ! in_array( wp_get_current_user()->user_login, $excluded_users ) ) {

    // Hide ACF
    add_filter( 'acf/settings/show_admin', '__return_false' );

    // Cleanup of default menu items
    add_action( 'admin_menu', function() {
        remove_menu_page( 'plugins.php' );
        remove_menu_page( 'tools.php' );
        remove_menu_page( 'edit-comments.php' );
        remove_menu_page( 'smarter-tools' );
        remove_menu_page( 'yith_wc_surveys_panel' );
        remove_menu_page( 'yit_plugin_panel' );
        remove_menu_page( 'kinsta-tools' );
        remove_menu_page( 'wp_stream' );
    }, 99 );

    // Cleanup of plugin menu items
    add_action( 'admin_init', function() {
        remove_submenu_page( 'themes.php', 'theme-editor.php' );
        remove_submenu_page( 'options-general.php', 'options-reading.php' );
        remove_submenu_page( 'options-general.php', 'options-media.php' );
        remove_submenu_page( 'options-general.php', 'options-permalink.php' );
        remove_submenu_page( 'options-general.php', 'options-writing.php' );
        remove_submenu_page( 'options-general.php', 'options-discussion.php' );
        remove_submenu_page( 'options-general.php', 'zerospam' );
        remove_submenu_page( 'options-general.php', 'roots_share_buttons' );
        remove_submenu_page( 'options-general.php', 'wp-krakenio' );
        remove_submenu_page( 'options-general.php', 'async-javascript' );
        remove_submenu_page( 'options-general.php', 'autoptimize' );
        remove_submenu_page( 'options-general.php', 'hicpo-settings' );
        remove_submenu_page( 'options-general.php', 'cdn_enabler' );
        remove_submenu_page( 'options-general.php', 'gtm4wp-settings' );
        remove_submenu_page( 'options-general.php', 'searchwp' );
        remove_submenu_page( 'options-general.php', 'breadcrumb-navxt' );
        remove_submenu_page( 'options-general.php', 'wordpress-popular-posts' );
        remove_submenu_page( 'options-general.php', 'fl-builder-settings' );
    }, 99 );

    // Hide Dash widgets
    add_action( 'admin_init', function() {
        remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
        remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
        remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
        remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');//since 3.8
        remove_meta_box( 'woocommerce_dashboard_recent_reviews', 'dashboard', 'normal');//since 3.8
        remove_meta_box( 'wpseo-dashboard-overview', 'dashboard', 'normal');//since 3.8
    }, 99 );

    // Hide Imsanity logo
    define( 'IMSANITY_HIDE_LOGO', true );

    // Move Yoast Meta Box to bottom
    add_filter( 'wpseo_metabox_prio', function() {
        return 'low';
    }, 99 );

    // Hide Admin Bar items
    add_action( 'wp_before_admin_bar_render', function() {
        global $wp_admin_bar;

        $wp_admin_bar->remove_menu('wp-logo');          // Remove the WordPress logo
        $wp_admin_bar->remove_menu('about');            // Remove the about WordPress link
        $wp_admin_bar->remove_menu('wporg');            // Remove the WordPress.org link
        $wp_admin_bar->remove_menu('documentation');    // Remove the WordPress documentation link
        $wp_admin_bar->remove_menu('support-forums');   // Remove the support forums link
        $wp_admin_bar->remove_menu('feedback');         // Remove the feedback link
        //$wp_admin_bar->remove_menu('site-name');        // Remove the site name menu
        //$wp_admin_bar->remove_menu('view-site');        // Remove the view site link
        $wp_admin_bar->remove_menu('updates');          // Remove the updates link
        $wp_admin_bar->remove_menu('comments');         // Remove the comments link
        $wp_admin_bar->remove_menu('new-content');      // Remove the content link
        $wp_admin_bar->remove_menu('my-account');       // Remove the user details tab

        $wp_admin_bar->remove_menu('wpseo-menu');		// Remove Yoast SEO

        $wp_admin_bar->remove_menu('searchwp');			// Remove SearchWP
    } );

    // Unregister all widgets
    add_action( 'widgets_init', function() {
        unregister_widget( 'WP_Widget_Pages' );
        unregister_widget( 'WP_Widget_Calendar' );
        unregister_widget( 'WP_Widget_Archives' );
        unregister_widget( 'WP_Widget_Links' );
        unregister_widget( 'WP_Widget_Meta' );
        unregister_widget( 'WP_Widget_Search' );
        unregister_widget( 'WP_Widget_Text' );
        unregister_widget( 'WP_Widget_Categories' );
        //unregister_widget( 'WP_Widget_Custom_Menu' );
        unregister_widget( 'WP_Widget_Recent_Posts' );
        unregister_widget( 'WP_Widget_Recent_Comments' );
        unregister_widget( 'WP_Widget_RSS' );
        unregister_widget( 'WP_Widget_Tag_Cloud' );
        unregister_widget( 'WP_Nav_Menu_Widget' );
        unregister_widget( 'Twenty_Eleven_Ephemera_Widget' );

        unregister_widget( 'GFWidget' );

        unregister_widget( 'bcn_widget' ); // breadcrumb-navxt

        unregister_widget( 'WordpressPopularPosts' );

        unregister_widget( 'WC_Widget_Cart' );
        unregister_widget( 'WC_Widget_Recent_Products' );
        unregister_widget( 'WC_Widget_Featured_Products' );
        unregister_widget( 'WC_Widget_Product_Categories' );
        unregister_widget( 'WC_Widget_Product_Tag_Cloud' );
        unregister_widget( 'WC_Widget_Layered_Nav' );
        unregister_widget( 'WC_Widget_Layered_Nav_Filters' );
        unregister_widget( 'WC_Widget_Price_Filter' );
        unregister_widget( 'WC_Widget_Product_Search' );
        unregister_widget( 'WC_Widget_Top_Rated_Products' );
        unregister_widget( 'WC_Widget_Recent_Reviews' );
        unregister_widget( 'WC_Widget_Recently_Viewed' );
        unregister_widget( 'WC_Widget_Best_Sellers' );
        unregister_widget( 'WC_Widget_Onsale' );
        unregister_widget( 'WC_Widget_Random_Products' );
        unregister_widget( 'WooCommerce_Widget_Subscibe_to_Newsletter' );
        unregister_widget( 'WC_Widget_Products' );
        unregister_widget( 'WC_Widget_Rating_Filter' );
    }, 99 );

    // Hide meta boxes
    add_action( 'admin_head', function() {
        // CPTs
        remove_meta_box( 'wpseo_meta', 'testimonial', 'normal' );
        remove_meta_box( 'wpseo_meta', 'tsp_faq', 'normal' );
        remove_meta_box( 'wpseo_meta', 'tsp_endorsement', 'normal' );

        // Pages
        remove_meta_box( 'postimagediv', 'page', 'side' );
    }, 99 );

    // Edit admin footer text
    add_filter( 'admin_footer_text', function() {
        return null;
    }, 10, 1 );

    // Hide all admin notices
    add_action( 'admin_head', function() {
        remove_all_actions( 'admin_notices' );
    }, 1 );

}
