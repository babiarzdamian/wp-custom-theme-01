<?php get_header(); ?>

    <main role="main">
        <section>
            <div class="container">
                <?php

                get_template_part('template-components/component', 'breadcrumbs');

                get_template_part(
                    'template-components/component',
                    'title',
                    [
                        'title'         => __('Wyniki wyszukiwania', '_themename'),
                        'description'   => __('Szukasz frazy: ', '_themename') . get_search_query(),
                        ]
                );

                get_template_part('loop');

                get_template_part('pagination'); 
                
                ?>

            </div>
        </section>
    </main>

<?php get_footer(); ?>
