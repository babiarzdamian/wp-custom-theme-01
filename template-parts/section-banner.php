<?php
    $hero           = isset($args['hero']) ? $args['hero'] : null;
    $background     = isset($args['background']) ? $args['background'] : null;
    $image          = isset($args['image']) ? $args['image'] : null;
    $id             = isset($args['id']) ? $args['id'] : null;
    $overlay        = isset($args['overlay']) ? $args['overlay'] : null;
    $scroll_btn     = isset($args['scroll_btn']) ? $args['scroll_btn'] : null;

    $brand          = isset($args['brand']) ? $args['brand'] : null;
    $label          = isset($args['label']) ? $args['label'] : null;
    $title          = isset($args['title']) ? $args['title'] : null;
    $description    = isset($args['description']) ? $args['description'] : null;
    $link           = isset($args['link']) ? $args['link'] : null;

    $content        = isset($args['content']) && is_array($args['content']) ? $args['content'] : null;

    $banner_classlist = ['banner'];
    $hero ? array_push($banner_classlist, 'banner-hero') : null;
?>
<section id="<?php echo $id?>" class="<?php echo implode(' ', $banner_classlist) ?>">
    <div class="container position-relative">
        <div class="row">
            <div class="col-12">
                <div class="banner-content">
                    <?php if ($background) { ?>
                        <div class="banner-bg <?php echo $overlay ? 'banner-bg-overlay-' . $overlay : null ?>">
                            <img src="<?php echo $background['url'] ?>" alt="<?php echo $background['alt'] ?>" loading="auto">
                        </div>
                    <?php } elseif ($brand) { ?> 
                        <div class="banner-bg banner-bg-<?php echo $brand->slug ?>"></div>
                    <?php } ?>

                    <?php if ($hero) { ?>   
                        <div class="row">
                            <div class="col-12 col-sm-8 col-lg-auto banner-text">
                                <?php
                                    get_template_part(
                                        'template-components/component',
                                        'title',
                                        [
                                            'separator' => true,
                                            'brand' => $brand,
                                            'label' => $label,
                                            'title' => $title,
                                            'subtitle' => $description,
                                            'link' => $link
                                        ]
                                    );
                                ?>
                            </div>
                        </div>
                        <img class="banner-image" src="<?php echo $image['url'] ?>" alt="<?php echo $image['alt'] ?>" loading="auto">
                    <?php
                        } elseif ($content) {
                            get_template_part(
                                $content['type'] === 'section' ? 'template-parts/' : 'template-' . $content['type'] . 's/' . $content['type'],
                                $content['content']
                            );
                        }
                    ?>
                </div>
            </div>
        </div>
        <?php if($scroll_btn) { ?>
            <a class="banner-scroll-btn" href="<?php echo $scroll_btn ?>"><svg xmlns="http://www.w3.org/2000/svg" width="38.975" height="22.316" viewBox="0 0 38.975 22.316"><path fill="none" stroke="currentColor" stroke-width="4" d="M1.414 1.415l18.072 18.073L37.56 1.415"/></svg></a>
        <?php } ?>
    </div>
</section>