<?php 
    $bundle_products = isset($args['bundle_products']) ? $args['bundle_products'] : null;
    if ($bundle_products) { 
?>

    <div class="col-auto d-block d-lg-none">
        <div class="splide">
            <div class="splide__track">
                <div class="splide__list">
                    <?php foreach ($bundle_products as $product) { ?>
                        <div class="splide__slide">

                        <?php
                        
                            get_template_part(
                                'template-components/component',
                                'bundle',
                                [
                                    'product_id' => $product,
                                    'discount' => [
                                        'count' => get_post_meta($product, '__themename_bundle_discount_amount', true),
                                        'description' => [
                                            'title' => get_post_meta($product, '__themename_bundle_discount_title', true),
                                            'content' => get_post_meta($product, '__themename_bundle_discount_description', true),
                                        ],
                                    ],
                                    'image' => 'asd'
                                ]
                            );

                        ?> 
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <a href="#" class="btn btn-dark btn-sm d-lg-none mt-5"><?php _e('Więcej zestawów', '_themename') ?> <svg class="btn-arrow" xmlns="http://www.w3.org/2000/svg" width="9.188" height="15.55" viewBox="0 0 9.188 15.55"><path fill="none" stroke="currentColor" stroke-width="2" d="M.702.707l7.066 7.068-7.066 7.068"/></svg></a>
    </div>

    <div class="col-12 col-xxl-3 mb-3 mb-xxl-0 d-none d-lg-flex">
        <?php
            $featured_id = array_splice($bundle_products, 0, 1);

            get_template_part(
                'template-components/component',
                'bundle',
                [
                    'product_id' => $featured_id[0],
                    'discount' => [
                        'count' => get_post_meta($featured_id[0], '__themename_bundle_discount_amount', true),
                        'description' => [
                            'title' => get_post_meta($featured_id[0], '__themename_bundle_discount_title', true),
                            'content' => get_post_meta($featured_id[0], '__themename_bundle_discount_description', true),
                        ],
                    ],
                    'image' => 'asd'
                ]
            );

        ?>
    </div>
    <div class="col-12 col-xxl-6 mt-3 mt-xxl-0 d-none d-lg-flex">
        <?php
            foreach ($bundle_products as $product) {
                get_template_part(
                    'template-components/component',
                    'bundle',
                    [
                        'product_id' => $product,
                        'discount' => [
                            'count' => get_post_meta($product, '__themename_bundle_discount_amount', true),
                            'description' => [
                                'title' => get_post_meta($product, '__themename_bundle_discount_title', true),
                                'content' => get_post_meta($product, '__themename_bundle_discount_description', true),
                            ],
                        ],
                        'image' => 'asd',
                    ]
                );
            }
        ?>    
    </div>

<?php } ?>