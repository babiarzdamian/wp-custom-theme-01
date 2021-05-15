<section id="newsletter" class="newsletter">
    <div class="container">
        <?php 
        
            get_template_part( 
                'template-components/component', 
                'title', 
                [
                    'icon' => get_template_directory_uri() . '/dist/img/ICON-newsletter.svg',
                    'title' => 'Bądź na bieżąco',
                    'subtitle' => 'Subskrybuj nasz newsletter, dowiedz się więcej o produktach i promocjach',
                ] 
            );

        ?>

        <form class="newsletter-form" action="">
            <input class="form-control" type="email" placeholder="<?php _e('Wpisz adres email', '_themename') ?>">
            <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
            </div>
            <button type="submit" class="btn btn-light btn-sm fw-bold"><?php _e('Zapisz się', '_themename') ?> <svg class="btn-arrow" xmlns="http://www.w3.org/2000/svg" width="9.188" height="15.55" viewBox="0 0 9.188 15.55"><path fill="none" stroke="currentColor" stroke-width="2" d="M.702.707l7.066 7.068-7.066 7.068"/></svg></button>
        </form>
    </div>
</section>