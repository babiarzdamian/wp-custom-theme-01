<?php
    $id             = isset($args['id']) ? $args['id'] : null;
    $background     = isset($args['background']) ? $args['background'] : null;
    
    $icon           = isset($args['icon']) ? $args['icon'] : null;
    $title          = isset($args['title']) ? $args['title'] : null;
    $subtitle       = isset($args['subtitle']) ? $args['subtitle'] : null;
    $link           = isset($args['link']) ? $args['link'] : null;
    
    $product_type   = isset($args['product_type']) ? $args['product_type'] : null;
    $products       = isset($args['products']) ? $args['products'] : null;

    $products_classlist = ['products'];
    $product_type ? array_push($products_classlist, 'products-' . $product_type) : null;
    in_array($background, ['white', 'light', 'blue']) ? array_push($products_classlist, 'products-bg-' . $background) : null;
?>

<section id="<?php echo $id?>">
    <div class="container position-relative">
        <div class="row <?php echo implode(' ', $products_classlist) ?>">
            <div class="col-12 col-xxl-3">
                <div class="products-background"></div>
                <div class="products-title">
                    <?php

                        get_template_part(
                            'template-components/component',
                            'title',
                            [
                                'icon' => $icon,
                                'title' => $title,
                                'subtitle' => $subtitle,
                            ]
                        )
                            
                    ?>
                    <?php if ($link) { ?>
                        <a href="<?php echo $link['url'] ?>" class="btn btn-dark btn-sm d-none d-lg-inline-block"><?php echo $link['title'] ?> <svg class="btn-arrow" xmlns="http://www.w3.org/2000/svg" width="9.188" height="15.55" viewBox="0 0 9.188 15.55"><path fill="none" stroke="currentColor" stroke-width="2" d="M.702.707l7.066 7.068-7.066 7.068"/></svg></a>
                    <?php } ?>
                </div>
            </div>
            
            <?php

                if ($product_type === 'bundle') {
                    get_template_part(
                        'template-parts/section',
                        'bundles',
                        [
                            'bundle_products' => $products
                        ]
                    );
                } else { ?>
                    <div class="col-12 col-xxl-9 product-row-wrapper">

                        <?php

                            get_template_part(
                                'template-parts/section',
                                'product_row',
                                [
                                    'products' => array_slice($products, 0, 10)
                                ]
                            );

                        ?>

                    </div>

                <?php } ?>

        </div>
    </div>
</section>


