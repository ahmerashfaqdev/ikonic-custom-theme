<?php get_header(); ?>

<div class="container ict-projects-archive">

    <div class="ict-archive-title">
        <h1 class="ict-page-title">Our Projects</h1>    
    </div>
    
    <div class="ict-projects-filter-form">
        <form method="GET" action="">
            <label for="start_date">Start Date:</label>
            <input type="date" id="start_date" name="start_date" value="<?php echo esc_attr($_GET['start_date'] ?? ''); ?>">

            <label for="end_date">End Date:</label>
            <input type="date" id="end_date" name="end_date" value="<?php echo esc_attr($_GET['end_date'] ?? ''); ?>">

            <button type="submit">Filter</button>
        </form>
    </div>

    <div class="ict-archive-project-list">    
        <?php if (have_posts()) : ?>
            <div class="ict-projects-list">
                <?php while (have_posts()) : the_post(); ?>
                    <div class="ict-project-item">
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

                        <?php if (has_post_thumbnail()) : ?>
                            <div class="ict-project-thumbnail">
                                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium'); ?></a>
                            </div>
                        <?php endif; ?>

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
</div>

<?php get_footer(); ?>
