<?php
/*
Template Name: Custom Home Page
*/
get_header(); ?>

<div class="container">
    <div class="ict-home-banner-section">
    	<div class="ict-home-banner-image" style="background-image: url(<?php echo esc_url( get_template_directory_uri() . '/assets/images/home-bg.jpg' ); ?>);">
    		<div class="ict-home-banner-content">
    			<h1>Welcome to Custom Projects</h1>
    			<p>This is a custom static page.</p>
    		</div>
    	</div>
    </div>
    <div class="ict-home-project-section">
    	<div class="ict-home-project-heading">
    		<h2>Latest Projects</h2>
    	</div>
    	<?php $args = array(
            'post_type'      => 'projects',
            'posts_per_page' => 3,
        );
        $projects_query = new WP_Query($args);
    	if ($projects_query->have_posts()) : ?>
	        <div class="ict-projects-list">
	            <?php while ($projects_query->have_posts()) : $projects_query->the_post(); ?>
	                <div class="ict-project-item">
	                    <?php if (has_post_thumbnail()) : ?>
	                        <div class="ict-project-thumbnail">
	                            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium'); ?></a>
	                        </div>
	                    <?php endif; ?>
	                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	                    <p><?php echo wp_trim_words(get_the_content(), 20); ?></p>
	                    <a class="ict-project-link" href="<?php the_permalink(); ?>">Read More</a>
	                </div>
	            <?php endwhile; ?>
	        </div>

	        <div class="ict-pagination">
	            <?php echo paginate_links(); ?>
	        </div>
	    <?php else : ?>
	        <p>No projects found.</p>
	    <?php endif; ?>
    </div>
    <div class="ict-home-blog-section">
    	<div class="ict-home-blog-heading">
    		<h2>Latest Blogs</h2>
    	</div>
    	<div class="ict-post-grid">
	        <?php
	        $args = array(
	            'post_type'      => 'post',
	            'posts_per_page' => 3, 
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
</div>

<?php get_footer(); ?>
