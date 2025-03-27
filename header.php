<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- Meta Description & Keywords for SEO -->
  <meta name="description" content="BSIT Class of 2024 Management System for Technical University of Mombasa – Your portal for announcements, study materials, timetables, assignments and more.">
  <meta name="keywords" content="Technical University of Mombasa, BSIT, BSIT Class of 2024, BSIT assignments, BSIT study materials, TUM, student portal, online learning, academic resources">
  <link rel="canonical" href="https://bsit.66ghz.com">

  <!-- Dynamic Title -->
  <title><?php bloginfo('name'); ?> | BSIT Class of 2024 Management System | Technical University of Mombasa</title>

  <!-- Open Graph Meta Tags -->
  <meta property="og:title" content="<?php bloginfo('name'); ?> | BSIT Class of 2024 Management System | Technical University of Mombasa">
  <meta property="og:description" content="BSIT Class of 2024 Management System – Your go-to portal for academic success at the Technical University of Mombasa.">
  <meta property="og:url" content="https://bsit.66ghz.com">
  <meta property="og:type" content="website">
  <meta property="og:image" content="https://bsit.66ghz.com/wp-content/uploads/2024/10/cropped-OIG2.jpg">

  <!-- Twitter Card Meta Tags -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?php bloginfo('name'); ?> | BSIT Class of 2024 Management System">
  <meta name="twitter:description" content="Official BSIT Class of 2024 Management System for the Technical University of Mombasa, providing timely announcements, study materials, and academic resources.">
  <meta name="twitter:image" content="https://bsit.66ghz.com/wp-content/uploads/2024/10/cropped-OIG2.jpg">
  
  <!-- Structured Data for SEO (Organization Schema) -->
  <script type="application/ld+json">
  {
    "@context": "http://schema.org",
    "@type": "Organization",
    "name": "<?php bloginfo('name'); ?>",
    "url": "https://bsit.66ghz.com",
    "logo": "https://bsit.66ghz.com/wp-content/uploads/2024/10/cropped-OIG2.jpg"
  }
  </script>

  <!-- Fonts & Icons -->
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <?php wp_head(); ?>

  <style>
    :root {
      --primary: #0ff;
      --accent: #f0f;
      --bg: #0a0a0a;
      --light: #fff;
      --nav-bg: linear-gradient(90deg, #0f0c29, #302b63, #24243e);
    }
    * { margin: 0; padding: 0; box-sizing: border-box; transition: 0.3s ease; }
    body { font-family: 'Roboto', sans-serif; background: var(--bg); color: var(--light); padding-top: 80px; scroll-behavior: smooth; }
    
    /* Loader Styles */
    #loader {
      position: fixed;
      top: 0;
      left: 0;
      width: 100vw;
      height: 100vh;
      background: var(--bg);
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      z-index: 10000;
    }
    .spinner {
      width: 100px;
      height: 100px;
      border: 8px solid rgba(255, 255, 255, 0.2);
      border-top: 8px solid var(--primary);
      border-right: 8px solid var(--accent);
      border-radius: 50%;
      display: flex;
      justify-content: center;
      align-items: center;
      animation: spin 1s linear infinite;
    }
    .loader-logo {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      position: absolute;
      animation: counterSpin 1s linear infinite;
    }
    @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
    @keyframes counterSpin { 0% { transform: rotate(0deg); } 100% { transform: rotate(-360deg); } }
    .loader-text {
      margin-top: 20px;
      font-family: 'Orbitron', sans-serif;
      font-size: 16px;
      color: var(--primary);
      text-align: center;
    }
    
    /* Navbar Styles */
    .navbar {
      background: var(--nav-bg);
      padding: 1rem;
      box-shadow: 0 4px 10px rgba(0,0,0,0.5);
      position: fixed;
      top: 0;
      width: 100%;
      z-index: 1000;
    }
    .navbar-brand img {
      height: 70px;
      padding: 5px;
      background: #000;
      border-radius: 8px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.5);
    }
    .navbar-nav { margin-left: auto; display: flex; align-items: center; }
    .nav-link {
      color: var(--light);
      margin: 0 1rem;
      font-family: 'Orbitron', sans-serif;
      text-transform: uppercase;
      letter-spacing: 1px;
      position: relative;
      text-decoration: none;
    }
    .nav-link::after {
      content: "";
      position: absolute;
      bottom: -4px;
      left: 0;
      width: 0;
      height: 2px;
      background: var(--primary);
    }
    .nav-link:hover::after, .nav-link:focus::after { width: 100%; }
    .cta-btn {
      background: var(--accent);
      padding: 10px 20px;
      border-radius: 5px;
      font-family: 'Orbitron', sans-serif;
      color: var(--bg);
      font-weight: bold;
      text-decoration: none;
      box-shadow: 0 4px 6px rgba(0,0,0,0.4);
    }
    .cta-btn:hover { background: var(--primary); transform: scale(1.05); }
    .navbar-toggler {
      border: none;
      background: transparent;
    }
    .navbar-toggler .line {
      display: block;
      width: 25px;
      height: 3px;
      margin: 4px auto;
      background: var(--light);
    }
    .navbar-toggler.active .line:nth-child(1) { transform: rotate(45deg) translate(5px, 5px); }
    .navbar-toggler.active .line:nth-child(2) { opacity: 0; }
    .navbar-toggler.active .line:nth-child(3) { transform: rotate(-45deg) translate(5px, -5px); }
    .navbar-collapse {
      background: rgba(15,12,41,0.95);
      backdrop-filter: blur(8px);
      border-radius: 0 0 8px 8px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.5);
      position: absolute;
      top: 100%;
      left: 0;
      width: 100%;
      display: none;
    }
    .navbar-collapse.show { display: block; }
    
    @media(max-width:576px) {
      .navbar-nav { flex-direction: column; }
      .nav-link { margin: 0.5rem 0; }
      .navbar-brand img { height: 60px; }
    }
    @media(min-width:992px) {
      .navbar-collapse {
        position: static;
        background: transparent;
        backdrop-filter: none;
        display: flex !important;
        box-shadow: none;
      }
      .navbar-nav { margin: 0 auto; }
    }
  </style>
</head>
<body <?php body_class(); ?>>

  <!-- Loader -->
  <div id="loader">
    <div class="spinner">
      <img src="https://techgroupkenya.co.ke/wp-content/uploads/2024/12/tgklogo.png" alt="BSIT Logo" class="loader-logo">
    </div>
    <div class="loader-text">Initializing...</div>
  </div>

  <script>
    window.addEventListener('load', function() {
      const loader = document.getElementById('loader');
      // Optional: update loader text messages if needed
      setTimeout(function() {
        loader.style.transition = 'opacity 1s ease-out';
        loader.style.opacity = '0';
        setTimeout(function() {
          loader.style.display = 'none';
        }, 1000);
      }, 3000); // Adjust loader duration as needed
    });
  </script>

  <!-- Header & Navigation -->
  <header>
    <nav class="navbar navbar-expand-lg">
      <div class="container">
        <a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>">
          <img src="https://bsit.66ghz.com/wp-content/uploads/2024/10/cropped-OIG2.jpg" alt="BSIT Logo">
        </a>
        <button class="navbar-toggler" type="button" aria-label="Toggle navigation" aria-expanded="false">
          <span class="line"></span>
          <span class="line"></span>
          <span class="line"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="#announcements">Announcements</a></li>
            <li class="nav-item"><a class="nav-link" href="#download-notes">Download Notes</a></li>
            <li class="nav-item"><a class="nav-link" href="#timetable">Timetable</a></li>
            <li class="nav-item"><a class="nav-link" href="#submit-query">Submit Query</a></li>
            <li class="nav-item"><a class="nav-link" href="/bsit-games-zone">Games</a></li>
          </ul>
          
        </div>
      </div>
    </nav>
  </header>

  <script>
    const toggler = document.querySelector('.navbar-toggler'),
          navCollapse = document.querySelector('.navbar-collapse');
    toggler.addEventListener('click', function(){
      const expanded = this.getAttribute('aria-expanded') === 'true';
      this.setAttribute('aria-expanded', !expanded);
      this.classList.toggle('active');
      navCollapse.classList.toggle('show');
    });
  </script>

  <main class="main-content">
    <div class="container">
      <!-- BSIT Class Management System content goes here -->
    </div>
  </main>

  <?php wp_footer(); ?>
  <script>
     
  </script>
</body>
</html>
