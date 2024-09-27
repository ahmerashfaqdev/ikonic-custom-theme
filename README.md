<h1>Custom WordPress Theme</h1>

This project is a custom WordPress theme developed from scratch, showcasing both front-end and back-end development skills. The theme includes custom page templates, a custom post type for "Projects," a custom REST API, and responsive design. It adheres to WordPress development best practices and includes basic security implementations.

<h2>Features</h2>
<ol>
  <li>Custom WordPress Theme</li>
  <ul>
    <li>Built from scratch without the use of page builders (Elementor, WPBakery, etc.).</li>
    <li>Follows WordPress theme development best practices.</li>
    <li>Includes at least two custom page templates: Home and Blog.</li>
  </ul>
  <li>Custom Post Type - "Projects"</li>
  <ul>
    <li>Custom post type created using code.</li>
    <li>Custom fields for "Projects" include:</li>
    <ul>
      <li>Project Name</li>
      <li>Project Description</li>
      <li>Project Start Date</li>
      <li>Project End Date</li>
      <li>Project URL</li>
    </ul>
  </ul>
  <li>Custom Archive and Single Pages</li>
  <ul>
    <li>Custom archive and single post templates for the "Projects" post type.</li>
    <li>Custom fields are displayed on the single project page in a visually appealing way.</li>
  </ul>
  <li>Dynamic Navigation Menu</li>
  <ul>
    <li>Dynamic navigation menu created using <code>wp_nav_menu()</code>.</li>
    <li>Supports nested items for multi-level dropdowns.</li>
  </ul>
  <li>Custom REST API Endpoint</li>
  <ul>
    <li>Custom REST API endpoint that returns a list of projects in JSON format.</li>
    <li>Fields returned include:</li>
    <ul>
      <li>Project title</li>
      <li>Project URL</li>
      <li>Project Start Date</li>
      <li>Project End Date</li>
    </ul>
  </ul>
  <li>Responsive Design</li>
   <ul>
    <li>Fully responsive and mobile-friendly.</li>
    <li>Uses CSS and minimal JavaScript/jQuery to achieve responsiveness.</li>
  </ul>
  <li>Basic Security</li>
  <ul>
    <li>Input sanitization and output escaping applied to ensure basic security.</li>
  </ul>
  <li>Bonus Feature</li>
  <ul>
    <li>Filter/search functionality on the Projects archive page to filter projects based on Start Date and End Date.</li>
  </ul>
</ol>

<h2>Installation</h2>
<ol>
  <li>Clone the repository:</li>
  <code>git clone https://github.com/your-github-username/custom-wordpress-theme.git</code>
  <li>Set up a local WordPress environment (e.g., MAMP, XAMPP, Docker).</li>
  <li>Activate the Theme:</li>
  <ul>
    <li>Upload the theme folder to <code>wp-content/themes/</code>.</li>
    <li>Go to the WordPress admin dashboard, navigate to Appearance > Themes, and activate the theme.</li>
  </ul>
  <li>Set up Custom Post Type:</li>
  <ul>
    <li>The theme automatically registers the "Projects" custom post type on theme activation.</li>
    <li>You can add projects by going to Projects in the WordPress admin panel.</li>
  </ul>
  <li>Custom Fields:</li>
   <ul>
    <li>This theme supports custom fields for the "Projects" post type.</li>
    <li>You can either use ACF (Advanced Custom Fields) or write the custom field logic directly in the code.</li>
  </ul>
  <li>Navigation Menu:</li>
  <ul>
    <li>Go to Appearance > Menus and create a custom menu.</li>
    <li>Assign the menu to the theme's designated menu location.</li>
  </ul>
  <li>REST API Endpoint:</li>
   <ul>
    <li>You can access the custom API at the following URL:</li>
     <code>/wp-json/custom/v1/projects</code>
  </ul>
</ol>
<h2>Custom API Usage</h2>
  <p>The custom REST API returns a list of projects in JSON format. Example API request:</p>
  <p><code>GET /wp-json/custom/v1/projects</code></p>

  <strong>Response Example:</strong>
  <code>
    [
      {
          "title": "Project One",
          "url": "https://example.com/project-one",
          "start_date": "2023-01-01",
          "end_date": "2023-05-01"
      },
      {
          "title": "Project Two",
          "url": "https://example.com/project-two",
          "start_date": "2023-03-01",
          "end_date": "2023-08-01"
      }
  ]
  </code>
  
<h2>Bonus Feature: Filter Projects by Date</h2>
<p>On the Projects archive page, users can filter projects by Start Date and End Date. This feature can be accessed through a search or filter form on the archive page.</p>

<h2>Security Considerations</h2>
<ul>
  <li>Inputs are sanitized, and outputs are escaped to ensure security best practices.</li>
  <li>Nonces and validation checks are implemented where necessary.</li>
</ul>

<h2>Technologies Used</h2>
<ul>
  <li><strong>WordPress</strong> for theme structure and content management.</li>
  <li><strong>PHP</strong> for back-end logic and custom API development.</li>
  <li><strong>HTML5/CSS3</strong> for the front-end structure and design.</li>
  <li><strong>JavaScript/jQuery</strong> for dynamic behavior and responsiveness.</li>
  <li><strong>Git</strong> for version control.</li>
</ul>
