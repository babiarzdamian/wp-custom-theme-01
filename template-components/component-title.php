<?php
    $brand          = isset($args['brand']) ? $args['brand'] : null;
    $icon           = isset($args['icon']) ? $args['icon'] : null;
    $label          = isset($args['label']) ? $args['label'] : null;
    $title          = isset($args['title']) ? $args['title'] : null;
    $heading_level  = isset($args['heading_level']) ? $args['heading_level'] : 2;
    $separator      = isset($args['separator']);
    $subtitle       = isset($args['subtitle']) ? $args['subtitle'] : null;
    $link           = isset($args['link']) ? $args['link'] : null;

    $title_classlist = ['title'];
    $separator ? array_push($title_classlist, 'title-separator') : null;
?>
<div class="<?php echo implode(' ', $title_classlist) ?>">
    <?php if ($brand && $brand_icon = get_field('brand_icon', $brand)) { ?>
        <img class="title-icon" src="<?php echo $brand_icon ?>" alt="">
        <p class="title-label text-<?php echo $brand->slug ?>"><?php echo $label ?></p>
    <?php } elseif ($icon) { ?>
        <img class="title-icon" src="<?php echo $icon ?>" alt="">
    <?php } ?>
    <h<?php echo $heading_level?> class="title-main"><?php echo $title; ?></h<?php echo $heading_level?>>
    <p class="title-subtitle"><?php echo $subtitle; ?></p>
    <?php if ($link) { ?>
        <a href="<?php echo $link['url'] ?>" class="btn btn-primary title-cta" target="<?php echo $link['target'] ?>"><?php echo $link['title'] ?> <svg class="btn-arrow" xmlns="http://www.w3.org/2000/svg" width="9.188" height="15.55" viewBox="0 0 9.188 15.55"><path fill="none" stroke="currentColor" stroke-width="2" d="M.702.707l7.066 7.068-7.066 7.068"/></svg></a>
    <?php } ?>
</div>