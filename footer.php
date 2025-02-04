 
    <footer class="site-footer">
    <div class="container">
        <div class="footer-content">
            <p class="footer-text">Developed by <strong>CJ</strong></p>
            <div class="social-links">
                <!-- Updated X logo with image from a URL -->
<a href="https://x.com/jacobchrispinus" target="_blank" class="social-icon x" style="font-size: 1.5rem; text-decoration: none;">
    <img src="https://bsit.66ghz.com/wp-content/uploads/2024/11/vectorseek.com-Twitter-X-Logo-Vector.png" alt="X Logo" class="glow-logo" style="width: 40px; height: auto;"/>
</a>

<style>
/* Glowing effect for the X logo */
.glow-logo {
    transition: all 0.3s ease-in-out;
}

.glow-logo:hover {
    /* Glowing effect */
    filter: brightness(1.5); /* Make the logo brighter */
    box-shadow: 0 0 10px 4px rgba(0, 255, 0, 0.8); /* Green glow */
}
</style>


                </a>
                <a href="https://linkedin.com/in/chrispinus-jacob-3479252ba" target="_blank" class="social-icon linkedin">
                    <i class="fab fa-linkedin-in"></i> LinkedIn
                </a>
                <a href="https://wa.me/+254736758316" target="_blank" class="social-icon whatsapp">
                    <i class="fab fa-whatsapp"></i> WhatsApp

                    <a href="https://bsit.66ghz.com/classrep-admin" target="_blank" class="social-icon admin">
                    <i class="fas fa-cogs"></i> Class Rep Login
                </a>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; <?php echo date("Y"); ?> All rights reserved.</p>
        </div>
    </div>
    <div id="successModal" class="success-modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div class="tick-icon">&#10004;</div>
            <h2>Registration Successful!</h2>
            <p>You will now receive class updates on time.</p>
        </div>
    </div>
</footer>
 
    
    
</div>
 

  <?php
// Display the success modal only if the success message is in the URL
if (strpos($_SERVER['REQUEST_URI'], 'registration-success') !== false) {
    // Include jQuery if not already included
    echo '<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>';
    echo '<script>
    jQuery(document).ready(function($) {
        // Check if the URL contains the success message
        if (window.location.href.indexOf("msg=success") > -1) {
            $("#successModal").fadeIn(); // Show modal
            
            // Close the modal when the close button is clicked
            $(".close").click(function() {
                $("#successModal").fadeOut(); // Hide modal
                clearSuccessMessage(); // Clear success message from URL
            });
            
            // Close the modal when clicking outside the modal content
            $(window).click(function(event) {
                if ($(event.target).is("#successModal")) {
                    $("#successModal").fadeOut(); // Hide modal
                    clearSuccessMessage(); // Clear success message from URL
                }
            });
        }

        // Function to clear the success message from the URL
        function clearSuccessMessage() {
            let newUrl = window.location.href.split("?")[0]; // Get base URL
            window.history.replaceState(null, null, newUrl); // Update URL without the success message
        }
    });
    </script>';
}
?>



 
</footer>

<style>

  /* Modal Background */
.success-modal {
    display: none; /* Hidden by default */
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7); /* Semi-transparent dark background */
}

/* Modal Content */
.modal-content {
    background-color: #ffffff;
    color: #007bff;
    margin: auto;
    padding: 20px;
    border-radius: 8px;
    width: 80%;
    max-width: 400px;
    text-align: center;
    animation: slideDown 0.5s ease-in-out;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

/* Close Button */
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

.close:hover {
    color: #ffcc00;
}

/* Animated Tick Icon */
.tick-icon {
    font-size: 50px;
    color: #28a745;
    margin-bottom: 15px;
    animation: bounce 0.5s ease-in-out;
}

/* Animations */
@keyframes slideDown {
    from { transform: translateY(-50px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}

@keyframes bounce {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.1); }
}


/* Footer Styling */
.site-footer {
    background-color: #007bff; /* Matching header blue */
    color: white;
    padding: 1.5rem 0;
}

.site-footer .container {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    max-width: 1000px;
    margin: 0 auto;
}

.footer-content {
    margin-bottom: 10px;
}

.footer-text {
    font-size: 1rem;
    margin-bottom: 10px;
}

.social-links {
    display: flex;
    justify-content: center;
    gap: 15px;
}

.social-links a {
    color: white;
    text-decoration: none;
    font-size: 1rem;
    transition: transform 0.3s ease, color 0.3s ease;
    display: inline-flex;
    align-items: center;
}

.social-links a:hover {
    color: #ffcc00; /* Hover color matching header buttons */
    transform: scale(1.1);
}

.footer-bottom {
    font-size: 0.85rem;
}

/* Font Awesome Icon Styling */
.social-icon i {
    margin-right: 6px;
}

/* Responsive Design */
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

<!-- Add Font Awesome for social icons -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

 