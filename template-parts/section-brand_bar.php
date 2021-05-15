<?php
    $id = isset($args['id']) ? $args['id'] : null;
?>
<section id="<?php echo $id?>" class="brand-bar<?php echo !wp_is_mobile() ? ' open' : null ?>">
    <div class="container position-relative">
        <div class="row brand-bar-row">
            <div class="col order-1 brand-bar-title">
                <span><?php _e('Poznaj nasze marki', '_themename') ?></span>
            </div>
            <div class="col order-2 order-lg-5 brand-bar-button">
                <button class="btn btn-xs btn-outline-primary d-none d-md-inline-block" data-toggle="brandbar" data-label-show="<?php _e('Powiększ', '_themename') ?>" data-label-hide="<?php _e('Zmniejsz', '_themename') ?>"><span>Zmniejsz</span> <svg class="btn-arrow" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 38.975 22.316"><path fill="none" stroke="currentColor" stroke-width="4" d="M1.414 1.415l18.072 18.073L37.56 1.415"/></svg></button>
                <button class="btn btn-xs fw-bold btn-outline-primary me-2 d-md-none" data-toggle="brandbar" data-label-show="<?php _e('Więcej', '_themename') ?>" data-label-hide="<?php _e('Schowaj', '_themename') ?>"><span>Więcej</span> <svg class="btn-arrow" xmlns="http://www.w3.org/2000/svg" width="8.478" height="5.652" viewBox="0 0 8.478 5.652"><path fill="none" stroke="currentColor" stroke-width="2" d="M.707 4.945l3.532-3.531 3.532 3.531"/></svg></button>
            </div>
            <div class="col-12 order-5 order-lg-2 col-lg-6 col-xxl-7 brand-bar-list">
                <?php
                    $args = [
                        'taxonomy'  => 'brand',
                        'hide_empty' => false,
                        'orderby'=>'ID',
                        'order' => 'ASC'
                    ];
                    $terms = get_terms($args);
                    foreach ($terms as $key => $term) {
                        $brand_url = get_term_link( $term );
                        $brand_icon = get_field('brand_icon', $term); ?>
                        <a class="brand-bar-link" href="<?php echo $brand_url ?>"><img class="brand-bar-logo" src="<?php echo $brand_icon ?>" alt=""></a>
                        <?php if (($key + 1) % 3 === 0) {?> 
                            <div class="clear d-flex d-md-none"></div>
                        <?php } ?>
                    <?php
                    } ?>
            </div>

        </div>
    </div>
</section>