<?php get_header(); ?>

<div class="ict-single-post-container">
    <div class="ict-post-content">
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post(); ?>
                
                <h1 class="ict-post-title"><?php the_title(); ?></h1>
                
                <!-- Display the post metadata -->
                <div class="ict-post-meta">
                    <span class="ict-post-author">By <?php the_author(); ?></span> | 
                    <span class="ict-post-date">Published on <?php echo get_the_date(); ?></span>
                </div>
                
                <!-- Featured Image -->
                <?php if (has_post_thumbnail()) : ?>
                    <div class="ict-post-thumbnail">
                        <?php the_post_thumbnail('large'); ?>
                    </div>
                <?php endif; ?>
                
                <!-- Post content -->
                <div class="ict-post-body">
                    <?php the_content(); ?>
                </div>
                
                <!-- Categories and Tags -->
                <div class="ict-post-categories-tags">
                    <div class="ict-post-categories">
                        <strong>Categories:</strong> <?php the_category(', '); ?>
                    </div>
                    <div class="ict-post-tags">
                        <?php the_tags('<strong>Tags:</strong> ', ', '); ?>
                    </div>
                </div>
                
                <!-- Post navigation (previous/next post links) -->
                <div class="ict-post-navigation">
                    <div class="ict-prev-post"><?php previous_post_link('%link', '← Previous Post'); ?></div>
                    <div class="ict-next-post"><?php next_post_link('%link', 'Next Post →'); ?></div>
                </div>

            <?php endwhile;
        endif;
        ?>
    </div>
</div>

<?php get_footer(); ?>
