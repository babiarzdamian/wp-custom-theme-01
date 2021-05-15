<?php

/*------------------------------------*\
    External Modules/Files
\*------------------------------------*/

/*------------------------------------*\
    Theme Support
\*------------------------------------*/

if (function_exists('add_theme_support')) {
    // Add Menu Support
    add_theme_support('menus');

    // Add Title Tag Support
    add_theme_support('title-tag');

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('custom-size', 700, 200, true);

    // Add Support for Custom Logo
    add_theme_support('custom-logo', array(
        'height'      => 62,
        'width'       => 160,
        'flex-height' => true,
        'flex-width'  => true
    ));

    // Add Woocommerce support
    add_theme_support('woocommerce');
}

/*------------------------------------*\
    Functions
\*------------------------------------*/

// Load Theme scripts (header.php)
$theme_version = wp_get_theme()->get('Version');
define('THEME_VERSION_JS', $theme_version);
define('THEME_VERSION_CSS', $theme_version);

function _themename_scripts()
{
    wp_register_script('_themename-scripts', get_template_directory_uri() . '/dist/js/index.js', array(), THEME_VERSION_JS, true);
    wp_enqueue_script('_themename-scripts');
}

// Load Theme styles
function _themename_styles()
{
    wp_register_style('_themename-stylesheet', get_template_directory_uri() . '/dist/css/index.css', array(), THEME_VERSION_CSS, 'all');
    wp_enqueue_style('_themename-stylesheet');

    wp_register_style('_themename', get_template_directory_uri() . '/style.css', array(), THEME_VERSION_CSS, 'all');
    wp_enqueue_style('_themename');
}

// Register Theme Navigation
function _themename_register_menu()
{
    register_nav_menus(array(
        'header-menu' => __('Menu główne', '_themename'),
        'footer-menu' => __('Menu w stopce', '_themename'),
    ));
}

// ACF admin theme-settings page
function _themename_acf_op_init()
{
    if (function_exists('acf_add_options_page')) {
        acf_add_options_page(array(
            'page_title'     => 'Ustawienia motywu',
            'menu_title'    => 'Ustawienia motywu',
            'menu_slug'     => 'ustawienia-motywu',
            'capability'    => 'edit_posts',
            'redirect'        => false
        ));
    }
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function _themename_pagination()
{
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages
    ));
}

// Update logo classes
function _themename_update_custom_logo()
{
    $custom_logo_id = get_theme_mod('custom_logo');
    $html = sprintf(
        '<a href="%1$s" class="navbar-logo-link" rel="home">%2$s</a>',
        esc_url(home_url('/')),
        wp_get_attachment_image($custom_logo_id, 'full', false, array(
                'class'    => 'navbar-logo',
            ))
    );
    return $html;
}

// Append icons to menu items
function _themename_nav_menu_icons($items, $args)
{
    foreach ($items as &$item) {
        $icon = get_field('icon', $item);
        if ($icon) {
            $item->title = '<div class="menu-icon-wrapper"><img class="menu-icon" src="' . $icon . '" alt=""></div>' . $item->title;
        }
    }
    return $items;
}


function _themename_wpseo_breadcrumb_separator($this_options_breadcrumbs_sep)
{
    return '<svg class="breadcrumbs-separator" xmlns="http://www.w3.org/2000/svg" width="7.356" height="11.886"><path data-name="Path 761" d="M.707.707l5.235 5.235-5.235 5.236" fill="none" stroke="currentColor" stroke-width="2"/></svg>';
};

function _themename_wpseo_remove_breadcrumb_shop($link_output, $link)
{
    if ($link['text'] == 'Shop' || $link['text'] == 'Sklep') {
        $link_output = '';
    }
    return $link_output;
}

// Move Yoast to bottom
function _themename_wpseo_meta_box_priority()
{
    return 'low';
}


/**
 * Templates and Page IDs without editor
 *
 */
function _themename_disable_editor($id = false)
{
    $excluded_ids = array(
        get_option('page_on_front')
    );

    if (empty($id)) {
        return false;
    }

    $id = intval($id);

    return in_array($id, $excluded_ids);
}

/**
 * Disable Classic Editor by template
 *
 */
function _themename_disable_classic_editor()
{
    if (! isset($_GET['post'])) {
        return;
    }

    if (_themename_disable_editor($_GET['post'])) {
        remove_post_type_support('page', 'editor');
    }
}

add_action('init', '_themename_disable_classic_editor');



// To change add to cart text on product archives(Collection) page

function _themename_woocommerce_custom_product_add_to_cart_text()
{
    return __('Kup', 'woocommerce');
}

function custom_track_product_view()
{
    if (! is_singular('product')) {
        return;
    }
    global $post;
    if (empty($_COOKIE['woocommerce_recently_viewed'])) {
        $viewed_products = array();
    } else {
        $viewed_products = (array) explode('|', $_COOKIE['woocommerce_recently_viewed']);
    }
    if (! in_array($post->ID, $viewed_products)) {
        $viewed_products[] = $post->ID;
    }
    if (sizeof($viewed_products) > 15) {
        array_shift($viewed_products);
    }
    wc_setcookie('woocommerce_recently_viewed', implode('|', $viewed_products));
}

function _themename_get_recently_viewed_products()
{
    global $woocommerce;
    $viewed_products = ! empty($_COOKIE['woocommerce_recently_viewed']) ? (array) explode('|', $_COOKIE['woocommerce_recently_viewed']) : array();
    $viewed_products = array_filter(array_map('absint', $viewed_products));
    if (empty($viewed_products)) {
        return;
    }
    $query_args = array(
        'posts_per_page' => 5,
        'no_found_rows'  => 1,
        'post_status'    => 'publish',
        'post_type'      => 'product',
        'post__in'       => $viewed_products,
        'orderby'        => 'rand',
        'fields'         => 'ids',
    );
    $query_args['meta_query'] = [];
    $query_args['meta_query'][] = $woocommerce->query->stock_status_meta_query();

    $recent_query = new WP_Query($query_args);
    if (!$recent_query->have_posts()) {
        return;
    } else {
        wp_reset_postdata();
        return $recent_query->posts;
    }
}


function woocommerce_product_custom_fields()
{
    global $woocommerce, $post;
    echo '<div class="options_group show_if_simple show_if_variable hidden">';
    woocommerce_wp_text_input(
        array(
                'id' => '__themename_custom_unit_type',
                'placeholder' => '',
                'label' => __('Jednostka miary', '_themename'),
                'desc_tip' => 'true'
            )
    );
    woocommerce_wp_text_input(
        array(
                'id' => '__themename_custom_unit_price',
                'placeholder' => '',
                'label' => __('Cena jednostkowa', '_themename'),
                'desc_tip' => 'true'
            )
    );
    echo '</div>';
    echo '<div class="options_group show_if_simple show_if_variable hidden">';
    woocommerce_wp_text_input(
        array(
                'id' => '__themename_custom_sale_label',
                'placeholder' => '',
                'label' => __('Wartość promocyjna', '_themename'),
                'desc_tip' => 'true',
                'description' => __( 'Ten tekst pojawi się przy etykiecie informacyjnej o promocji.', '_themename' ),
            )
    );
    echo '</div>';
}
function woocommerce_product_custom_fields_save($post_id)
{
    $woocommerce__themename_custom_unit_type = $_POST['__themename_custom_unit_type'];
    if (!empty($woocommerce__themename_custom_unit_type)) {
        update_post_meta($post_id, '__themename_custom_unit_type', esc_attr($woocommerce__themename_custom_unit_type));
    }
    $woocommerce__themename_custom_unit_price = $_POST['__themename_custom_unit_price'];
    if (!empty($woocommerce__themename_custom_unit_price)) {
        update_post_meta($post_id, '__themename_custom_unit_price', esc_attr($woocommerce__themename_custom_unit_price));
    }
    $woocommerce__themename_custom_sale_label = $_POST['__themename_custom_sale_label'];
    if (!empty($woocommerce__themename_custom_sale_label)) {
        update_post_meta($post_id, '__themename_custom_sale_label', esc_attr($woocommerce__themename_custom_sale_label));
    }
}

function woocommerce_product_bundle_custom_fields()
{
    global $woocommerce, $post;
    echo '<div class="options_group show_if_bundle">';
    echo '<p>' . __('Dodatkowe informacje o zestawie produktów', '_themename') . '</p>';
    woocommerce_wp_text_input(
        array(
                'id' => '__themename_bundle_discount_amount',
                'placeholder' => '',
                'label' => __('Zniżka zestawu', '_themename'),
                'desc_tip' => 'true'
            )
    );
    woocommerce_wp_text_input(
        array(
                'id' => '__themename_bundle_discount_title',
                'placeholder' => '',
                'label' => __('Tytuł zniżki', '_themename'),
                'desc_tip' => 'true'
            )
    );
    woocommerce_wp_textarea_input(
        array(
                'id' => '__themename_bundle_discount_description',
                'placeholder' => '',
                'label' => __('Opis zniżki', '_themename')
            )
    );
    echo '</div>';
}

function woocommerce_product_bundle_custom_fields_save($post_id)
{
    $woocommerce__themename_bundle_discount_amount = $_POST['__themename_bundle_discount_amount'];
    if (!empty($woocommerce__themename_bundle_discount_amount)) {
        update_post_meta($post_id, '__themename_bundle_discount_amount', esc_attr($woocommerce__themename_bundle_discount_amount));
    }
    $woocommerce__themename_bundle_discount_title = $_POST['__themename_bundle_discount_title'];
    if (!empty($woocommerce__themename_bundle_discount_title)) {
        update_post_meta($post_id, '__themename_bundle_discount_title', esc_attr($woocommerce__themename_bundle_discount_title));
    }
    $woocommerce__themename_bundle_discount_description = $_POST['__themename_bundle_discount_description'];
    if (!empty($woocommerce__themename_bundle_discount_description)) {
        update_post_meta($post_id, '__themename_bundle_discount_description', esc_html($woocommerce__themename_bundle_discount_description));
    }
}

/*------------------------------------*\
    Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('init', '_themename_scripts'); // Add Custom Scripts to wp_head
add_action('acf/init', '_themename_acf_op_init');
add_action('wp_enqueue_scripts', '_themename_styles'); // Add Theme Stylesheet
add_action('init', '_themename_register_menu'); // Add Theme Menu
add_action('init', '_themename_pagination'); // Add Theme Post Pagination
add_action('template_redirect', 'custom_track_product_view', 20);

add_action('woocommerce_product_options_general_product_data', 'woocommerce_product_custom_fields');
add_action('woocommerce_process_product_meta', 'woocommerce_product_custom_fields_save');
add_action('woocommerce_product_options_general_product_data', 'woocommerce_product_bundle_custom_fields');
add_action('woocommerce_process_product_meta', 'woocommerce_product_bundle_custom_fields_save');

// Remove Actions
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('get_custom_logo', '_themename_update_custom_logo'); // Updates class in custom logo link
add_filter('wp_nav_menu_objects', '_themename_nav_menu_icons', 10, 2);

// Yoast SEO filters
add_filter('wpseo_breadcrumb_separator', '_themename_wpseo_breadcrumb_separator', 10, 1);
add_filter('wpseo_breadcrumb_single_link', '_themename_wpseo_remove_breadcrumb_shop', 10, 2);
add_filter('wpseo_metabox_prio', '_themename_wpseo_meta_box_priority');

add_filter('woocommerce_product_add_to_cart_text', '_themename_woocommerce_custom_product_add_to_cart_text');

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether