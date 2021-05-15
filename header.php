<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="<?php bloginfo('description'); ?>">

        <?php wp_head(); ?>

    </head>
    <body <?php body_class(WC()->cart->cart_contents_count == 0 ? 'cart-empty' : null); ?>>

        <div class="page">

            <header class="header clear" role="banner">
                <nav class="navbar navbar-expand-lg fixed-top">
                    <div class="container">
                        <?php the_custom_logo(); ?>
                        <span class="navbar-text lead">
                            <?php _e('Sklep Firmowy', '_themename') ?>
                        </span>
                        <button class="btn navbar-toggle" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="<?php _e('Otwórz głowne menu nawigacyjne', '_themename') ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32.38" height="32.379" viewBox="0 0 32.38 32.379"><g fill="none" stroke="#000" stroke-width="3"><g><rect width="14.566" height="14.567" stroke="none" rx="3"/><rect width="11.566" height="11.567" x="1.5" y="1.5" rx="1.5"/></g><g transform="translate(0 17.813)"><rect width="14.566" height="14.567" stroke="none" rx="3"/><rect width="11.566" height="11.567" x="1.5" y="1.5" rx="1.5"/></g><g transform="translate(17.813 17.813)"><rect width="14.566" height="14.567" stroke="none" rx="3"/><rect width="11.566" height="11.567" x="1.5" y="1.5" rx="1.5"/></g><g transform="translate(17.813)"><rect width="14.566" height="14.567" stroke="none" rx="3"/><rect width="11.566" height="11.567" x="1.5" y="1.5" rx="1.5"/></g></g></svg>
                            <span class="lead fs-4 ms-2 d-none d-lg-inline"><?php _e('Nasze produkty', '_themename') ?></span>
                        </button>
                        <button class="btn btn-circle" type="button" data-bs-toggle="offcanvas" data-bs-target="#searchForm" aria-controls="searchForm" aria-label="<?php _e('Otwórz pole wyszukiwania', '_themename') ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24.071" height="24.071" viewBox="0 0 24.071 24.071"><path d="M23.905 22.043L18.2 16.336a.558.558 0 00-.4-.165h-.621a9.776 9.776 0 10-1.006 1.006v.623a.578.578 0 00.165.4l5.706 5.7a.565.565 0 00.8 0l1.062-1.062a.565.565 0 00-.001-.795zM9.778 17.3A7.522 7.522 0 1117.3 9.778 7.52 7.52 0 019.778 17.3z"/></svg>
                        </button>
                        <a class="navbar-cart btn btn-circle" href="<?php echo wc_get_cart_url() ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="34.267" height="29.657" viewBox="0 0 34.267 29.657"><g><path d="M27.6 7.258H7.214l-.437-2.23a1.2 1.2 0 00-1.177-.97h-5a.6.6 0 00-.6.6v1.2a.6.6 0 00.6.6h4.012l3.48 17.784a3.2 3.2 0 105.079.615h7.258a3.2 3.2 0 104.987-.707l.052-.238a1.2 1.2 0 00-1.174-1.454H10.188l-.47-2.4h15.62a1.2 1.2 0 001.173-.945l2.261-10.4A1.2 1.2 0 0027.6 7.258zm-17.2 20.4a1.2 1.2 0 111.2-1.2 1.2 1.2 0 01-1.2 1.2zm12.8 0a1.2 1.2 0 111.2-1.2 1.2 1.2 0 01-1.2 1.2zm1.172-10H9.249l-1.565-8H26.11z"/><circle class="navbar-cart-indicator" cx="6.455" cy="6.455" r="6.455" fill="#dca958" transform="translate(21.357)"/></g></svg>
                        </a>
                        <a class="navbar-cart btn btn-circle d-none d-lg-flex" href="<?php echo wc_get_page_permalink( 'myaccount' ) ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22.556" height="25.779" viewBox="0 0 22.556 25.779"><path d="M15.789 15.306c-1.445 0-2.14.806-4.511.806s-3.061-.806-4.511-.806A6.769 6.769 0 000 22.073v1.289a2.417 2.417 0 002.417 2.417H20.14a2.417 2.417 0 002.417-2.417v-1.289a6.769 6.769 0 00-6.768-6.767zm4.35 8.056H2.417v-1.289a4.358 4.358 0 014.35-4.35c.735 0 1.928.806 4.511.806 2.6 0 3.771-.806 4.511-.806a4.358 4.358 0 014.35 4.35zM11.278 14.5a7.25 7.25 0 10-7.25-7.25 7.252 7.252 0 007.25 7.25zm0-12.084A4.833 4.833 0 116.445 7.25a4.841 4.841 0 014.833-4.833z"/></svg>
                        </a>
                    </div>
                </nav>
                <?php get_search_form() ?>
            </header>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar">
                <div class="offcanvas-body">
                <?php
                    wp_nav_menu([
                        'theme_location'  => 'header-menu',
                        'container'       => '',
                        'menu_class'      => 'menu menu-header',
                    ]);
                ?>
                </div>
            </div>

            <?php
                get_template_part('template-parts/section', 'brand_bar') 
            ?> 

