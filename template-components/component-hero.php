<?php
    $title          = isset($args['title']) ? $args['title'] : null;
    $description    = isset($args['description']) ? $args['description'] : null;
    $link           = isset($args['link']) ? $args['link'] : null;
?>

<div class="title title-force-separator">
    <h2 class="title-main"><?php echo $title; ?></h2>
    <p class="title-subtitle"><?php echo $description; ?></p>
    <?php if ($link) { ?>
        <a href="<?php echo $link['url'] ?>" class="btn btn-primary btn-lg title-cta" target="<?php echo $link['target'] ?>"><?php echo $link['title'] ?></a>
    <?php } ?>
</div>