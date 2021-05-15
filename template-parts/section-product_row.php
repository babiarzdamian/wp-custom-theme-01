<?php
    $force_slider   = isset($args['force_slider']);
    $products       = isset($args['products']) ? $args['products'] : null;
?>

<?php if (!$force_slider) { ?>
    <div class="product-row d-none d-lg-flex">
        <?php foreach ($products as $product) { ?>
            <?php

                get_template_part(
                    'template-components/component',
                    'card',
                    [
                        'product' => $product
                    ]
                )

            ?>
        <?php } ?>
    </div>
<?php } ?>
<div class="product-row d-block d-lg-none">
    <div class="splide" data-gap="30px">
        <div class="splide__track">
            <div class="splide__list">
                <?php foreach ($products as $product) { ?>
                    <div class="splide__slide">
                    
                    <?php

                        get_template_part(
                            'template-components/component',
                            'card',
                            [
                                'product' => $product
                            ]
                        )
                        
                    ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
