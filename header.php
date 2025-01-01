 <!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
   <meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Dynamic Title for SEO -->
<title><?php bloginfo('name'); ?> | BSIT Class of 2024 Management System | Technical University of Mombasa </title>

<!-- Meta Description for SEO -->
<meta name="description" content="BSIT Class Management System for the 2024 cohort, built to facilitate academic success. This platform offers timely announcements, comprehensive study materials, assignments, and essential resources tailored to support the needs of BSIT students throughout their academic journey.">

 <!-- SEO Keywords -->
<meta name="keywords" content="Technical University of Mombasa, BSIT, BSIT Class of 2024, BSIT assignments, BSIT study materials, Technical University of Mombasa BSIT, TUM student portal, TUM resources, online learning, study portal, BSIT 2024, class management system, university announcements, BSIT resources, TUM BSIT course materials, TUM academic support, BSIT course management, student resources, assignments portal, university portal, TUM academic resources">

<!-- Open Graph Meta Tags for Social Media -->
<meta property="og:title" content="<?php bloginfo('name'); ?> | BSIT Class of 2024 Management System | Technical University of Mombasa">
<meta property="og:description" content="BSIT Class of 2024 Management System for Technical University of Mombasa, offering announcements, study materials, assignments, and essential resources for students to succeed in their academic journey.">
<meta property="og:url" content="https://bsit.66ghz.com">
<meta property="og:type" content="education">
<meta property="og:image" content="https://bsit.66ghz.com/wp-content/uploads/2024/10/cropped-OIG2.jpg">

<!-- Twitter Card Data -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="BSIT Class Management System">
<meta name="twitter:description" content="Official BSIT Class Management System for Technical University of Mombasa, providing announcements, study materials, and resources for students.">
<meta name="twitter:image" content="https://bsit.66ghz.com/wp-content/uploads/2024/10/cropped-OIG2.jpg">
<meta name="twitter:url" content="https://bsit.66ghz.com">


<!-- Structured Data (Schema.org) for SEO -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "BSIT Class of 2024",
  "logo": "https://bsit.66ghz.com/wp-content/uploads/2024/10/cropped-OIG2.jpg",
  "url": "https://bsit.66ghz.com"
}
</script>

 

    
    <?php wp_head(); ?>
    <!-- Bootstrap CDN for responsiveness -->

   <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    
    <!-- Main stylesheet -->
    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
    
    <style>
        /* Header Styling */
        header.site-header {
            background-color: #007bff;
            color: white;
            padding: 1.5rem 0;
        }

        header .site-branding {
            margin-bottom: 1rem;
        }

        header .site-title {
            font-size: 2rem;
            font-weight: bold;
        }

        header .site-description {
            font-size: 1rem;
            font-style: italic;
        }

        header .main-navigation ul {
            padding-left: 0;
        }

        header .main-navigation ul li {
            list-style: none;
            display: inline-block;
            margin: 0 1rem;
        }

        header .main-navigation ul li a {
            color: white;
            font-weight: bold;
            text-decoration: none;
        }

        header .main-navigation ul li a:hover {
            color: #ffcc00;
            transition: color 0.3s ease;
        }

        /* Quick Access Buttons Styling */
        .quick-access-buttons .btn {
            padding: 10px 20px;
            font-size: 1.2rem;
            transition: all 0.3s ease;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.3);
        }

        .quick-access-buttons .btn:hover {
            background-color: #0056b3;
            transform: scale(1.05);
            box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.4);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            header .site-title {
                font-size: 1.5rem;
            }

            header .main-navigation ul li {
                margin: 0 0.5rem;
            }

            /* Hamburger Menu for Mobile */
            .mobile-menu-icon {
                display: block;
                cursor: pointer;
            }

            .mobile-menu-icon span {
                display: block;
                width: 30px;
                height: 4px;
                margin: 6px auto;
                background-color: white;
                transition: all 0.3s ease;
            }

            .main-navigation ul {
                display: none;
                flex-direction: column;
                text-align: center;
            }

            .main-navigation.active ul {
                display: flex;
            }

            /* Stack quick access buttons vertically on mobile */
            .quick-access-buttons {
                flex-direction: column;
                align-items: center;
            }

            .quick-access-buttons .btn {
                width: 100%;
                margin-bottom: 10px;
            }
        }

        @media (min-width: 769px) {
            .mobile-menu-icon {
                display: none;
            }
        }
    </style>

    <script>
        // Toggle mobile menu
        document.addEventListener("DOMContentLoaded", function() {
            const menuIcon = document.querySelector('.mobile-menu-icon');
            const navMenu = document.querySelector('.main-navigation');
            menuIcon.addEventListener('click', function() {
                navMenu.classList.toggle('active');
                menuIcon.classList.toggle('open');
            });
        });
    </script>
</head>
<body <?php body_class(); ?>>

<header class="site-header">
    <div class="container">
        <div class="site-branding text-center">
            <h1 class="site-title">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="text-white text-decoration-none">
                    <?php bloginfo('name'); ?>
                </a>
            </h1>
            <p class="site-description"><?php bloginfo('description'); ?></p>
        </div>

        <!-- Quick Access Buttons -->
        <div class="quick-access-buttons d-flex justify-content-around">
            <a href="#announcements" class="btn btn-primary">Announcements</a>
            <a href="#download-notes" class="btn btn-primary">Download Notes</a>
            <a href="#timetable" class="btn btn-primary">Timetable</a>
            <a href="#submit-query" class="btn btn-primary">Submit Query</a>
            <a href="#register" class="btn btn-primary">Register as Class Member</a>
             <a href="/bsit-games-zone" class="btn btn-primary">Games</a>
            <a href="/socialize" class="btn btn-primary">TUMSA TV</a>
              <a href="/Education-news" class="btn btn-primary">Education News</a>


        </div>

        <nav class="main-navigation">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'menu_class'     => 'nav justify-content-center',
                'container'      => false,
                'fallback_cb'    => '__return_false',
                'items_wrap'     => '<ul class="%1$s">%3$s</ul>',
            ));
            ?>
        </nav>

        <!-- Hamburger Menu Icon for Mobile -->
        <div class="mobile-menu-icon">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
</header>


<main class="main-content">
    <div class="container">
        <!-- Class Management System content will go here -->
    </div>
</main>

<?php wp_footer(); ?>
 

</body>
</html>
