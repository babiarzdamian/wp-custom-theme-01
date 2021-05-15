            <footer class="footer" role="contentinfo">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-2 order-last order-xl-first">
                            <?php
                                the_custom_logo();
                                wp_nav_menu([
                                    'theme_location'  => 'footer-menu',
                                    'container'       => '',
                                    'menu_class'      => 'footer-menu',
                                ]);
                            ?>
                        </div>
                        <div class="col-xl-10 order-first order-xl-last">
                            <div class="row">
                                <div class="col-12">
                                    <h2 class="h4"><?php _e('Nasze marki', '_themename') ?></h2>
                                    <div class="footer-brand-wrapper">
                                        <div class="footer-brand footer-brand-eko">
                                            <p>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="36.956" height="56.921" viewBox="0 0 36.956 56.921"><path fill="none" stroke="#fff" stroke-linecap="round" stroke-miterlimit="10" stroke-width="3" d="M16.506 54.806c3.566-4.178.777-10.969 6.967-10.969 7.966 0 11.977-7.25 11.982-12.733.013-14.324-19.41-29-19.41-29S-.587 24.181 1.72 34.997c1.724 8.082 11.207 8.815 15.842 8.827 5.91.015 1.564-27.759 1.564-27.759"/></svg>
                                                <?php _e('Produkty ekologiczne', '_themename') ?>
                                            </p>
                                            <a href="#" class="btn btn-outline-brand-le btn-xs"><?php _e('Brand-LE', '_themename') ?></a>
                                            <a href="#" class="btn btn-outline-bradn-b btn-xs"><?php _e('Brand-B Cleaning Products', '_themename') ?></a>
                                        </div>
                                        <div class="footer-brand footer-brand-primary">
                                            <p>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30"><defs><clipPath id="a"><path fill="#fff" stroke="#707070" d="M0 0h30v30H0z" data-name="Rectangle 77" transform="translate(63 48)"/></clipPath></defs><g clip-path="url(#a)" data-name="Mask Group 14" transform="translate(-63 -48)"><path fill="#fff" d="M86.438 53.625a2.813 2.813 0 10-2.812-2.812 2.812 2.812 0 002.812 2.813zm0-3.75a.937.937 0 11-.937.937.937.937 0 01.937-.937zM76.125 55.5a3.75 3.75 0 10-3.75-3.75 3.75 3.75 0 003.75 3.75zm0-5.625a1.875 1.875 0 11-1.875 1.875 1.875 1.875 0 011.875-1.875zm7.5 14.063h-11.25a4.688 4.688 0 000 9.375h11.25a4.688 4.688 0 000-9.375zm0 7.5h-11.25a2.8125 2.8125 0 110-5.625h11.25a2.813 2.813 0 010 5.625zm3.75-12.187H85.5a3.75 3.75 0 10-7.5 0h-9.375A5.625 5.625 0 0063 64.875v7.5A5.625 5.625 0 0068.625 78h18.75A5.625 5.625 0 0093 72.375v-7.5a5.625 5.625 0 00-5.625-5.625zm-5.625-1.876a1.875 1.875 0 11-1.875 1.875 1.875 1.875 0 011.875-1.875zm9.375 15a3.754 3.754 0 01-3.75 3.75h-18.75a3.754 3.754 0 01-3.75-3.75v-7.5a3.754 3.754 0 013.75-3.75h9.9a3.719 3.719 0 006.459 0h2.4a3.754 3.754 0 013.75 3.75z"/></g></svg>
                                                <?php _e('Inne znane i cenione', '_themename') ?>
                                            </p>
                                            <a href="#" class="btn btn-outline-primary btn-xs"><?php _e('Brand-L', '_themename') ?></a>
                                            <a href="#" class="btn btn-outline-primary btn-xs"><?php _e('Brand-BF', '_themename') ?></a>
                                            <a href="#" class="btn btn-outline-primary btn-xs"><?php _e('Brand-F', '_themename') ?></a>
                                            <a href="#" class="btn btn-outline-primary btn-xs"><?php _e('Brand-A', '_themename') ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-5 gx-2 footer-categories">
                                <?php
                                    $args = [
                                        'taxonomy'  => 'product_cat',
                                        'hide_empty' => false,
                                        'parent' => 0,
                                        'exclude' => [15, 17],
                                    ];
                                    $terms = get_terms($args);
                                    $single_terms = [];
                                ?>

                                <?php
                                    foreach ($terms as $term) {
                                        $thumbnail_id = get_term_meta($term->term_id, 'thumbnail_id', true);
                                        $image = wp_get_attachment_url($thumbnail_id);
                                        
                                        if ($child_terms = get_terms(['taxonomy'  => 'product_cat','parent' => $term->term_id, 'hide_empty' => false])) {
                                            ?>
                                        <div class="col">
                                            <p class="h4"><a class="footer-categories-link" href="<?php echo get_term_link($term) ?>"><img class="footer-categories-icon" src="<?php echo $image ?>" alt=""><?php echo $term->name ?></a></p>
                                            <ul class="footer-subcategories">
                                                <?php foreach ($child_terms as $child_term) { ?>
                                                    <li><a href="<?php echo get_term_link($term) ?>"><?php echo $child_term->name ?></a></li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    <?php
                                        } else {
                                            $single_terms[] = $term;
                                        } ?>
                                <?php
                                    } ?>

                                <div class="col">
                                    <?php
                                    foreach ($single_terms as $term) {
                                        $thumbnail_id = get_term_meta($term->term_id, 'thumbnail_id', true);
                                        $image = wp_get_attachment_url($thumbnail_id); ?>
                                        <p class="h4 mb-3"><a class="footer-categories-link" href="<?php echo get_term_link($term) ?>"><img class="footer-categories-icon" src="<?php echo $image ?>" alt=""><?php echo $term->name ?></a></p>  
                                    <?php
                                    } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 px-4">
                            <p class="footer-copy">
                            </p>
                        </div>
                    </div>
                </div>
            </footer>

        </div><!-- .page -->

        <?php wp_footer(); ?>

    </body>
</html>
