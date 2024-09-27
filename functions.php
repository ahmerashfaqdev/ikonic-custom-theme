<?php

	// Enqueue styles and scripts
	function ict_theme_enqueue_styles() {
    	wp_enqueue_style('style', get_stylesheet_uri());
	}
	add_action('wp_enqueue_scripts', 'ict_theme_enqueue_styles');

	// Add theme support
	function ict_theme_setup_functions() {
    	add_theme_support('post-thumbnails');
    	add_theme_support('custom-logo');
    	add_theme_support('title-tag');
	}
	add_action('after_setup_theme', 'ict_theme_setup_functions');

	// register custom sidebar
	function ict_theme_widgets_sidebar() {
    	register_sidebar(array(
        	'name' => 'Sidebar',
        	'id' => 'sidebar-1',
        	'before_widget' => '<div class="widget">',
        	'after_widget' => '</div>',
        	'before_title' => '<h2 class="widget-title">',
        	'after_title' => '</h2>',
    	));
	}
	add_action('widgets_init', 'ict_theme_widgets_sidebar');


	/******** Custom Post Type ********/

	// Register Custom Post Type for Projects
	function ict_create_projects_post_type() {
	    $labels = array(
	        'name'               => _x('Projects', 'Post Type General Name', 'ict'),
	        'singular_name'      => _x('Project', 'Post Type Singular Name', 'ict'),
	        'menu_name'          => __('Projects', 'ict'),
	        'name_admin_bar'     => __('Project', 'ict'),
	        'add_new_item'       => __('Add New Project', 'ict'),
	        'new_item'           => __('New Project', 'ict'),
	        'edit_item'          => __('Edit Project', 'ict'),
	        'view_item'          => __('View Project', 'ict'),
	        'all_items'          => __('All Projects', 'ict'),
	        'search_items'       => __('Search Projects', 'ict'),
	        'not_found'          => __('No Projects found', 'ict'),
	        'not_found_in_trash' => __('No Projects found in Trash', 'ict'),
	    );

	    $args = array(
	        'label'              => __('Projects', 'ict'),
	        'description'        => __('A custom post type for projects', 'ict'),
	        'labels'             => $labels,
	        'supports'           => array('title', 'editor', 'thumbnail', 'revisions'),
	        'hierarchical'       => false,
	        'public'             => true,
	        'show_ui'            => true,
	        'show_in_menu'       => true,
	        'menu_position'      => 5,
	        'show_in_admin_bar'  => true,
	        'show_in_nav_menus'  => true,
	        'can_export'         => true,
	        'has_archive'        => true,
	        'exclude_from_search'=> false,
	        'publicly_queryable' => true,
	        'capability_type'    => 'post',
	        'menu_icon'          => 'dashicons-portfolio', // Dashicon for the Projects menu
	    );

	    register_post_type('projects', $args);
	}
	add_action('init', 'ict_create_projects_post_type');

	// Add custom meta boxes for Projects
	function ict_add_projects_meta_boxes() {
	    add_meta_box(
	        'projects_meta_box',
	        'Project Details',
	        'ict_projects_meta_box_callback',
	        'projects',
	        'normal',
	        'high'
	    );
	}
	add_action('add_meta_boxes', 'ict_add_projects_meta_boxes');

	// Callback function to render the meta box
	function ict_projects_meta_box_callback($post) {

	    // fetch existing values from the database
	    $project_name = get_post_meta($post->ID, '_project_name', true);
	    $project_description = get_post_meta($post->ID, '_project_description', true);
	    $project_start_date = get_post_meta($post->ID, '_project_start_date', true);
	    $project_end_date = get_post_meta($post->ID, '_project_end_date', true);
	    $project_url = get_post_meta($post->ID, '_project_url', true);

	    // Nonce field for security
	    wp_nonce_field('save_project_meta', 'project_meta_nonce');

	    ?>
		    <p>
		        <label for="project_name">Project Name:</label><br>
		        <input type="text" id="project_name" name="project_name" value="<?php echo esc_attr($project_name); ?>" style="width: 100%;">
		    </p>
		    <p>
		        <label for="project_description">Project Description:</label><br>
		        <textarea id="project_description" name="project_description" style="width: 100%;"><?php echo esc_textarea($project_description); ?></textarea>
		    </p>
		    <p>
		        <label for="project_start_date">Project Start Date:</label><br>
		        <input type="date" id="project_start_date" name="project_start_date" value="<?php echo esc_attr($project_start_date); ?>" style="width: 100%;">
		    </p>
		    <p>
		        <label for="project_end_date">Project End Date:</label><br>
		        <input type="date" id="project_end_date" name="project_end_date" value="<?php echo esc_attr($project_end_date); ?>" style="width: 100%;">
		    </p>
		    <p>
		        <label for="project_url">Project URL:</label><br>
		        <input type="url" id="project_url" name="project_url" value="<?php echo esc_attr($project_url); ?>" style="width: 100%;">
		    </p>
	    <?php
	}

	// Save custom meta data
	function ict_save_projects_meta_data($post_id) {
	    // Check nonce for security
	    if (!isset($_POST['project_meta_nonce']) || !wp_verify_nonce($_POST['project_meta_nonce'], 'save_project_meta')) {
	        return;
	    }

	    // Check autosave
	    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
	        return;
	    }

	    // Check user permissions
	    if (!current_user_can('edit_post', $post_id)) {
	        return;
	    }

	    // Save or update Project Name
	    if (isset($_POST['project_name'])) {
	        update_post_meta($post_id, '_project_name', sanitize_text_field($_POST['project_name']));
	    }

	    // Save or update Project Description
	    if (isset($_POST['project_description'])) {
	        update_post_meta($post_id, '_project_description', sanitize_textarea_field($_POST['project_description']));
	    }

	    // Save or update Project Start Date
	    if (isset($_POST['project_start_date'])) {
	        update_post_meta($post_id, '_project_start_date', sanitize_text_field($_POST['project_start_date']));
	    }

	    // Save or update Project End Date
	    if (isset($_POST['project_end_date'])) {
	        update_post_meta($post_id, '_project_end_date', sanitize_text_field($_POST['project_end_date']));
	    }

	    // Save or update Project URL
	    if (isset($_POST['project_url'])) {
	        update_post_meta($post_id, '_project_url', esc_url_raw($_POST['project_url']));
	    }
	}
	add_action('save_post', 'ict_save_projects_meta_data');


	/******** Dynamic Navigation Menu ********/

	// Register a custom navigation menu
	function ict_register_custom_navigation_menu() {
	    register_nav_menus(array(
	        'primary_menu' => __('Primary Menu', 'ict'),
	    ));
	}
	add_action('init', 'ict_register_custom_navigation_menu');

	// Custom Walker Class for Multi-Level Dropdown Menus
	class Custom_Walker_Nav_Menu extends Walker_Nav_Menu {
	    // Add classes to <li> and <a> elements
	    function start_lvl(&$output, $depth = 0, $args = array()) {
	        $indent = str_repeat("\t", $depth);
	        $output .= "\n$indent<ul class=\"sub-menu\">\n";
	    }

	    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
	        $indent = ($depth) ? str_repeat("\t", $depth) : '';
	        $class_names = $value = '';

	        // Check if item has children (dropdown)
	        $classes = empty($item->classes) ? array() : (array) $item->classes;
	        $classes[] = 'menu-item-' . $item->ID;

	        // Add class for dropdown if item has children
	        if ($args->walker->has_children) {
	            $classes[] = 'dropdown';
	        }

	        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
	        $class_names = ' class="' . esc_attr($class_names) . '"';

	        $output .= $indent . '<li' . $class_names .'>';

	        // Add attributes to anchor tags
	        $attributes  = !empty($item->attr_title) ? ' title="'  . esc_attr($item->attr_title) .'"' : '';
	        $attributes .= !empty($item->target)     ? ' target="' . esc_attr($item->target    ) .'"' : '';
	        $attributes .= !empty($item->xfn)        ? ' rel="'    . esc_attr($item->xfn       ) .'"' : '';
	        $attributes .= !empty($item->url)        ? ' href="'   . esc_attr($item->url       ) .'"' : '';

	        // Add class to <a> if item has children (dropdown)
	        $item_output = $args->before;
	        $item_output .= '<a'. $attributes .' class="menu-link">';
	        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
	        
	        // Add dropdown arrow for parent menu items
	        if ($args->walker->has_children) {
	            $item_output .= ' <span class="dropdown-toggle">&#x25BC;</span>'; // Dropdown arrow
	        }
	        
	        $item_output .= '</a>';
	        $item_output .= $args->after;

	        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
	    }

	    // Close <li> elements properly
	    function end_el(&$output, $item, $depth = 0, $args = array()) {
	        $output .= "</li>\n";
	    }

	    // Close <ul> elements for sub-menus
	    function end_lvl(&$output, $depth = 0, $args = array()) {
	        $indent = str_repeat("\t", $depth);
	        $output .= "$indent</ul>\n";
	    }
	}


	/******** Custom API Endpoint ********/

	// API URL /wp-json/custom/v1/projects
	// Register the custom REST API route for Projects
	function ict_custom_register_projects_endpoint() {
	    register_rest_route('custom/v1', '/projects', array(
	        'methods'  => 'GET',
	        'callback' => 'ict_custom_get_projects',
	        'permission_callback' => '__return_true', // Allow public access
	    ));
	}
	add_action('rest_api_init', 'ict_custom_register_projects_endpoint');

	// Callback function to handle the request
	function ict_custom_get_projects() {
	    // Query custom post type 'projects'
	    $args = array(
	        'post_type' => 'projects',
	        'posts_per_page' => -1, // Get all projects
	        'post_status' => 'publish'
	    );

	    $query = new WP_Query($args);
	    $projects = array();

	    if ($query->have_posts()) {
	        while ($query->have_posts()) {
	            $query->the_post();

	            // Get custom fields
	            $start_date = get_post_meta(get_the_ID(), '_project_start_date', true);
	            $end_date = get_post_meta(get_the_ID(), '_project_end_date', true);
	            $project_url = get_permalink(); // Project URL

	            // Add project data to the array
	            $projects[] = array(
	                'title'        => get_the_title(),
	                'url'          => $project_url,
	                'start_date'   => $start_date,
	                'end_date'     => $end_date,
	            );
	        }
	    }

	    // Reset the post data
	    wp_reset_postdata();

	    // Return the project data in JSON format
	    return rest_ensure_response($projects);
	}


	/******** Bonus Task ********/

	// Filters for Projects
	function ict_filter_projects_by_date($query) {
	    if (!is_admin() && $query->is_main_query() && is_post_type_archive('projects')) {
	        // Get the filter values from the URL
	        $start_date = isset($_GET['start_date']) ? sanitize_text_field($_GET['start_date']) : '';
	        $end_date = isset($_GET['end_date']) ? sanitize_text_field($_GET['end_date']) : '';

	        // Initialize meta query
	        $meta_query = array();

	        // Add start date condition if present
	        if (!empty($start_date)) {
	            $meta_query[] = array(
	                'key'     => '_project_start_date', // Custom field for start date
	                'value'   => $start_date,
	                'compare' => '>=', // Projects starting after or on the start date
	                'type'    => 'DATE',
	            );
	        }

	        // Add end date condition if present
	        if (!empty($end_date)) {
	            $meta_query[] = array(
	                'key'     => '_project_end_date', // Custom field for end date
	                'value'   => $end_date,
	                'compare' => '<=', // Projects ending before or on the end date
	                'type'    => 'DATE',
	            );
	        }

	        // If we have date filters, add them to the query
	        if (!empty($meta_query)) {
	            $query->set('meta_query', $meta_query);
	        }
	    }
	}
	add_action('pre_get_posts', 'ict_filter_projects_by_date');

?>
