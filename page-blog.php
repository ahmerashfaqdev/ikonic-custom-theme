<?php
/*
Template Name: Blog Page
*/
get_header(); ?>


<div class="ict-blog-container">

    <div class="ict-archive-title">
        <h1><?php the_title(); ?></h1>
    </div>
    

    <div class="ict-post-grid">
        <?php
        $args = array(
            'post_type'      => 'post',
            'posts_per_page' => -1, 
        );
        $query = new WP_Query($args);

        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post(); ?>
                <div class="ict-post-item">
                    <a href="<?php the_permalink(); ?>">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="ict-post-thumbnail">
                                <?php the_post_thumbnail('medium'); ?>
                            </div>
                        <?php endif; ?>
                        <div class="ict-post-content">
                            <h2 class="ict-post-title"><?php the_title(); ?></h2>
                            <p class="ict-post-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                        </div>
                    </a>
                </div>
            <?php endwhile;
            wp_reset_postdata();
        else : ?>
            <p>No posts found.</p>
        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>

