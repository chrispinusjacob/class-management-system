<?php
/**
 * Footer Template
 *
 * 
 * @subpackage Tech Group Kenya
 */
?>
<footer class="site-footer">
    <div class="container">
        <div class="footer-content">
            <!-- Glowing "Developed by CJ" -->
            <p class="footer-text">
                <a href="https://techgroupkenya.co.ke/go/cj" target="_blank" class="glow-text">Developed by CJ</a>
            </p>

            <!-- Social / Admin Links -->
            <div class="social-links">
                <a href="https://bsit.66ghz.com/classrep-admin" target="_blank" class="social-icon admin">
                    <i class="fas fa-cogs"></i> Class Rep Login
                </a>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; <?php echo date("Y"); ?> <?php bloginfo('name'); ?>. All rights reserved.</p>
        </div>
    </div>

    <!-- Registration Success Modal -->
    <div id="successModal" class="success-modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div class="tick-icon">&#10004;</div>
            <h2>Registration Successful!</h2>
            <p>You will now receive class updates on time.</p>
        </div>
    </div>
</footer>

<!-- Styles -->
<style>
  :root {
    --primary: #0ff;
    --accent: #f0f;
    --bg: #0a0a0a;
    --light: #fff;
    --nav-bg: linear-gradient(90deg, #0f0c29, #302b63, #24243e);
  }
  /* Footer Main Styles */
  .site-footer {
    background: var(--nav-bg);
    color: var(--light);
    padding: 1.5rem 0;
  }
  .site-footer .container {
    max-width: 1000px;
    margin: 0 auto;
    text-align: center;
  }
  .footer-content {
    margin-bottom: 10px;
  }
  .footer-text {
    font-size: 1rem;
    margin-bottom: 10px;
    background-color: #0056b3;
    padding: 8px;
    border-radius: 5px;
    display: inline-block;
  }
  .footer-text a {
    text-decoration: none;
    color: var(--light);
    font-weight: bold;
    font-size: 1.2em;
    background-image: linear-gradient(45deg, #FF6A00, #FF0A0A, #FF00FF, #0AFF00, #00B5FF, #FFDB00);
    background-size: 600%;
    animation: glowing 5s ease-in-out infinite;
    -webkit-background-clip: text;
    background-clip: text;
  }
  .footer-text a:hover {
    text-decoration: underline;
  }
  .social-links {
    display: flex;
    justify-content: center;
    gap: 15px;
    margin-bottom: 10px;
  }
  .social-links a {
    color: var(--light);
    text-decoration: none;
    font-size: 1rem;
    display: inline-flex;
    align-items: center;
    transition: transform 0.3s ease, color 0.3s ease;
  }
  .social-links a:hover {
    color: #ffcc00;
    transform: scale(1.1);
  }
  .social-icon i {
    margin-right: 6px;
  }
  .footer-bottom {
    font-size: 0.85rem;
  }
  /* Glowing Text Animation */
  @keyframes glowing {
    0% { background-position: 0% 50%; }
    25% { background-position: 25% 50%; }
    50% { background-position: 50% 50%; }
    75% { background-position: 75% 50%; }
    100% { background-position: 100% 50%; }
  }
  /* Modal Styles */
  .success-modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
  }
  .modal-content {
    background-color: #ffffff;
    color: #007bff;
    margin: 10% auto;
    padding: 20px;
    border-radius: 8px;
    width: 80%;
    max-width: 400px;
    text-align: center;
    animation: slideDown 0.5s ease-in-out;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    position: relative;
  }
  .close {
    color: #007bff;
    font-size: 24px;
    font-weight: bold;
    position: absolute;
    top: 10px;
    right: 20px;
    cursor: pointer;
    transition: color 0.3s ease;
  }
  .close:hover { color: #ffcc00; }
  .tick-icon {
    font-size: 50px;
    color: #28a745;
    margin-bottom: 15px;
    animation: bounce 0.5s ease-in-out;
  }
  @keyframes slideDown {
    from { transform: translateY(-50px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
  }
  @keyframes bounce {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.1); }
  }
  /* Responsive Adjustments */
  @media (max-width: 768px) {
    .social-links {
      flex-direction: column;
      gap: 10px;
      align-items: center;
    }
    .footer-text, .footer-bottom {
      font-size: 0.9rem;
    }
  }
</style>

<!-- Font Awesome -->
<!--<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script> -->

<!-- Registration Success Modal Script -->
<?php
/*if (strpos($_SERVER['REQUEST_URI'], 'registration-success') !== false) {
    echo '<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>';
    echo '<script>
    jQuery(document).ready(function($) {
        if (window.location.href.indexOf("msg=success") > -1) {
            $("#successModal").fadeIn();
            $(".close").click(function() {
                $("#successModal").fadeOut();
                clearSuccessMessage();
            });
            $(window).click(function(event) {
                if ($(event.target).is("#successModal")) {
                    $("#successModal").fadeOut();
                    clearSuccessMessage();
                }
            });
        }
        function clearSuccessMessage() {
            let newUrl = window.location.href.split("?")[0];
            window.history.replaceState(null, null, newUrl);
        }
    });
    </script>';
} */
?>
