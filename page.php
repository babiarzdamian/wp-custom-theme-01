<?php get_header(); ?>

    <main role="main">

        <section>
            <div class="container">
                <div class="row">
                    <div class="col-12">

                        <?php while ( have_posts() ) : the_post(); ?>

                            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                <?php echo the_content(); ?>
                            </article>

                        <?php endwhile; ?>

                    </div>
                </div>
            </div>
        </section>
        
    </main>

<?php get_footer(); ?>
