<?php

// In functions.php

// Add SEO Optimizations for Advertisements
function seo_optimizations_for_ads() {
    if (is_singular('advertisement')) {
        global $post;

        // Get Advertisement Details
        $ad_description = get_post_meta($post->ID, '_ad_description', true);
        $ad_image = get_the_post_thumbnail_url($post->ID, 'full');

        // Add Meta Tags
        echo '<meta name="description" content="' . esc_attr($ad_description) . '">';
        echo '<meta property="og:title" content="' . esc_attr(get_the_title()) . '">';
        echo '<meta property="og:description" content="' . esc_attr($ad_description) . '">';
        echo '<meta property="og:image" content="' . esc_url($ad_image) . '">';
        echo '<meta property="og:type" content="website">';
        echo '<meta name="twitter:card" content="summary_large_image">';
        echo '<meta name="twitter:title" content="' . esc_attr(get_the_title()) . '">';
        echo '<meta name="twitter:description" content="' . esc_attr($ad_description) . '">';
        echo '<meta name="twitter:image" content="' . esc_url($ad_image) . '">';
    }
}
add_action('wp_head', 'seo_optimizations_for_ads');

// Add Structured Data Markup for Advertisements
function structured_data_for_ads($content) {
    if (is_singular('advertisement')) {
        global $post;

        // Get Advertisement Details
        $ad_description = get_post_meta($post->ID, '_ad_description', true);
        $ad_image = get_the_post_thumbnail_url($post->ID, 'full');
        $ad_link = get_post_meta($post->ID, '_ad_link', true);

        // Add Structured Data (JSON-LD)
        $structured_data = [
            "@context" => "https://schema.org",
            "@type" => "Advertisement",
            "name" => get_the_title(),
            "description" => $ad_description,
            "url" => $ad_link,
            "image" => $ad_image
        ];

        // Add JSON-LD Script
        $content .= '<script type="application/ld+json">' . json_encode($structured_data) . '</script>';
    }
    return $content;
}
add_filter('the_content', 'structured_data_for_ads');

// Ensure Images Have Alt Attributes and Lazy Loading
function add_lazy_loading_to_images($html, $post_id, $post_thumbnail_id, $size, $attr) {
    if (get_post_type($post_id) === 'advertisement') {
        $alt_text = get_the_title($post_id); // Use the title as alt text
        $html = str_replace('<img', '<img loading="lazy" alt="' . esc_attr($alt_text) . '"', $html);
    }
    return $html;
}
add_filter('post_thumbnail_html', 'add_lazy_loading_to_images', 10, 5);

// Add Responsive Styles for Advertisement Layout
function advertisement_responsive_styles() {
    if (is_singular('advertisement') || is_post_type_archive('advertisement')) {
        echo '<style>
            .ad-item {
                display: inline-block;
                margin: 10px;
                max-width: 100%;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                border-radius: 8px;
                text-align: center;
            }
            .ad-item img {
                max-width: 100%;
                height: auto;
                border-radius: 8px;
            }
            @media (max-width: 768px) {
                .ad-item {
                    width: 100%;
                }
            }
        </style>';
    }
}
add_action('wp_head', 'advertisement_responsive_styles');


// Register Custom Post Type for Advertisements
function create_advertisement_post_type() {
    $args = array(
        'label'               => 'Advertisements',
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_rest'        => true,
        'supports'            => array('title', 'editor', 'thumbnail'), // Allows title, editor, and image for ads
        'hierarchical'        => false,
        'rewrite'             => array('slug' => 'advertisements'),
    );
    register_post_type('advertisement', $args);
}
add_action('init', 'create_advertisement_post_type');

// Add Custom Fields to Advertisement
function add_advertisement_custom_meta_boxes() {
    // Meta Box for Ad Link
    add_meta_box(
        'ad_link_meta_box', 
        'Advertisement Link', 
        'ad_link_meta_box_callback', 
        'advertisement', 
        'normal', 
        'high'
    );

    // Meta Box for Ad Description
    add_meta_box(
        'ad_description_meta_box', 
        'Advertisement Description', 
        'ad_description_meta_box_callback', 
        'advertisement', 
        'normal', 
        'high'
    );
}
add_action('add_meta_boxes', 'add_advertisement_custom_meta_boxes');

// Display Custom Fields in Admin
function ad_link_meta_box_callback($post) {
    wp_nonce_field('save_advertisement_meta', 'advertisement_meta_nonce');
    $value = get_post_meta($post->ID, '_ad_link', true);
    echo '<input type="url" id="ad_link" name="ad_link" value="' . esc_attr($value) . '" class="widefat" />';
}

function ad_description_meta_box_callback($post) {
    wp_nonce_field('save_advertisement_meta', 'advertisement_meta_nonce');
    $value = get_post_meta($post->ID, '_ad_description', true);
    echo '<textarea id="ad_description" name="ad_description" class="widefat">' . esc_textarea($value) . '</textarea>';
}

// Save Custom Fields Data
function save_advertisement_custom_meta($post_id) {
    if (!isset($_POST['advertiseme
nt_meta_nonce']) || !wp_verify_nonce($_POST['advertisement_meta_nonce'], 'save_advertisement_meta')) {
        return;
    }

    if (array_key_exists('ad_link', $_POST)) {
        update_post_meta($post_id, '_ad_link', sanitize_text_field($_POST['ad_link']));
    }

    if (array_key_exists('ad_description', $_POST)) {
        update_post_meta($post_id, '_ad_description', sanitize_textarea_field($_POST['ad_description']));
    }
}
add_action('save_post', 'save_advertisement_custom_meta');




// Handle AJAX for chess game state
function handle_chess_game() {
    if (isset($_POST['action_type'])) {
        if ($_POST['action_type'] == 'update') {
            // Update the game state (FEN string)
            update_option('chess_game_state', $_POST['fen']);
            wp_send_json_success();
        } elseif ($_POST['action_type'] == 'get') {
            // Get the current game state
            $fen = get_option('chess_game_state', 'start');
            wp_send_json_success(['fen' => $fen]);
        }
    }
    wp_send_json_error();
}
add_action('wp_ajax_chess_game', 'handle_chess_game');
add_action('wp_ajax_nopriv_chess_game', 'handle_chess_game');

// Register the 'bsit-games-zone' rewrite rule
function custom_rewrite_rule_bsit_games() {
    add_rewrite_rule(
        '^bsit-games-zone/?$', // URL pattern for bsit.66ghz.com/bsit-games-zone
        'index.php?bsit_games_page=1', // Custom query variable
        'top' // Place the rule at the top
    );
}
add_action('init', 'custom_rewrite_rule_bsit_games');

// Check if the query variable is set and load the custom template for bsit games
function custom_template_for_bsit_games_page($template) {
    if (get_query_var('bsit_games_page') == 1) { // Check if the custom query variable is set to '1'
        // Check if the custom template file exists, then load it
        if (file_exists(get_template_directory() . '/bsitgames.php')) {
            return get_template_directory() . '/bsitgames.php'; // Load the custom page template
        }
    }
    return $template; // Otherwise, load the default template
}
add_filter('template_include', 'custom_template_for_bsit_games_page');

// Register the custom query variable for 'bsit-games-zone'
function add_query_vars_bsit_games($vars) {
    $vars[] = 'bsit_games_page'; // Register the query variable
    return $vars;
}
add_filter('query_vars', 'add_query_vars_bsit_games');



 // Register the 'education_news' rewrite rule and the custom template
function custom_rewrite_rule_education_news() {
    add_rewrite_rule(
        '^Education-news/?$', // This is the URL pattern for bsit.66ghz.com/Education-news
        'index.php?education_news_page=1', // Create a custom query variable for this URL
        'top' // Place the rule at the top
    );
}
add_action('init', 'custom_rewrite_rule_education_news');

// Check if the query variable is set and load the custom page template for education news
function custom_template_for_education_news_page($template) {
    if (get_query_var('education_news_page') == 1) { // Check if the query variable is '1'
        // Check if the custom template file exists, then load it
        if (file_exists(get_template_directory() . '/edunews.php')) {
            return get_template_directory() . '/edunews.php'; // Load the custom page template
        }
    }
    return $template; // Otherwise, load the default template
}
add_filter('template_include', 'custom_template_for_education_news_page');

// Register the 'socialize' rewrite rule and the custom template
function custom_rewrite_rule_socialize() {
    add_rewrite_rule(
        '^socialize/?$', // This is the URL pattern for bsit.66ghz.com/socialize
        'index.php?socialize_page=1', // Create a custom query variable for this URL
        'top' // Place the rule at the top
    );
}
add_action('init', 'custom_rewrite_rule_socialize');

// Check if the query variable is set and load the custom page template for socialize
function custom_template_for_socialize_page($template) {
    if (get_query_var('socialize_page') == 1) { // Check if the query variable is '1'
        // Check if the custom template file exists, then load it
        if (file_exists(get_template_directory() . '/page-socialize.php')) {
            return get_template_directory() . '/page-socialize.php'; // Load the custom page template
        }
    }
    return $template; // Otherwise, load the default template
}
add_filter('template_include', 'custom_template_for_socialize_page');

// Register custom query variables
function add_query_vars_filter_custom($vars) {
    $vars[] = 'education_news_page'; // Register 'education_news_page' as a recognized query variable
    $vars[] = 'socialize_page'; // Register 'socialize_page' as a recognized query variable
    return $vars;
}
add_filter('query_vars', 'add_query_vars_filter_custom');

 



//////////////////////
// Add admin menu item
add_action('admin_menu', 'custom_download_count_menu');

function custom_download_count_menu() {
    add_menu_page(
        'Reset Download Count',          // Page title
        'Reset Download Count',          // Menu title
        'manage_options',                // Capability
        'reset_download_count',          // Menu slug
        'reset_download_count_page'      // Callback function
    );
}

// Callback function to display the admin page
function reset_download_count_page() {
    if (isset($_POST['reset_download_counts'])) {
        // Verify nonce for security
        if (!isset($_POST['_wpnonce']) || !wp_verify_nonce($_POST['_wpnonce'], 'reset_download_count_nonce')) {
            echo '<div class="error"><p>Nonce verification failed!</p></div>';
            return;
        }

        // Reset download counts for all posts
        $args = [
            'post_type'      => 'course_unit', // Change this to your actual post type
            'posts_per_page' => -1,
        ];

        // Debugging output: Show post type being queried
        echo '<pre>Fetching posts of type: ' . $args['post_type'] . '</pre>';

        $posts = get_posts($args);
        
        // Check if any posts were found
        if (empty($posts)) {
            echo '<div class="error"><p>No posts found for the specified post type.</p></div>';
            return;
        }

        foreach ($posts as $post) {
            // Reset the notes download count
            $notes = get_post_meta($post->ID, 'notes', true);
            
            // Debugging output: Show current notes and their counts
            echo '<pre>';
            echo 'Post ID ' . $post->ID . ': Current Notes: ';
            print_r($notes);
            echo '</pre>';

            if ($notes) {
                foreach ($notes as &$note) {
                    if (isset($note['download_count'])) {
                        $note['download_count'] = 0; // Reset the download count
                    } else {
                        echo '<div class="error"><p>Download count key is missing for note ID: ' . esc_html($note['id']) . '</p></div>';
                    }
                }
                
                // Update the notes back to post meta
                if (update_post_meta($post->ID, 'notes', $notes)) {
                    echo '<div class="updated"><p>Download counts reset for Post ID ' . $post->ID . '.</p></div>';
                } else {
                    echo '<div class="error"><p>Failed to update download counts for Post ID ' . $post->ID . '.</p></div>';
                }
            } else {
                echo '<div class="error"><p>No notes found for Post ID ' . $post->ID . '.</p></div>';
            }
        }
        
        echo '<div class="updated"><p>Process completed.</p></div>';
    }

    // Display the reset form
    ?>
    <div class="wrap">
        <h1>Reset Download Count</h1>
        <form method="post">
            <?php wp_nonce_field('reset_download_count_nonce'); ?>
            <input type="submit" name="reset_download_counts" class="button button-primary" value="Reset All Download Counts">
        </form>
    </div>
    <?php
}


  function enqueue_custom_scripts() {
    // Assuming 'custom-ajax.js' is in the 'js' folder within your theme directory
    wp_enqueue_script('custom-ajax', get_template_directory_uri() . '/js/custom-ajax.js', ['jquery'], null, true);

    // Localize the script with the AJAX URL and security nonce
    wp_localize_script('custom-ajax', 'ajax_obj', [
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('download_count_nonce') // Generate nonce
    ]);
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');

// AJAX handler to increment download count
add_action('wp_ajax_increment_download_count', 'increment_download_count');
add_action('wp_ajax_nopriv_increment_download_count', 'increment_download_count');

function increment_download_count() {
    // Check nonce for security
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'download_count_nonce')) {
        wp_send_json_error(['message' => 'Invalid request.']);
        return;
    }

    // Verify `note_id` and `post_id` are provided
    if (empty($_POST['note_id']) || empty($_POST['post_id'])) {
        wp_send_json_error(['message' => 'Note ID or Post ID missing']);
        return;
    }

    $note_id = sanitize_text_field($_POST['note_id']); // Sanitize input
    $post_id = intval($_POST['post_id']); // Retrieve and sanitize the post ID

    // Retrieve all notes for the specified post
    $uploaded_notes = get_post_meta($post_id, 'notes', true);

    if (!$uploaded_notes) {
        wp_send_json_error(['message' => 'Notes not found for this post.']);
        return;
    }

    $note_found = false;
    $new_count = 0;

    // Find the specific note in the uploaded notes and update its count
    foreach ($uploaded_notes as &$note) {
        if ($note['id'] === $note_id) {
            $current_count = intval($note['download_count']);
            $new_count = $current_count + 1;
            $note['download_count'] = $new_count;
            $note_found = true;
            break;
        }
    }

    if (!$note_found) {
        wp_send_json_error(['message' => 'Note not found.']);
        return;
    }

    // Update the notes back to post meta
    if (update_post_meta($post_id, 'notes', $uploaded_notes)) {
        wp_send_json_success(['new_count' => $new_count]);
    } else {
        wp_send_json_error(['message' => 'Failed to update the download count in the database.']);
    }
}

// AJAX handler to fetch course units based on year/semester
function fetch_course_units_callback() {
    if (isset($_GET['year_semester'])) {
        $year_semester = sanitize_text_field($_GET['year_semester']);
        $units = get_posts([
            'post_type' => 'course_unit',
            'tax_query' => [
                [
                    'taxonomy' => 'year_semester',
                    'field' => 'slug',
                    'terms' => $year_semester,
                ],
            ],
            'posts_per_page' => -1,
        ]);

        if (!empty($units)) {
            foreach ($units as $unit) {
                echo '<div class="course-unit-card">';
                echo '<div class="unit-toggle">' . esc_html($unit->post_title) . '</div>';
                echo '<div class="notes-list">';

                $notes = get_post_meta($unit->ID, 'notes', true) ?: [];

                if (!empty($notes)) {
                    foreach ($notes as $note) {
                        echo '<div class="note-item">';
                        echo '<span>' . esc_html(basename($note['url'])) . '</span>';
                        echo ' | Uploaded by: ' . esc_html($note['uploaded_by']);

                        // Ensure that $note['id'] is defined
                        $note_id = isset($note['id']) ? $note['id'] : '';

                        // Add post ID to the download button
                        echo '<button class="download-button" data-note-id="' . esc_attr($note_id) . '" data-note-url="' . esc_url($note['url']) . '" data-post-id="' . esc_attr($unit->ID) . '">Download</button>';
                        echo '<span class="download-count">' . esc_html($note['download_count']) . ' downloads</span>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>No notes available for this unit.</p>';
                }
                echo '</div></div>';
            }
        } else {
            echo '<p>No units available for this selection.</p>';
        }
    }
    wp_die();
}

add_action('wp_ajax_fetch_course_units', 'fetch_course_units_callback');
add_action('wp_ajax_nopriv_fetch_course_units', 'fetch_course_units_callback');



/////////////////////////////////////////////////////





///////////////////////////////////////////////////////////////////////////////
//sub,ition of query
add_action('admin_post_submit_query', 'handle_submit_query');
add_action('admin_post_nopriv_submit_query', 'handle_submit_query');

function handle_submit_query() {
    if (isset($_POST['query_name'], $_POST['query_email'], $_POST['query_message'])) {
        $name = sanitize_text_field($_POST['query_name']);
        $email = sanitize_email($_POST['query_email']);
        $query_message = sanitize_textarea_field($_POST['query_message']);

        // Fetch user details from the database
        $user = get_user_by('email', $email);
        if ($user) {
            $registration_number = get_user_meta($user->ID, 'registration_number', true);
            $phone_number = get_user_meta($user->ID, 'phone_number', true); // Assuming phone number is stored in user meta

            // Prepare the admin email
            // Fetch all administrators' emails
$admins = get_users(['role' => 'administrator']);
$admin_emails = [];

foreach ($admins as $admin) {
    $admin_emails[] = $admin->user_email;
}

$admin_subject = "New Query Submission from $name";
$admin_message = "
     <html>
    <body style='font-family: Arial, sans-serif; background-color: #f9f9f9; color: #333; padding: 20px;'>
        <div style='max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);'>
            <div style='background-color: #007bff; padding: 20px; color: #ffffff; text-align: center;'>
                <h2 style='margin: 0; font-size: 24px;'>New Query Submission</h2>
            </div>
            <div style='padding: 20px;'>
                <p style='font-size: 16px; color: #333;'><strong>Name:</strong> $name</p>
                <p style='font-size: 16px; color: #333;'><strong>Email:</strong> $email</p>
                <p style='font-size: 16px; color: #333;'><strong>Phone Number:</strong> $phone_number</p>
                <p style='font-size: 16px; color: #333;'><strong>Registration Number:</strong> $registration_number</p>
                <div style='border-top: 1px solid #f0f0f0; margin-top: 15px; padding-top: 15px;'>
                    <h4 style='color: #007bff; margin: 0; font-size: 18px;'>Query:</h4>
                    <p style='font-size: 16px; color: #555; margin-top: 10px;'>$query_message</p>
                </div>
            </div>
            <div style='background-color: #f1f1f1; padding: 10px 20px; text-align: center; color: #777; font-size: 12px;'>
                <p style='margin: 0;'>Powered by Your BSIT-2024-CMS</p>
            </div>
        </div>
    </body>
</html>
";

$admin_headers = [
    'Content-Type: text/html; charset=UTF-8',
    'From: Site Query System <' . get_option('admin_email') . '>'
];

// Send email to all admins
wp_mail($admin_emails, $admin_subject, $admin_message, $admin_headers);


            // Prepare the user email
            $user_subject = "Your Query is Under Processing";
            $user_message = "
               <html>
    <body style='font-family: Arial, sans-serif; background-color: #f9f9f9; color: #333; padding: 20px;'>
        <div style='max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);'>
            <div style='background-color: #007bff; padding: 20px; color: #ffffff; text-align: center;'>
                <h2 style='margin: 0; font-size: 24px;'>Hello $name,</h2>
            </div>
            <div style='padding: 20px;'>
                <p style='font-size: 16px; color: #333;'>Thank you for reaching out! Your query is currently under processing, will get back to you soon.</p>
                <div style='border-top: 1px solid #f0f0f0; margin-top: 15px; padding-top: 15px;'>
                    <h4 style='color: #007bff; margin: 0; font-size: 18px;'>Query Submitted:</h4>
                    <p style='font-size: 16px; color: #555; margin-top: 10px;'>$query_message</p>
                </div>
                <p style='font-size: 16px; color: #333; margin-top: 20px;'>Best Regards,<br>Frankline Odembe</p>
            </div>
            <div style='background-color: #f1f1f1; padding: 10px 20px; text-align: center; color: #777; font-size: 12px;'>
                <p style='margin: 0;'>Powered by Your BSIT-2024-CMS </p>
            </div>
        </div>
    </body>
</html> 
            ";

            // Send email to user
            wp_mail($email, $user_subject, $user_message, $admin_headers);
        }
    }
    wp_redirect(home_url()); // Redirect after processing
    exit;
}


//handles fething reg from frontend to back
add_action('wp_ajax_fetch_registration_number', 'fetch_registration_number_callback');
add_action('wp_ajax_nopriv_fetch_registration_number', 'fetch_registration_number_callback');

function fetch_registration_number_callback() {
    global $wpdb;
    $email = sanitize_email($_POST['email']);
    $user = get_user_by('email', $email);

    if ($user) {
        $registration_number = get_user_meta($user->ID, 'registration_number', true);
        wp_send_json_success(['registration_number' => $registration_number]);
    } else {
        wp_send_json_error();
    }
}


 // Handle submission of queries and enqueue necessary scripts
function submit_query() {
    // Validate and sanitize input fields
    $name = sanitize_text_field($_POST['query_name']);
    $email = sanitize_email($_POST['query_email']);
    $message = sanitize_textarea_field($_POST['query_message']);

    // Handle the query submission (e.g., send email, store in database, etc.)
    $to = get_option('admin_email');
    $subject = "New Query from $name";
    $body = "Name: $name\nEmail: $email\nMessage:\n$message";
    $headers = array('Content-Type: text/plain; charset=UTF-8');
    wp_mail($to, $subject, $body, $headers);

    // Redirect to the homepage with a success parameter
    wp_redirect(add_query_arg('query_status', 'success', home_url()));
    exit;
}
add_action('admin_post_submit_query', 'submit_query');
add_action('admin_post_nopriv_submit_query', 'submit_query');

// Enqueue SweetAlert2 library and custom JavaScript for the popup
function enqueue_sweetalert_and_popup_script() {
    // Enqueue SweetAlert2 library
    wp_enqueue_script('sweetalert2', 'https://cdn.jsdelivr.net/npm/sweetalert2@11', array('jquery'), null, true);

    // Add inline script for displaying the success popup
    $popup_script = "
        document.addEventListener('DOMContentLoaded', function () {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('query_status') === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Query Submitted Successfully!',
                    text: 'Kindly check your email for confirmation.',
                    showConfirmButton: true,
                    confirmButtonText: 'OK',
                    timer: 5000,
                    willClose: () => {
                        // Remove query parameter from URL without reloading the page
                        window.history.replaceState({}, document.title, window.location.pathname);
                    }
                });
            }
        });
    ";
    wp_add_inline_script('sweetalert2', $popup_script);
}
add_action('wp_enqueue_scripts', 'enqueue_sweetalert_and_popup_script');


//////////////////
 // Step 1: Add a main menu page with settings and status submenus
function class_reminder_menu() {
    // Main Menu
    add_menu_page(
        'Class Reminder',          // Page title
        'Class Reminder',           // Menu title
        'manage_options',           // Capability
        'class-reminder',           // Menu slug
        'render_reminder_settings', // Function for main page (default to settings)
        'dashicons-schedule',       // Icon
        6                           // Position
    );

    // Submenu for Settings
    add_submenu_page(
        'class-reminder',           // Parent slug
        'Settings',                 // Page title
        'Settings',                 // Submenu title
        'manage_options',           // Capability
        'class-reminder-settings',  // Menu slug
        'render_reminder_settings'  // Function to display settings page
    );

    // Submenu for Status
    add_submenu_page(
        'class-reminder',           // Parent slug
        'Status',                   // Page title
        'Status',                   // Submenu title
        'manage_options',           // Capability
        'class-reminder-status',    // Menu slug
        'render_class_reminder_status' // Function to display status page
    );

    register_setting('class_reminder_group', 'class_reminder_enabled');
}
add_action('admin_menu', 'class_reminder_menu');

// Step 2: Render Settings Page
function render_reminder_settings() {
    ?>
    <div class="wrap">
        <h1>Class Reminder Settings</h1>
        <form method="post" action="options.php">
            <?php settings_fields('class_reminder_group'); ?>
            <?php do_settings_sections('class_reminder_group'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Enable Daily Reminders</th>
                    <td>
                        <input type="checkbox" name="class_reminder_enabled" value="1" <?php checked(1, get_option('class_reminder_enabled'), true); ?> />
                        <label for="class_reminder_enabled">Send daily reminders 1h 30min before sessions</label>
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

// Step 3: Render Status Page
function render_class_reminder_status() {
    date_default_timezone_set('Africa/Nairobi'); // Set to EAT time

    $timetable = array(
        "Monday" => array("10:00 AM - Installation & Customization"),
        "Tuesday" => array("10:30 AM - Programming Basics"),
        "Wednesday" => array("2:00 PM - HIV/AIDS Awareness"),
        "Thursday" => array("7:00 AM - Business Studies"),
        "Friday" => array("3:30 PM - Fake Lesson for Reminder Testing"),
    );

    $day = date('l');
    $current_time = date("g:i A");

    $pending_reminders = array();
    $completed_reminders = array();

    if (isset($timetable[$day])) {
        foreach ($timetable[$day] as $class) {
            $class_time = explode(" - ", $class)[0];
            if (strtotime($class_time) > strtotime($current_time)) {
                $pending_reminders[] = $class;
            } else {
                $completed_reminders[] = $class;
            }
        }
    }

    echo "<div class='wrap'>";
    echo "<h2>Pending Reminders</h2>";
    if (!empty($pending_reminders)) {
        echo "<ul><li>" . implode("</li><li>", $pending_reminders) . "</li></ul>";
    } else {
        echo "<p>No pending reminders for today.</p>";
    }

    echo "<h2>Completed Reminders</h2>";
    if (!empty($completed_reminders)) {
        echo "<ul><li>" . implode("</li><li>", $completed_reminders) . "</li></ul>";
    } else {
        echo "<p>No completed reminders for today.</p>";
    }

    $next_reminder = !empty($pending_reminders) ? $pending_reminders[0] : "No more reminders today";
    echo "<h2>Next Reminder</h2>";
    echo "<p>$next_reminder</p>";

    echo "</div>";
}

// Step 4: Schedule a reminder 1h 30min before the first class, specific to each day's schedule
function schedule_daily_reminders() {
    if (!get_option('class_reminder_enabled')) return;

    date_default_timezone_set('Africa/Nairobi'); // Set to EAT time

    $timetable = array(
        "Monday" => array("10:00 AM"),
        "Tuesday" => array("10:30 AM"),
        "Wednesday" => array("2:00 PM"),
        "Thursday" => array("7:00 AM"),
        "Friday" => array("3:30 PM"),
        "Saturday" => array(),
        "Sunday" => array(),
    );

    $day = date('l');
    if (!isset($timetable[$day]) || empty($timetable[$day])) return;

    // Get the first class time for the day and set reminder 1 hour 30 minutes prior
    $first_class_time = strtotime($timetable[$day][0]);
    $reminder_time = strtotime('-1 hour 30 minutes', $first_class_time);

    // Clear any previously scheduled reminder to avoid duplication
    wp_clear_scheduled_hook('send_daily_class_reminders');

    // Schedule the event if reminder time is still upcoming for today
    if (time() < $reminder_time) {
        wp_schedule_single_event($reminder_time, 'send_daily_class_reminders');
    }
}
add_action('wp', 'schedule_daily_reminders');

// Step 5: Define function to send daily reminders
function send_daily_class_reminders() {
    if (!get_option('class_reminder_enabled')) return;

    $timetable = array(
        "Monday" => array("10:00 AM - Installation & Customization"),
        "Tuesday" => array("10:30 AM - Programming Basics"),
        "Wednesday" => array("2:00 PM - HIV/AIDS Awareness"),
        "Thursday" => array("7:00 AM - Business Studies", "10:00 AM - Math for Science", "2:00 PM - Introduction to Computer Systems"),
        "Friday" => array("3:30 PM - Fake Lesson for Reminder Testing"),
        "Saturday" => array(),
        "Sunday" => array(),
    );

    $day = date('l');
    if (!isset($timetable[$day])) return;

    $classes_today = implode("<br>", $timetable[$day]);
    $subject = "Today's Class Schedule - Reminder";
    $body = "
        <html>
            <body style='font-family: Arial, sans-serif; background-color: #f9f9f9; color: #333; padding: 20px;'>
                <div style='max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); overflow: hidden;'>
                    <div style='background-color: #007bff; color: white; padding: 20px; text-align: center;'>
                        <h2 style='margin: 0;'>Good Morning / Good Afternoon!</h2>
                        <p style='margin: 5px 0;'>Here is your schedule for today, <strong>$day</strong>:</p>
                    </div>
                    <div style='padding: 20px;'>
                        <p style='font-size: 16px; line-height: 1.5;'>Your classes today:</p>
                        <ul style='padding-left: 20px;'>
                            <li style='margin-bottom: 10px;'>$classes_today</li>
                        </ul>
                        <p style='font-size: 16px; line-height: 1.5;'>Make sure to visit the <a href='https://bsit.66ghz.com' style='color: #007bff; text-decoration: none;'>class portal</a> for more details.</p>
                    </div>
                    <div style='background-color: #f1f1f1; padding: 10px; text-align: center;'>
                        <p style='margin: 0;'>Best Regards,<br><strong>Franline Odembe</strong></p>
                    </div>
                </div>
            </body>
        </html>
    ";

    $headers = array('Content-Type: text/html; charset=UTF-8');
    $user_emails = get_all_user_emails();

    foreach ($user_emails as $email) {
        wp_mail($email, $subject, $body, $headers);
    }
}
add_action('send_daily_class_reminders', 'send_daily_class_reminders');

// Function to get all registered user emails
function get_all_user_emails() {
    $users = get_users();
    $emails = array();
    foreach ($users as $user) {
        $emails[] = $user->user_email;
    }
    return $emails;
}


//////////////////////

 



// Add custom columns to user list
add_filter('manage_users_columns', 'add_custom_user_columns');
add_action('manage_users_custom_column', 'show_custom_user_columns', 10, 3);

function add_custom_user_columns($columns) {
    $columns['full_name'] = 'Full Name';
    $columns['registration_number'] = 'Registration Number';
    $columns['phone_number'] = 'Phone Number';
    return $columns;
}

function show_custom_user_columns($value, $column_name, $user_id) {
    switch ($column_name) {
        case 'full_name':
            return get_user_meta($user_id, 'full_name', true);
        case 'registration_number':
            return get_user_meta($user_id, 'registration_number', true);
        case 'phone_number':
            return get_user_meta($user_id, 'phone_number', true);
        default:
            return $value;
    }
}


// Hook to handle form submission
add_action('admin_post_nopriv_register_class_member', 'handle_class_member_registration');
add_action('admin_post_register_class_member', 'handle_class_member_registration');

function handle_class_member_registration() {
    // Check if the request is a POST request
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Validate and sanitize input
        $full_name = sanitize_text_field($_POST['member_name']);
        $registration_number = sanitize_text_field($_POST['registration_number']);
        $email = sanitize_email($_POST['member_email']);
        $phone = sanitize_text_field($_POST['member_phone']);

        // Check if the email is already in use
        if (email_exists($email)) {
            wp_die('This email is already registered.');
        }

        // Create the user
        $user_id = wp_create_user($full_name, wp_generate_password(), $email);

        if (!is_wp_error($user_id)) {
            // Set user role to subscriber
            $user = new WP_User($user_id);
            $user->set_role('subscriber');

            // Store additional user meta
            update_user_meta($user_id, 'full_name', $full_name);
            update_user_meta($user_id, 'registration_number', $registration_number);
            update_user_meta($user_id, 'phone_number', $phone);

            // Send confirmation email
$subject = '🎉 Registration Successful - Welcome to the Class!';
$message = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { font-family: Arial, sans-serif; color: #343a40; background-color: #f8f9fa; padding: 0; margin: 0; }
        .email-container { max-width: 600px; margin: 20px auto; background-color: #ffffff; border: 1px solid #ddd; border-radius: 8px; overflow: hidden; }
        .email-header { background-color: #007bff; color: #ffffff; padding: 20px; text-align: center; font-size: 24px; }
        .email-body { padding: 20px; color: #343a40; }
        .email-body h1 { color: #007bff; font-size: 20px; }
        .email-footer { padding: 15px; text-align: center; font-size: 14px; color: #6c757d; border-top: 1px solid #ddd; }
        .cta-button { display: inline-block; padding: 10px 20px; margin-top: 15px; color: #ffffff; background-color: #007bff; text-decoration: none; border-radius: 5px; }
        .cta-button:hover { background-color: #0056b3; }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            🎉 Registration Successful
        </div>
        <div class="email-body">
            <h1>Hello ' . esc_html($full_name) . ',</h1>
            <p>Congratulations on successfully registering as a class member!</p>
            <p>You will now receive timely updates on all class activities, events, and more. We’re excited to have you join our online class community and look forward to keeping you informed.</p>
            <p>For any inquiries or additional support, don’t hesitate to reach out. We’re here to help!</p>
            <a href="https://bsit.66ghz.com" class="cta-button">Visit the Class Portal</a>
        </div>
        <div class="email-footer">
            © ' . date("Y") . ' BSIT-2024-CMS. All rights reserved.
        </div>
    </div>
</body>
</html>
';

 
// Setting headers for HTML email
$headers = array('Content-Type: text/html; charset=UTF-8');

// Send email
wp_mail($email, $subject, $message, $headers);

 // Redirect with success message in URL using home_url for dynamic base URL
wp_redirect(add_query_arg('msg', 'success', home_url('/registration-success')));
exit;

} else {
    wp_die('There was an error registering your account.');
}
}



// Create a shortcode to display the registration success message  after regestration
add_shortcode('registration_success', 'registration_success_shortcode');

function registration_success_shortcode() {
    if (isset($_GET['msg']) && $_GET['msg'] === 'success') {
        return '<div class="alert alert-success">Registration successful! You will now receive class updates on time.</div>';
    }
    return '';
}

}

































/////////////////////////////////////////////reset views
// Add a submenu item under "Tools" in WordPress Admin
add_action('admin_menu', function() {
    add_submenu_page(
        'tools.php',          // Parent slug
        'Reset Announcement Views',  // Page title
        'Reset Views',        // Menu title
        'manage_options',     // Capability
        'reset-announcement-views', // Menu slug
        'reset_views_page'    // Callback function
    );
});

// Display the reset views page with a button
function reset_views_page() {
    ?>
    <div class="wrap">
        <h1>Reset Announcement Views</h1>
        <form method="post">
            <input type="hidden" name="reset_views" value="1">
            <p>
                <button type="submit" class="button button-primary">Reset All Announcement Views</button>
            </p>
            <?php wp_nonce_field('reset_views_nonce', 'reset_views_nonce_field'); ?>
        </form>
    </div>
    <?php

    // Check if reset button was clicked
    if (isset($_POST['reset_views']) && check_admin_referer('reset_views_nonce', 'reset_views_nonce_field')) {
        reset_all_views();
        echo '<div class="notice notice-success"><p>All announcement views have been reset.</p></div>';
    }
}

// Function to reset all views
function reset_all_views() {
    $args = array(
        'post_type' => 'announcement', 
        'posts_per_page' => -1, // Get all announcements
        'fields' => 'ids'       // Return only post IDs for performance
    );

    $announcement_query = new WP_Query($args);

    if ($announcement_query->have_posts()) {
        foreach ($announcement_query->posts as $post_id) {
            delete_post_meta($post_id, 'view_count'); // Reset view count
        }
    }

    wp_reset_postdata();
}
///////reset


 function send_announcement_email($post_id) {
    // Check if the post type is 'announcement'
    if (get_post_type($post_id) !== 'announcement') {
        return;
    }

    // Check if the post status is 'publish'
    if (get_post_status($post_id) !== 'publish') {
        return;
    }

    // Get post data
    $post = get_post($post_id);
    $post_title = $post->post_title;
    $post_url = get_permalink($post_id);
    $post_date = get_the_date('F j, Y', $post_id);
    
    // Email subject
    $subject = "New Announcement: $post_title";

    // Email content
    $message = "
    <html>
    <head>
        <title>New Announcement</title>
        <style>
            body { font-family: Arial, sans-serif; }
            .email-container { width: 80%; margin: auto; padding: 20px; border: 1px solid #007bff; border-radius: 8px; background-color: #f9f9f9; }
            .header { background-color: #007bff; color: white; padding: 10px; text-align: center; border-radius: 8px 8px 0 0; }
            .content { margin: 20px 0; }
            .footer { text-align: center; margin-top: 20px; }
            a.button { background-color: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; }
        </style>
    </head>
    <body>
        <div class='email-container'>
            <div class='header'>
                <h2>New Announcement Posted!</h2>
            </div>
            <div class='content'>
                <p>Dear Class Members,</p>
                <p>A new announcement titled <strong>$post_title</strong> has been posted on the class portal on <strong>$post_date</strong>.</p>
                <p>You can view the announcement by clicking the button below:</p>
                <a class='button' href='$post_url'>View Announcement</a>
            </div>
            <div class='footer'>
                <p>Thank you for being a part of our community!</p>
                <p><a href='https://bsit.66ghz.com/'>Visit our portal</a></p>
            </div>
        </div>
    </body>
    </html>";

    // Get all subscribers and admins
    $subscribers = get_users(array('role' => 'subscriber'));
    $admins = get_users(array('role' => 'administrator'));
    $emails = array();

    // Collect emails
    foreach ($subscribers as $subscriber) {
        $emails[] = $subscriber->user_email;
    }
    foreach ($admins as $admin) {
        $emails[] = $admin->user_email;
    }

    // Send email to each subscriber and admin
    foreach ($emails as $email) {
        wp_mail($email, $subject, $message, array('Content-Type: text/html; charset=UTF-8'));
    }
}

// Hook into the transition_post_status action to check for published announcements
add_action('transition_post_status', function($new_status, $old_status, $post) {
    if ($new_status === 'publish' && $old_status !== 'publish') {
        send_announcement_email($post->ID);
    }
}, 10, 3);


 
function make_links_clickable($text) {
    // Convert email addresses to clickable mailto links
    $text = preg_replace('/([a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,6})/i', '<a href="mailto:$1">$1</a>', $text);
    
    // Convert URLs to clickable links
    $text = preg_replace(
        '/(?<!href=[\'"])(https?:\/\/[^\s]+)/i',
        '<a href="$1" target="_blank" rel="noopener noreferrer">$1</a>',
        $text
    );
    
    return $text;
}

// Theme setup
// Theme setup
function theme_setup() {
    // Add support for post thumbnails
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'theme_setup');

// Register Custom Post Type for Announcements
function create_announcement_post_type() {
    $labels = array(
        'name'               => _x('Announcements', 'post type general name'),
        'singular_name'      => _x('Announcement', 'post type singular name'),
        'menu_name'          => _x('Announcements', 'admin menu'),
        'name_admin_bar'     => _x('Announcement', 'add new on admin bar'),
        'add_new'            => _x('Add New', 'announcement'),
        'add_new_item'       => __('Add New Announcement'),
        'new_item'           => __('New Announcement'),
        'edit_item'          => __('Edit Announcement'),
        'view_item'          => __('View Announcement'),
        'all_items'          => __('All Announcements'),
        'search_items'       => __('Search Announcements'),
        'not_found'          => __('No announcements found.'),
        'not_found_in_trash' => __('No announcements found in Trash.')
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'announcement'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon'          => 'dashicons-megaphone', // Icon for announcements
    );

    register_post_type('announcement', $args);
}
add_action('init', 'create_announcement_post_type');

// Register Custom Taxonomy (Example: Year/Semester)
 // Register Year/Semester Taxonomy
function register_year_semester_taxonomy() {
    $labels = array(
        'name'              => 'Year/Semester',
        'singular_name'     => 'Year/Semester',
        'search_items'      => 'Search Year/Semesters',
        'all_items'         => 'All Year/Semesters',
        'edit_item'         => 'Edit Year/Semester',
        'update_item'       => 'Update Year/Semester',
        'add_new_item'      => 'Add New Year/Semester',
        'new_item_name'     => 'New Year/Semester Name',
        'menu_name'         => 'Year/Semester',
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'year-semester'),
    );
    register_taxonomy('year_semester', array('course_unit'), $args);
}
add_action('init', 'register_year_semester_taxonomy');

// Register Course Unit Post Type
function register_course_unit_post_type() {
    $labels = array(
        'name'               => 'Course Units',
        'singular_name'      => 'Course Unit',
        'menu_name'          => 'Course Units',
        'name_admin_bar'     => 'Course Unit',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Course Unit',
        'new_item'           => 'New Course Unit',
        'edit_item'          => 'Edit Course Unit',
        'view_item'          => 'View Course Unit',
        'all_items'          => 'All Course Units',
        'search_items'       => 'Search Course Units',
    );
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'rewrite'            => array('slug' => 'course-units'),
        'supports'           => array('title', 'editor', 'thumbnail'),
        'taxonomies'         => array('year_semester'),
    );
    register_post_type('course_unit', $args);
}
add_action('init', 'register_course_unit_post_type');


  // Register Meta Box for Course Unit Notes
  // Register Meta Box for Course Unit Notes
function course_unit_notes_meta_box() {
    add_meta_box(
        'course_unit_notes',
        'Upload Course Notes',
        'course_unit_notes_meta_box_callback',
        'course_unit',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'course_unit_notes_meta_box');

// Meta Box Callback - Dynamic File Upload Fields
function course_unit_notes_meta_box_callback($post) {
    wp_nonce_field('course_unit_notes_save', 'course_unit_notes_nonce');

    // Fetch existing notes
    $notes = get_post_meta($post->ID, 'notes', true) ?: [];
    $current_user = wp_get_current_user();

    // File upload fields with a "+" button for adding more
    echo '<p>Upload PDF, Word, or Excel notes for this course unit:</p>';
    echo '<div id="notes-upload-fields">';
    echo '<input type="file" name="notes_files[]" accept=".pdf, .doc, .docx, .xls, .xlsx" />';
    echo '</div>';
    echo '<button type="button" onclick="addNoteField()">+</button>';
    echo '<button type="button" id="save-notes" onclick="saveNotes()">Save</button>';

    // Display uploaded notes with delete buttons
    if (!empty($notes)) {
        echo '<h4>Uploaded Notes:</h4><ul>';
        foreach ($notes as $index => $note) {
            echo '<li>';
            echo '<a href="' . esc_url($note['url']) . '" target="_blank">' . esc_html(basename($note['url'])) . '</a>';
            echo ' | Uploaded by: ' . esc_html($note['uploaded_by']);
            echo ' | Downloads: ' . esc_html($note['download_count']);
            echo ' <button type="button" class="delete-note-button" data-note-index="' . esc_attr($index) . '" onclick="deleteNote(this)">Delete</button>';
            echo '</li>';
        }
        echo '</ul>';
    }

    // Add custom JavaScript for adding/removing fields and saving notes
    ?>
    <script>
        // Function to dynamically add more upload fields
        function addNoteField() {
            const uploadDiv = document.getElementById('notes-upload-fields');
            const newField = document.createElement('input');
            newField.setAttribute('type', 'file');
            newField.setAttribute('name', 'notes_files[]');
            newField.setAttribute('accept', '.pdf, .doc, .docx, .xls, .xlsx');
            uploadDiv.appendChild(newField);
        }

        // Function to save notes via AJAX
        
        function saveNotes() {
            let formData = new FormData();
            formData.append('action', 'save_course_unit_notes');
            formData.append('post_id', '<?php echo $post->ID; ?>');
            formData.append('_ajax_nonce', '<?php echo wp_create_nonce('course_unit_notes_nonce'); ?>');
            
            document.querySelectorAll('input[name="notes_files[]"]').forEach(fileInput => {
                if (fileInput.files[0]) {
                    formData.append('notes_files[]', fileInput.files[0]);
                }
            });

            fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
                method: 'POST',
                body: formData
            }).then(response => response.json())
              .then(data => {
                  if (data.success) {
                      alert('Notes saved successfully.');
                      location.reload(); // Refresh to show updated notes list
                  } else {
                      alert('Failed to save notes.');
                  }
              });
        }




        // Function to delete note via AJAX
        function deleteNote(button) {
            const noteIndex = button.getAttribute('data-note-index');
            let formData = new FormData();
            formData.append('action', 'delete_course_unit_note');
            formData.append('post_id', '<?php echo $post->ID; ?>');
            formData.append('note_index', noteIndex);
            formData.append('_ajax_nonce', '<?php echo wp_create_nonce('course_unit_notes_nonce'); ?>');

            fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
                method: 'POST',
                body: formData
            }).then(response => response.json())
              .then(data => {
                  if (data.success) {
                      alert('Note deleted successfully.');
                      location.reload(); // Refresh to show updated notes list
                  } else {
                      alert('Failed to delete note.');
                  }
              });
        }

        
    </script>
    <?php
}

 // AJAX handler to save notes without updating post
function save_course_unit_notes() {
    check_ajax_referer('course_unit_notes_nonce', '_ajax_nonce');

    $post_id = intval($_POST['post_id']);
    $current_user = wp_get_current_user();
    $uploaded_notes = get_post_meta($post_id, 'notes', true) ?: [];

    if (isset($_FILES['notes_files']) && !empty($_FILES['notes_files']['name'][0])) {
        foreach ($_FILES['notes_files']['name'] as $key => $name) {
            if ($_FILES['notes_files']['error'][$key] === UPLOAD_ERR_OK) {
                $file = [
                    'name' => $_FILES['notes_files']['name'][$key],
                    'type' => $_FILES['notes_files']['type'][$key],
                    'tmp_name' => $_FILES['notes_files']['tmp_name'][$key],
                    'error' => $_FILES['notes_files']['error'][$key],
                    'size' => $_FILES['notes_files']['size'][$key],
                ];
                $_FILES['upload'] = $file;

                // Handle the upload
                $uploaded_id = media_handle_upload('upload', $post_id);
                if (!is_wp_error($uploaded_id)) {
                    // Generate a unique note ID for this uploaded note
                    $note_id = uniqid('note_', true); // Change this to wp_generate_uuid4() if you prefer UUIDs

                    // Append the uploaded note info including the note ID
                    $uploaded_notes[] = [
                        'id' => $note_id, // Store the generated note ID
                        'url' => wp_get_attachment_url($uploaded_id),
                        'uploaded_by' => $current_user->display_name,
                        'download_count' => 0
                    ];
                }
            }
        }
    }

    // Update the notes in post meta
    update_post_meta($post_id, 'notes', $uploaded_notes);
    wp_send_json_success();
}
add_action('wp_ajax_save_course_unit_notes', 'save_course_unit_notes');


// AJAX handler to delete a specific note
function delete_course_unit_note() {
    check_ajax_referer('course_unit_notes_nonce', '_ajax_nonce');

    $post_id = intval($_POST['post_id']);
    $note_index = intval($_POST['note_index']);
    $notes = get_post_meta($post_id, 'notes', true) ?: [];

    if (isset($notes[$note_index])) {
        unset($notes[$note_index]);
        update_post_meta($post_id, 'notes', array_values($notes));
        wp_send_json_success();
    } else {
        wp_send_json_error();
    }
}
add_action('wp_ajax_delete_course_unit_note', 'delete_course_unit_note');

  
  

 
// Handle registration of class members
function register_class_member() {
    // Validate and sanitize input fields
    $name = sanitize_text_field($_POST['member_name']);
    $email = sanitize_email($_POST['member_email']);
    $phone = sanitize_text_field($_POST['member_phone']);

    // Here you can handle storing this data as needed
    // For example, you could store it in a custom database table, send an email, etc.

    // Redirect after submission
    wp_redirect(home_url());
    exit;
}
add_action('admin_post_register_class_member', 'register_class_member');
add_action('admin_post_nopriv_register_class_member', 'register_class_member');

//////////////////

// Add menu page for sending custom emails
function custom_email_sender_menu() {
    add_menu_page(
        'Custom Email Sender',         // Page title
        'Custom Email Sender',         // Menu title
        'manage_options',              // Capability
        'custom-email-sender',         // Menu slug
        'render_custom_email_sender',  // Function to display the form
        'dashicons-email',             // Icon
        25                             // Position
    );
}
add_action('admin_menu', 'custom_email_sender_menu');

// Render the custom email sender form
function render_custom_email_sender() {
    // Check if the form is submitted and process the email
    if (isset($_POST['send_custom_email'])) {
        $subject = sanitize_text_field($_POST['email_subject']);
        $message = wp_kses_post($_POST['email_content']);
        $selected_users = $_POST['selected_users'];
        
        $admin_user = wp_get_current_user();
        $admin_name = $admin_user->display_name;

        $footer = "<p>Best regards,<br><strong>$admin_name</strong></p>";
        $formatted_message = "
            <html>
                <body style='font-family: Arial, sans-serif; background-color: #f9f9f9; color: #333; padding: 20px;'>
                    <div style='max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); overflow: hidden;'>
                        <div style='background-color: #007bff; color: white; padding: 20px; text-align: center;'>
                            <h2 style='margin: 0;'>$subject</h2>
                        </div>
                        <div style='padding: 20px;'>
                            <p style='font-size: 16px; line-height: 1.5;'>$message</p>
                        </div>
                        <div style='padding: 10px; text-align: center;'>
                            $footer
                        </div>
                    </div>
                </body>
            </html>
        ";

        $headers = array('Content-Type: text/html; charset=UTF-8');

        // Determine recipients
        if ($selected_users[0] === 'all_users') {
            $users = get_users();
        } else {
            $users = get_users(array('include' => $selected_users));
        }

        // Send the email
        foreach ($users as $user) {
            wp_mail($user->user_email, $subject, $formatted_message, $headers);
        }

        echo "<div class='notice notice-success'><p>Email sent successfully!</p></div>";
    }

    // Display the form
    ?>
    <div class="wrap">
        <h1>Send Custom Email</h1>
        <form method="post">
            <table class="form-table">
                <tr>
                    <th scope="row">Subject</th>
                    <td>
                        <input type="text" name="email_subject" required class="regular-text" placeholder="Email Subject">
                    </td>
                </tr>
                <tr>
                    <th scope="row">Message</th>
                    <td>
                        <textarea name="email_content" required class="large-text" rows="10" placeholder="Enter your message here"></textarea>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Recipients</th>
                    <td>
                        <select name="selected_users[]" multiple style="height: 150px; width: 100%;">
                            <option value="all_users">All Users</option>
                            <?php
                            // List all users
                            $users = get_users();
                            foreach ($users as $user) {
                                echo "<option value='{$user->ID}'>{$user->display_name} ({$user->user_email})</option>";
                            }
                            ?>
                        </select>
                        <p>Select "All Users" or choose specific users by holding down Ctrl (Windows) or Command (Mac).</p>
                    </td>
                </tr>
            </table>
            <?php submit_button('Send Email', 'primary', 'send_custom_email'); ?>
        </form>
    </div>
    <?php
}






 
 