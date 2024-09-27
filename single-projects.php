<?php get_header(); ?>

<div class="container ict-single-project">

    <?php while (have_posts()) : the_post(); ?>

        <div class="ict-project-header">
            <h1 class="ict-project-title"><?php the_title(); ?></h1>
            <?php if (has_post_thumbnail()) : ?>
                <div class="ict-project-featured-image">
                    <?php the_post_thumbnail('large'); ?>
                </div>
            <?php endif; ?>
        </div>

        <?php 
        // Fetch custom fields
        $project_name = get_post_meta(get_the_ID(), '_project_name', true);
        $project_description = get_post_meta(get_the_ID(), '_project_description', true);
        $project_start_date = get_post_meta(get_the_ID(), '_project_start_date', true);
        $project_end_date = get_post_meta(get_the_ID(), '_project_end_date', true);
        $project_url = get_post_meta(get_the_ID(), '_project_url', true);
        ?>

        <div class="ict-project-details">
            <h2>Project Information</h2>
            <table class="ict-project-info-table">
                <tr>
                    <th>Project Name:</th>
                    <td><?php echo esc_html($project_name); ?></td>
                </tr>
                <tr>
                    <th>Project Description:</th>
                    <td><?php echo esc_html($project_description); ?></td>
                </tr>
                <tr>
                    <th>Start Date:</th>
                    <td><?php echo esc_html($project_start_date); ?></td>
                </tr>
                <tr>
                    <th>End Date:</th>
                    <td><?php echo esc_html($project_end_date); ?></td>
                </tr>
                <tr>
                    <th>Project URL:</th>
                    <td><a href="<?php echo esc_url($project_url); ?>" target="_blank"><?php echo esc_html($project_url); ?></a></td>
                </tr>
            </table>
        </div>

        <div class="ict-project-content">
            <h2>About the Project</h2>
            <?php the_content(); ?>
        </div>

    <?php endwhile; ?>

</div>

<?php get_footer(); ?>
