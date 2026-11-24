<?php

// MENUS
function _custom_theme_register_menu() {
    register_nav_menus(
        array(
            'menu-main' => __( 'Menu principal' ),
            'menu-footer' => __( 'Menu footer' ),
        )
    );
}
add_action( 'init', '_custom_theme_register_menu' );

function projecttheme_menu_item_anchor( $atts, $item ) {
    $anchors = array(
        'samsa'      => 'wer-ist-samsa',
        'highlights' => 'unsere-highlights',
        'weinguter'  => 'unsere-weingueter',
        'weingueter' => 'unsere-weingueter',
        'herkunft'   => 'herkunft-unserer-weine',
        'standorte'  => 'standorte',
        'kontakt'    => 'kontakte',
    );
    $label = sanitize_title( wp_strip_all_tags( $item->title ) );

    if ( isset( $anchors[ $label ] ) ) {
        static $one_page_url = null;

        if ( null === $one_page_url ) {
            $one_page = get_page_by_path( 'samsa' );
            $one_page_url = $one_page ? get_permalink( $one_page ) : home_url( '/' );
        }

        $atts['href'] = $one_page_url . '#' . $anchors[ $label ];
    }

    return $atts;
}
add_filter( 'nav_menu_link_attributes', 'projecttheme_menu_item_anchor', 10, 2 );

function projecttheme_order_one_page_menu_items( $items, $args ) {
    $is_main_menu   = isset( $args->theme_location ) && 'menu-main' === $args->theme_location;
    $is_footer_menu = isset( $args->menu_id ) && 'footer-menu' === $args->menu_id;

    if ( ! $is_main_menu && ! $is_footer_menu ) {
        return $items;
    }

    $menu_order = array( 'samsa', 'highlights', 'weinguter', 'weingueter', 'herkunft', 'standorte', 'kontakt' );
    usort(
        $items,
        function ( $first, $second ) use ( $menu_order ) {
            $first_order  = array_search( sanitize_title( wp_strip_all_tags( $first->title ) ), $menu_order, true );
            $second_order = array_search( sanitize_title( wp_strip_all_tags( $second->title ) ), $menu_order, true );

            if ( false === $first_order ) {
                $first_order = count( $menu_order ) + $first->menu_order;
            }
            if ( false === $second_order ) {
                $second_order = count( $menu_order ) + $second->menu_order;
            }

            return $first_order - $second_order;
        }
    );

    return $items;
}
add_filter( 'wp_nav_menu_objects', 'projecttheme_order_one_page_menu_items', 10, 2 );

function custom_setup() {
    // Images
    add_theme_support( 'post-thumbnails' );

    // Title tags
    add_theme_support('title-tag');

    // Languages
    load_theme_textdomain('textdomaintomodify', get_template_directory() . '/languages');

    // HTML 5 - Example : deletes type="*" in scripts and style tags
    add_theme_support( 'html5', [ 'script', 'style' ] );

    // Remove SVG and global styles
    remove_action('wp_enqueue_scripts', 'wp_enqueue_global_styles');
    remove_action('wp_body_open', 'wp_global_styles_render_svg_filters' );

    // Remove wp_footer actions which add's global inline styles
    remove_action('wp_footer', 'wp_enqueue_global_styles', 1);

    // Remove render_block filters which adds unnecessary stuff
    remove_filter('render_block', 'wp_render_duotone_support');
    remove_filter('render_block', 'wp_restore_group_inner_container');
    remove_filter('render_block', 'wp_render_layout_support_flag');

    // Remove useless WP image sizes
    remove_image_size( '1536x1536' );
    remove_image_size( '2048x2048' );

    // Custom image sizes
    add_image_size( 'extra-large', 1920, 1920, false );
}
add_action('after_setup_theme', 'custom_setup');

/**
 * Set the theme's recommended WordPress media sizes once.
 */
function projecttheme_configure_media_sizes() {
    if ( get_option( 'projecttheme_media_sizes_version' ) === '1' ) {
        return;
    }

    update_option( 'thumbnail_size_w', 150 );
    update_option( 'thumbnail_size_h', 150 );
    update_option( 'thumbnail_crop', 1 );
    update_option( 'medium_size_w', 500 );
    update_option( 'medium_size_h', 500 );
    update_option( 'large_size_w', 1000 );
    update_option( 'large_size_h', 1000 );
    update_option( 'projecttheme_media_sizes_version', '1' );
}
add_action( 'after_switch_theme', 'projecttheme_configure_media_sizes' );

function projecttheme_image_size_names( $sizes ) {
    $sizes['extra-large'] = __( 'Extra groß (max. 1920 × 1920)', 'textdomaintomodify' );

    return $sizes;
}
add_filter( 'image_size_names_choose', 'projecttheme_image_size_names' );

// Giving credits
function remove_footer_admin () {
    echo 'Theme Autorin: <a href="https://www.tanja-kobler.com" target="_blank">Tanja Kobler</a>';
}
add_filter('admin_footer_text', 'remove_footer_admin');

// Move Yoast to bottom
function yoasttobottom() {
    return 'low';
}
add_filter( 'wpseo_metabox_prio', 'yoasttobottom');

// Remove WP Emoji
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
remove_action('wp_head', 'wp_generator');

// delete wp-embed.js from footer
function my_deregister_scripts() {
    wp_deregister_script( 'wp-embed' );
}
add_action( 'wp_footer', 'my_deregister_scripts' );


// add SVG to allowed file uploads
function add_file_types_to_uploads($mime_types) {
    $mime_types['svg'] = 'image/svg+xml';

    return $mime_types;
}
add_action('upload_mimes', 'add_file_types_to_uploads', 1, 1);

//disable update emails
add_filter( 'auto_plugin_update_send_email', '__return_false' );
add_filter( 'auto_theme_update_send_email', '__return_false' );

// disable Gutenberg for all post types
add_filter( 'use_block_editor_for_post_type', '__return_false' );