<?php 
$product_id = isset($args['product_id']) ? $args['product_id'] : null;
$discount = isset($args['discount']) && is_array($args['discount']) ? $args['discount'] : null;

$product = wc_get_product( $product_id );
$brand = get_the_terms( $product_id, 'brand' );
?>

<div class="featured featured-<?php echo $brand[0]->slug ?>">
    <div class="featured-content">
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

        <div class="featured-cart">
            <p class="pill pill-bg"><?php echo $product->get_price_html() ?></p>
            <div class="separator d-none"></div>
            <a href="<?php echo $product->add_to_cart_url() ?>" class="btn btn-outline-dark add_to_cart_button ajax_add_to_cart d-none d-lg-inline-block" data-product_id="<?php echo $product_id ?>" data-quantity="1">
                <svg class="btn-icon" xmlns="http://www.w3.org/2000/svg" width="34.267" height="29.657" viewBox="0 0 34.267 29.657"><g><path fill="currentColor" d="M27.6 7.258H7.214l-.437-2.23a1.2 1.2 0 00-1.177-.97h-5a.6.6 0 00-.6.6v1.2a.6.6 0 00.6.6h4.012l3.48 17.784a3.2 3.2 0 105.079.615h7.258a3.2 3.2 0 104.987-.707l.052-.238a1.2 1.2 0 00-1.174-1.454H10.188l-.47-2.4h15.62a1.2 1.2 0 001.173-.945l2.261-10.4A1.2 1.2 0 0027.6 7.258zm-17.2 20.4a1.2 1.2 0 111.2-1.2 1.2 1.2 0 01-1.2 1.2zm12.8 0a1.2 1.2 0 111.2-1.2 1.2 1.2 0 01-1.2 1.2zm1.172-10H9.249l-1.565-8H26.11z"/></svg>
                <span class=""><?php _e('Dodaj do koszyka', '_themename') ?></span>
            </a>
            <a href="<?php echo $product->add_to_cart_url() ?>" class="btn btn-outline-dark btn-sm fw-bold add_to_cart_button ajax_add_to_cart d-lg-none" data-product_id="<?php echo $product_id ?>" data-quantity="1">
                <svg class="btn-icon" xmlns="http://www.w3.org/2000/svg" width="34.267" height="29.657" viewBox="0 0 34.267 29.657"><g><path fill="currentColor" d="M27.6 7.258H7.214l-.437-2.23a1.2 1.2 0 00-1.177-.97h-5a.6.6 0 00-.6.6v1.2a.6.6 0 00.6.6h4.012l3.48 17.784a3.2 3.2 0 105.079.615h7.258a3.2 3.2 0 104.987-.707l.052-.238a1.2 1.2 0 00-1.174-1.454H10.188l-.47-2.4h15.62a1.2 1.2 0 001.173-.945l2.261-10.4A1.2 1.2 0 0027.6 7.258zm-17.2 20.4a1.2 1.2 0 111.2-1.2 1.2 1.2 0 01-1.2 1.2zm12.8 0a1.2 1.2 0 111.2-1.2 1.2 1.2 0 01-1.2 1.2zm1.172-10H9.249l-1.565-8H26.11z"/></svg>
                <span><?php _e('Do koszyka', '_themename') ?></span>
            </a>
        </div>

        <a href="<?php echo get_permalink( $product_id ) ?>" class="btn btn-sm btn-link mt-3 fw-bold"><?php _e('Więcej', '_themename') ?> <svg class="btn-arrow" xmlns="http://www.w3.org/2000/svg" width="9.188" height="15.55" viewBox="0 0 9.188 15.55"><path fill="none" stroke="currentColor" stroke-width="2" d="M.702.707l7.066 7.068-7.066 7.068"/></svg></a>
    </div>
    <div class="featured-image">
        <?php 
            echo
            get_field('featured_image', $product_id) 
            ? wp_get_attachment_image( get_field('featured_image', $product_id), 'large') 
            : get_the_post_thumbnail($product_id , 'medium', ['class'=>'bundle-image'] );
        ?>
    </div>
</div>