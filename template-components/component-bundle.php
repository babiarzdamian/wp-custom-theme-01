<?php 
$product_id = isset($args['product_id']) ? $args['product_id'] : null;
$discount = isset($args['discount']) && is_array($args['discount']) ? $args['discount'] : null;

$product = wc_get_product( $product_id );
$brand = get_the_terms( $product_id, 'brand' );
?>

<div class="bundle bundle-<?php echo $brand[0]->slug ?>">
    <div class="bundle-content">
        <?php 

            get_template_part(
                'template-components/component',
                'title',
                [
                    'brand' => $brand[0],
                    'title' => $product->get_name(),
                    'heading_level' => 3,
                ]
            )

        ?>
        <p class="pill pill-bg"><?php echo $discount['count'] ?></p>
        <div class="bundle-description">
            <?php if($description = $discount['description']) { ?>
                <p class="bundle-description-title"><?php echo $description['title'] ?></p>
                <p class="bundle-description-content"><?php echo !empty($description['content']) ? $description['content'] : null ?></p>
            <?php } ?>
        </div>

        <div class="bundle-cart">
            <p class="pill"><?php echo $product->get_price_html() ?></p>
            <a href="<?php echo $product->add_to_cart_url() ?>" class="btn btn-dark btn-sm fw-bold add_to_cart_button ajax_add_to_cart" data-product_id="<?php echo $product_id ?>" data-quantity="1">
                <svg class="btn-icon" xmlns="http://www.w3.org/2000/svg" width="34.267" height="29.657" viewBox="0 0 34.267 29.657"><g><path fill="currentColor" d="M27.6 7.258H7.214l-.437-2.23a1.2 1.2 0 00-1.177-.97h-5a.6.6 0 00-.6.6v1.2a.6.6 0 00.6.6h4.012l3.48 17.784a3.2 3.2 0 105.079.615h7.258a3.2 3.2 0 104.987-.707l.052-.238a1.2 1.2 0 00-1.174-1.454H10.188l-.47-2.4h15.62a1.2 1.2 0 001.173-.945l2.261-10.4A1.2 1.2 0 0027.6 7.258zm-17.2 20.4a1.2 1.2 0 111.2-1.2 1.2 1.2 0 01-1.2 1.2zm12.8 0a1.2 1.2 0 111.2-1.2 1.2 1.2 0 01-1.2 1.2zm1.172-10H9.249l-1.565-8H26.11z"/></svg>
                <span class="d-none d-lg-inline"><?php _e('Dodaj do koszyka', '_themename') ?></span>
                <span class="d-lg-none"><?php _e('Do koszyka', '_themename') ?></span>
            </a>
        </div>

        <a href="<?php echo get_permalink( $product_id ) ?>" class="btn btn-sm btn-link mt-3 fw-bold"><?php _e('Więcej', '_themename') ?> <svg class="btn-arrow" xmlns="http://www.w3.org/2000/svg" width="9.188" height="15.55" viewBox="0 0 9.188 15.55"><path fill="none" stroke="currentColor" stroke-width="2" d="M.702.707l7.066 7.068-7.066 7.068"/></svg></a>
    </div>
    <?php if (get_field('bundle_image', $product_id ) || has_post_thumbnail( $product_id )) { ?>
        <div class="bundle-image">
            <?php echo get_the_post_thumbnail( $product_id, 'medium', ['class'=>'bundle-image'] ) ?>
        </div>
    <?php } else { ?>
        <div class="bundle-list">
            <div class="splide">
                <div class="splide__track">
                    <div class="splide__list">
                        <?php 
                            // To jest do poprawy jeszcze jak będzie plugin
                            $bundle_ids = WC_PB_DB::query_bundled_items( array(
                                'return'    => 'id => product_id',
                                'bundle_id' => $product_id,
                            ) );
                            if($bundle_ids) {
                                foreach ($bundle_ids as $bundle_product) { ?>
                                
                                    <div class="splide__slide">
                                        <?php 
                                        get_template_part( 
                                            'template-components/component', 
                                            'card', 
                                            [
                                                'product' => $bundle_product['product_id'],
                                                'visual_preset' => 'small',
                                            ]
                                        ) 
                                        
                                        ?>
                                    </div>
                                <?php }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>