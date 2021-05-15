<?php get_header(); ?>

    <main role="main">
        
        <div class="mb-lg-2">
            <?php
                $hero_slides = get_field('hero_slides');
                if ($hero_slides) {
                    $index = array_rand($hero_slides);
                    $rand_slide = $hero_slides[ $index ];
    
                    get_template_part(
                        'template-parts/section',
                        'banner',
                        [
                            'hero' => true,
                            'scroll_btn' => "#zestawy",
                            'background' => $rand_slide['background'],
                            'image' => $rand_slide['image'],
                            'brand' => $rand_slide['brand'],
                            'label' => $rand_slide['label'],
                            'title' => $rand_slide['title'],
                            'description' => $rand_slide['description'],
                            'link' => $rand_slide['button']
                        ]
                    );
                }
            ?>
        </div>

        <?php                     
            $args = array(
                'post_type' => 'product',
                'posts_per_page' => 3,
                'orderby' => 'rand',
                'fields' => 'ids',
                'tax_query'=> array(
                    array(
                        'taxonomy' => 'product_type',
                        'field'    => 'slug',
                        'terms'    => 'bundle', 
                    ),
                ),
            );
            $bundle_products = new WP_Query( $args );
        ?>  

        <?php if ($bundle_products->have_posts()) { ?>
            <div class="mb-5">
                <?php

                    get_template_part(
                        'template-parts/section',
                        'products',
                        [
                            'id' => __('Zestawy', '_themename'),
                            'icon' => get_template_directory_uri() . '/dist/img/ICON-budle.svg',
                            'title' => __('Zestawy promocyjne', '_themename'),
                            'subtitle' => __('Przy zakupie zestawu oszczędzasz nawet do 50%', 'inoc'),
                            'link' => ['url'=>'#', 'title'=>__('Więcej zestawów', '_themename')],
                            'product_type' => 'bundle',
                            'products' => $bundle_products->posts
                        ]
                    );

                ?>
            </div>
        <?php } ?>

        <div class="mb-3">
            <?php
                get_template_part(
                    'template-parts/section',
                    'banner',
                    [
                        'content' => ['type'=>'component', 'content'=>'bestseller']
                    ]
                );
            ?>
        </div>

        <div class="mb-3">
            <?php
                get_template_part(
                    'template-parts/section',
                    'featured',
                    []
                );
            ?>
        </div>

        <div class="mb-5">
            <?php
                get_template_part(
                    'template-parts/section',
                    'products',
                    [
                        'background' => 'blue',
                        'icon' => get_template_directory_uri() . '/dist/img/ICON-popular.svg',
                        'title' => __('Popularne', '_themename'),
                        'subtitle' => __('Ulubione produkty wśród naszych klientów', '_themename'),
                        'link' => ['url'=>'#', 'title'=>__('Więcej popularnych', '_themename')],
                        'product_type' => 'popular',
                        'products' => [119,121,123,125,127,119,121,125,127]
                    ]
                );
            ?>
        </div>

        <div class="mb-5">

            <?php 
            
                get_template_part(
                    'template-parts/section',
                    'products',
                    [
                        'background' => 'light',
                        'icon' => get_template_directory_uri() . '/dist/img/ICON-clock-solid.svg',
                        'title' => __('Ostatnio oglądane', '_themename'),
                        'subtitle' => __('Tu zebraliśmy wszystko, czym się interesowałeś ostatnio', '_themename'),
                        'product_type' => 'recent',
                        'products' => _themename_get_recently_viewed_products()
                    ]
                );

            ?>

        </div>

        <div>
            <?php 

                get_template_part( 
                    'template-parts/section', 
                    'newsletter', 
                    [] 
                );
                
            ?>
        </div>

    </main>

<?php get_footer(); ?>
