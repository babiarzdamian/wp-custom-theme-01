<?php 
$product_id = isset($args['product']) ? $args['product'] : null;
$visual_preset = isset($args['visual_preset']) ? $args['visual_preset'] : null;

$card_classlist = ['card'];
$product_id ? array_push($card_classlist, 'card-product') : null;
$visual_preset && in_array($visual_preset, ['small', 'archive']) ? array_push($card_classlist, 'card-' . $visual_preset) : null;

$product = wc_get_product( $product_id );
?>

<div class="<?php echo implode(' ', $card_classlist) ?>">
    <?php /* echo get_the_post_thumbnail( $product_id, 'thumnail', ['class'=>'card-img-top'] ) */ ?>
    <?php echo $product->get_image( 'medium', ['class'=>'card-img-top']) ?>
    <div class="card-body">
        <h4 class="card-title"><?php echo get_the_title($product_id) ?></h4>
    </div>
    <?php if ($visual_preset !== 'small') { ?>
        <div class="card-info">
            <div class="card-price">
                <?php echo $product->get_price_html(); ?>
            </div>
            <a href="<?php echo get_permalink($product_id) ?>" class="btn btn-link fw-bold stretched-link">
                <svg class="btn-icon" xmlns="http://www.w3.org/2000/svg" width="34.267" height="29.657" viewBox="0 0 34.267 29.657"><g><path fill="currentColor" d="M27.6 7.258H7.214l-.437-2.23a1.2 1.2 0 00-1.177-.97h-5a.6.6 0 00-.6.6v1.2a.6.6 0 00.6.6h4.012l3.48 17.784a3.2 3.2 0 105.079.615h7.258a3.2 3.2 0 104.987-.707l.052-.238a1.2 1.2 0 00-1.174-1.454H10.188l-.47-2.4h15.62a1.2 1.2 0 001.173-.945l2.261-10.4A1.2 1.2 0 0027.6 7.258zm-17.2 20.4a1.2 1.2 0 111.2-1.2 1.2 1.2 0 01-1.2 1.2zm12.8 0a1.2 1.2 0 111.2-1.2 1.2 1.2 0 01-1.2 1.2zm1.172-10H9.249l-1.565-8H26.11z"/></svg>
                <span><?php _e('Kup', '_themename') ?></span>
            </a>
        </div>
    <?php } ?>
</div>