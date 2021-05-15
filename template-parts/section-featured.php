
<?php 
$args = [        
    'post_type'           => 'product',
    'post_status'         => 'publish',
    'ignore_sticky_posts' => 1,
    'posts_per_page'      => 4,
    'fields'              => 'ids',
    'tax_query'           => [
        [
            'taxonomy' => 'product_visibility',
            'field'    => 'name',
            'terms'    => 'featured',
            'operator' => 'IN',
        ]
    ]
];
$grid = [7,5,5,7];
$i = 0;
$featured_query = new WP_Query( $args );
?>

<section>
    <div class="container">
        <div class="row gx-3">
            <?php foreach ($featured_query->posts as $featured) { ?>
                <div class="col-12 col-xxl-<?php echo $grid[$i++] ?>">
                    <?php

                        get_template_part(
                            'template-components/component',
                            'featured',
                            [
                                'product_id' => $featured,
                            ]
                        );
                    
                    ?>
                </div>
            <?php  } ?>
        </div>
    </div>
</section>