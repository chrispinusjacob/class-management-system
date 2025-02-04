<?php get_header(); ?>

<div class="container mt-5">
    <!-- Main Heading -->
    <!-- HTML -->
<div id="whatsapp-popup" class="popup">
    <button class="close-btn" id="close-popup">&times;</button>
    <div class="popup-content">
        <p><strong>🚀 Join the BSIT CMS 2.0 Dev Team!</strong></p>
        <p>We are building the BSIT CMS 2.0, and we need your help! Whether you're a developer, designer, or just passionate about the project, you can participate and contribute. <a href="https://chat.whatsapp.com/JUbtmXVtDSU7IreGXdISy1" target="_blank">Click here to join our WhatsApp group</a> and collaborate with us on the development!</p>
    </div>
    <div class="progress-bar" id="progress-bar">
        <div class="progress-bar-fill"></div>
    </div>
</div>

<!-- Google Fonts Import -->
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

<!-- CSS -->
<style>
    /* General pop-up styling */
    .popup {
        position: fixed;
        top: 20px; /* Positioned at the top */
        left: 50%;
        transform: translateX(-50%); /* Center horizontally */
        background-color: #e0f7fa; /* Soft blueish-white background */
        color: #333; /* Text color */
        padding: 20px 30px;
        border-radius: 15px;
        font-size: 18px;
        font-family: 'Roboto', sans-serif; /* Using Roboto font */
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        z-index: 1000;
        width: 80%;  /* 80% width for better mobile responsiveness */
        max-width: 600px; /* Limit the max width */
        display: none; /* Hidden initially */
        opacity: 0;
        animation: popUp 0.8s ease-out forwards; /* Animated appearance */
    }

    /* Close button styling */
    .close-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        background: none;
        border: none;
        font-size: 24px;
        font-weight: bold;
        color: #333;
        cursor: pointer;
        transition: color 0.3s ease;
    }

    .close-btn:hover {
        color: #0066cc; /* Hover effect */
    }

    /* Pop-up content styling */
    .popup-content p {
        margin: 5px 0;
        font-size: 16px;
        line-height: 1.5;
    }

    .popup-content a {
        color: #0066cc; /* Link color */
        text-decoration: none;
        font-weight: bold;
    }

    .popup-content a:hover {
        text-decoration: underline;
    }

    /* Progress bar styling */
    .progress-bar {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 8px;
        background-color: #f1f1f1;
        border-radius: 5px;
        overflow: hidden;
        margin-top: 15px;
    }

    .progress-bar-fill {
        height: 100%;
        width: 0;
        background-color: #0066cc;
        border-radius: 5px;
        animation: progressBarAnimation 15s linear forwards; /* Fill animation */
    }

    /* Pop-up entry animation */
    @keyframes popUp {
        0% { opacity: 0; transform: translate(-50%, -30%); }
        50% { opacity: 0.8; transform: translate(-50%, -20%); }
        100% { opacity: 1; transform: translate(-50%, 0); }
    }

    /* Progress bar animation */
    @keyframes progressBarAnimation {
        from {
            width: 0;
        }
        to {
            width: 100%;
        }
    }

    /* Ensure responsiveness */
    @media (max-width: 768px) {
        .popup {
            width: 90%;
            padding: 15px 20px;
        }
    }

    @media (max-width: 480px) {
        .popup {
            width: 95%;
            padding: 10px 15px;
        }
    }
</style>

<!-- JavaScript -->
<script>
    window.onload = function() {
        const popup = document.getElementById('whatsapp-popup');
        const closeBtn = document.getElementById('close-popup');
        const progressBar = document.getElementById('progress-bar');

        // Show the pop-up when the page loads
        popup.style.display = 'block'; // Ensure the pop-up is shown

        // Create and append the progress bar fill element
        const progressBarFill = document.createElement('div');
        progressBarFill.classList.add('progress-bar-fill');
        progressBar.appendChild(progressBarFill);

        // Close pop-up when the close button is clicked
        closeBtn.onclick = function() {
            popup.style.display = 'none'; // Close the pop-up immediately
        };

        // Remove the pop-up automatically after the progress bar fills (15 seconds)
        setTimeout(function() {
            popup.style.display = 'none'; // Close the pop-up after 15 seconds
        }, 15000);  // 15 seconds
    };
</script>

    <h1 class="cms-heading text-center animated-heading" style="color: #007bff;">BSIT-2024-CMS Version 1.0</h1>
    
    
    <!-- Animated Subheading -->
    <p class="subheading text-center" style="font-size: 1.2rem; color: #343a40;">Welcome to the Future of Content Management</p>
    
    <!-- Flickering Notification -->
    <div class="flicker-notification text-center mt-3" id="notification">
        <i class="fas fa-bell"></i> New Update
    </div>
</div>

<style>
    .cms-heading {
        font-size: 3rem; /* Increase size for more impact */
        font-weight: bold;
        text-shadow: 2px 2px 5px rgba(0, 123, 255, 0.5); /* Soft shadow effect */
        animation: fadeIn 1s ease; /* Animation for the heading */
    }

    .subheading {
        margin-top: 10px; /* Space above the subheading */
        animation: slideIn 1s ease; /* Animation for the subheading */
    }

    .flicker-notification {
        font-size: 1.1rem; /* Font size for notification */
        color: #007bff; /* Match the website color */
        font-weight: bold; /* Bold text */
        animation: flicker 1s infinite; /* Flickering effect */
        margin-top: 15px; /* Space above the notification */
        display: flex; /* Align items */
        align-items: center; /* Center items vertically */
        justify-content: center; /* Center items horizontally */
        cursor: pointer; /* Change cursor to indicate clickable */
    }

    .flicker-notification i {
        margin-right: 8px; /* Space between icon and text */
        color: #ff0000; /* Red color for the icon */
    }

    @keyframes flicker {
        0%, 100% { opacity: 1; }
        50% { opacity: 0; }
    }

    @keyframes fadeIn {
        0% {
            opacity: 0; /* Starting state */
            transform: translateY(-20px); /* Slide in from above */
        }
        100% {
            opacity: 1; /* End state */
            transform: translateY(0); /* Final position */
        }
    }

    @keyframes slideIn {
        0% {
            opacity: 0; /* Starting state */
            transform: translateY(20px); /* Slide in from below */
        }
        100% {
            opacity: 1; /* End state */
            transform: translateY(0); /* Final position */
        }
    }
</style>

<!-- Font Awesome for Icon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<script>
    // Automatically hide the notification after clicking on it
    document.getElementById('notification').addEventListener('click', function() {
        this.style.display = 'none'; // Hide notification
    });
</script>

 
  <!-- Announcements Section -->
<section id="announcements" class="announcements-section py-5" style="background-color: #f8f9fa; padding: 30px 0;">
    <style>
        .announcement-card {
            border: 1px solid #007bff; /* Border color */
            border-radius: 12px; /* Rounded corners */
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); /* Soft shadow */
            transition: transform 0.3s, box-shadow 0.3s; /* Smooth hover effect */
            padding: 20px; /* Inner padding */
            background-color: #ffffff; /* Background color */
        }

        .announcement-card:hover {
            transform: translateY(-5px); /* Lift effect on hover */
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2); /* Stronger shadow on hover */
        }

        .announcement-title {
            color: #007bff; /* Title color */
            font-size: 1.5rem; /* Title size */
            margin: 0 0 15px; /* Space below title */
            text-align: center; /* Center the title */
        }

        .announcement-image {
            border-radius: 12px; /* Image rounding */
            height: 200px; /* Fixed height */
            object-fit: cover; /* Cover to maintain aspect ratio */
            width: 100%; /* Make the image responsive */
        }

        .announcement-date {
            font-size: 0.9rem; /* Date font size */
            color: #6c757d; /* Date color */
            text-align: center; /* Center date */
            margin-bottom: 10px; /* Space below date */
        }

        .announcement-excerpt {
            font-size: 1rem; /* Excerpt font size */
            color: #343a40; /* Excerpt color */
            text-align: center; /* Center text */
            margin-bottom: 15px; /* Space below excerpt */
        }

        .announcement-views {
            font-size: 0.9rem;
            color: #007bff;
            font-weight: bold;
            text-align: center; /* Center views */
            margin-bottom: 10px; /* Space below views */
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            .announcement-card {
                padding: 15px; /* Adjust padding on smaller screens */
            }

            .announcement-title {
                font-size: 1.3rem; /* Adjust title size */
            }

            .announcement-excerpt {
                font-size: 0.95rem; /* Adjust excerpt size */
            }
        }
    </style>

    <div class="container">
        <h2 class="section-title text-center" style="color: #007bff; font-size: 2rem; margin-bottom: 20px;">Latest Announcements</h2>
        <div class="row announcements-list">
            <?php
            // Query to fetch posts from the "announcement" custom post type
            $args = array(
                'post_type' => 'announcement', // Change to your custom post type
                'posts_per_page' => 6,
            );
            $announcement_query = new WP_Query($args);

            // Check if there are announcements
            if ($announcement_query->have_posts()) :
                while ($announcement_query->have_posts()) : $announcement_query->the_post(); ?>
                    <div class="col-md-4 mb-4">
                        <div class="announcement-card">
                            <!-- Display featured image if available -->
                            <?php if (has_post_thumbnail()) : ?>
                                <img src="<?php the_post_thumbnail_url('medium'); ?>" alt="<?php the_title(); ?>" class="announcement-image img-fluid mb-3">
                            <?php else : ?>
                                <img src="path-to-default-image.jpg" alt="Default Announcement Image" class="announcement-image img-fluid mb-3">
                            <?php endif; ?>

                            <!-- Announcement Title -->
                            <h3 class="announcement-title">
                                <a href="<?php the_permalink(); ?>" class="text-dark"><?php the_title(); ?></a>
                            </h3>

                            <!-- Announcement Date and Author -->
                            <p class="announcement-date">
                                Posted by: <?php echo get_the_author(); ?> | 
                                <?php echo time_ago(get_the_time('U')); ?>
                            </p>

                            <!-- Announcement Views -->
                            <p class="announcement-views">
                                Views: <?php echo get_view_count(get_the_ID()); ?>
                            </p>

                            <!-- Announcement Content -->
                            <p class="announcement-excerpt">
                                <?php 
                                // Make URLs clickable
                                $excerpt = get_the_excerpt();
                                echo wpautop(wp_make_link($excerpt));
                                ?>
                            </p>
                        </div>
                    </div>
                <?php endwhile;
                wp_reset_postdata();
            else : ?>
                <p class="text-center" style="font-size: 1rem; color: #343a40;">No announcements at this time.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php
// Function to make links clickable
function wp_make_link($text) {
    return preg_replace('/(https?:\/\/[^\s]+)/', '<a href="$1" target="_blank" rel="nofollow">$1</a>', $text);
}

// Function to display time ago or date and time
function time_ago($timestamp) {
    $current_time = current_time('timestamp'); 
    $time_difference = $current_time - $timestamp;
    if ($time_difference > 86400) {
        return date('F j, Y \a\t g:i A', $timestamp);
    } elseif ($time_difference < 60) {
        return 'Just now';
    } elseif ($time_difference < 3600) {
        $minutes = floor($time_difference / 60);
        return $minutes . ' minute' . ($minutes > 1 ? 's' : '') . ' ago';
    } else {
        return date('g:i A', $timestamp);
    }
}

// Function to get and increment view count
function get_view_count($post_id) {
    $views = get_post_meta($post_id, 'view_count', true);
    if (!$views) {
        $views = 0;
    }
    $views++;
    update_post_meta($post_id, 'view_count', $views);
    return $views;
}
?>

 <?php
// Query to fetch advertisements
$args = array(
    'post_type'      => 'advertisement', // Custom post type for advertisements
    'posts_per_page' => -1,              // Fetch all ads
    'post_status'    => 'publish',       // Only published posts
);
$ad_query = new WP_Query($args);

// Output advertisements if available
if ($ad_query->have_posts()) :
    ?>
    <div class="sponsored-ads">
        <h3 class="ads-title">Sponsored Adverts</h3>
        <div class="ad-scroller">
            <div class="ad-track">
                <?php
                while ($ad_query->have_posts()) : $ad_query->the_post();
                    $ad_link = get_post_meta(get_the_ID(), '_ad_link', true);
                    $ad_image = get_the_post_thumbnail_url(get_the_ID(), 'full');
                    $ad_image = $ad_image ?: 'https://via.placeholder.com/300x200?text=No+Image'; // Fallback image
                    ?>
                    <div class="ad-item">
                        <a href="<?php echo esc_url($ad_link); ?>" target="_blank">
                            <img src="<?php echo esc_url($ad_image); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                            <p><?php echo esc_html(get_post_meta(get_the_ID(), '_ad_description', true)); ?></p>
                        </a>
                    </div>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
                <!-- Duplicate for seamless scrolling -->
                <?php
                $ad_query->rewind_posts(); // Reset the loop
                while ($ad_query->have_posts()) : $ad_query->the_post();
                    $ad_link = get_post_meta(get_the_ID(), '_ad_link', true);
                    $ad_image = get_the_post_thumbnail_url(get_the_ID(), 'full');
                    $ad_image = $ad_image ?: 'https://via.placeholder.com/300x200?text=No+Image'; // Fallback image
                    ?>
                    <div class="ad-item">
                        <a href="<?php echo esc_url($ad_link); ?>" target="_blank">
                            <img src="<?php echo esc_url($ad_image); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                            <p><?php echo esc_html(get_post_meta(get_the_ID(), '_ad_description', true)); ?></p>
                        </a>
                    </div>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            </div>
        </div>
    </div>
    <style>
        .sponsored-ads {
            width: 100%;
            background-color: #f4f4f4;
            padding: 20px 0;
            border-top: 2px solid #ddd;
            border-bottom: 2px solid #ddd;
            text-align: center;
        }
        .ads-title {
            font-size: 1.5rem;
            color: #333;
            margin-bottom: 10px;
            font-weight: bold;
        }
        .ad-scroller {
            overflow: hidden;
            position: relative;
            width: 100%;
        }
        .ad-track {
            display: flex;
            animation: scroll-loop 30s linear infinite;
        }
        .ad-item {
            flex: 0 0 auto;
            width: 200px;
            margin: 0 10px;
        }
        .ad-item img {
            width: 100%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .ad-item p {
            font-size: 0.9rem;
            color: #555;
            margin-top: 5px;
        }
        @keyframes scroll-loop {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(-50%);
            }
        }
    </style>
    <?php
else :
    echo '<p>No advertisements found.</p>';
endif;
?>

<div class="ad-contact-info">
    <p>For advertisements, contact us using the contact information at the bottom of the page.</p>
</div>

<style>
    .ad-contact-info {
        text-align: center;
        font-size: 1rem;
        margin-top: 20px;
        padding: 10px;
        background-color: #f1f9ff; /* Light blue background */
        border: 1px solid #007bff; /* Blue border */
        border-radius: 8px; /* Rounded corners */
        color: #333; /* Dark text for readability */
        box-shadow: 0 2px 10px rgba(0, 123, 255, 0.1); /* Subtle shadow */
    }
</style>



 
 

<!-- Bible Verse Section -->
<section id="bible-verse" class="bible-verse-section py-3" style="background-color: #e9ecef; border-radius: 10px; margin-bottom: 20px; overflow: hidden;">
    <div class="container text-center">
        <h3 style="color: #007bff; font-size: 24px; margin-bottom: 10px;">Bible Verse</h3>
        <p id="bible-quote" class="quote" style="font-size: 1.2rem; color: #343a40; font-style: italic; transition: opacity 0.5s ease; margin: 0;"></p>
        <p id="bible-reference" class="reference" style="font-size: 1rem; color: #6c757d; margin: 5px 0 0;"></p>
    </div>
</section>

<script>
// List of Bible verses
const bibleVerses = [
    { quote: "For God so loved the world that he gave his one and only Son, that whoever believes in him shall not perish but have eternal life.", reference: "John 3:16" },
    { quote: "For I know the plans I have for you, declares the Lord, plans for welfare and not for evil, to give you a future and a hope.", reference: "Jeremiah 29:11" },
    { quote: "I can do all things through Christ who strengthens me.", reference: "Philippians 4:13" },
    { quote: "The Lord is my shepherd; I shall not want.", reference: "Psalm 23:1" },
    { quote: "And we know that in all things God works for the good of those who love him, who have been called according to his purpose.", reference: "Romans 8:28" },
    { quote: "Trust in the Lord with all your heart, and do not lean on your own understanding.", reference: "Proverbs 3:5" },
    { quote: "Come to me, all who labor and are heavy laden, and I will give you rest.", reference: "Matthew 11:28" },
    { quote: "But those who hope in the Lord will renew their strength. They will soar on wings like eagles.", reference: "Isaiah 40:31" },
    { quote: "God is our refuge and strength, a very present help in trouble.", reference: "Psalm 46:1" },
    { quote: "Seek first the kingdom of God and his righteousness, and all these things will be added to you.", reference: "Matthew 6:33" },
    { quote: "Be strong and courageous. Do not be afraid; do not be discouraged, for the Lord your God will be with you wherever you go.", reference: "Joshua 1:9" },
    { quote: "The Lord bless you and keep you; the Lord make his face shine on you and be gracious to you.", reference: "Numbers 6:24-25" },
    { quote: "For with God nothing shall be impossible.", reference: "Luke 1:37" },
    { quote: "I have set the Lord always before me; because he is at my right hand, I shall not be moved.", reference: "Psalm 16:8" },
    { quote: "Cast all your anxiety on him because he cares for you.", reference: "1 Peter 5:7" },
    { quote: "Do not be anxious about anything, but in every situation, by prayer and petition, with thanksgiving, present your requests to God.", reference: "Philippians 4:6" },
    { quote: "The steadfast love of the Lord never ceases; his mercies never come to an end; they are new every morning.", reference: "Lamentations 3:22-23" },
    { quote: "Even though I walk through the valley of the shadow of death, I will fear no evil, for you are with me.", reference: "Psalm 23:4" },
    { quote: "The name of the Lord is a strong tower; the righteous run to it and are safe.", reference: "Proverbs 18:10" },
    { quote: "Blessed are those who hunger and thirst for righteousness, for they shall be filled.", reference: "Matthew 5:6" },
    { quote: "I have been crucified with Christ and I no longer live, but Christ lives in me.", reference: "Galatians 2:20" },
    { quote: "And my God will meet all your needs according to the riches of his glory in Christ Jesus.", reference: "Philippians 4:19" },
    { quote: "I sought the Lord, and he answered me; he delivered me from all my fears.", reference: "Psalm 34:4" },
    { quote: "Fear not, for I am with you; be not dismayed, for I am your God.", reference: "Isaiah 41:10" },
    { quote: "If God is for us, who can be against us?", reference: "Romans 8:31" },
    { quote: "Draw near to God, and he will draw near to you.", reference: "James 4:8" },
    { quote: "The Lord is near to the brokenhearted and saves the crushed in spirit.", reference: "Psalm 34:18" },
    { quote: "For we walk by faith, not by sight.", reference: "2 Corinthians 5:7" },
    { quote: "I lift up my eyes to the mountains—where does my help come from? My help comes from the Lord, the Maker of heaven and earth.", reference: "Psalm 121:1-2" },
    { quote: "The fear of the Lord is the beginning of knowledge.", reference: "Proverbs 1:7" },
    { quote: "And let us not grow weary of doing good, for in due season we will reap, if we do not give up.", reference: "Galatians 6:9" },
    { quote: "The Lord is good, a stronghold in the day of trouble; he knows those who take refuge in him.", reference: "Nahum 1:7" },
    { quote: "Let your light shine before others, that they may see your good deeds and glorify your Father in heaven.", reference: "Matthew 5:16" },
    { quote: "Jesus Christ is the same yesterday and today and forever.", reference: "Hebrews 13:8" },
    { quote: "This is the day that the Lord has made; let us rejoice and be glad in it.", reference: "Psalm 118:24" },
    { quote: "Peace I leave with you; my peace I give to you. I do not give to you as the world gives. Do not let your hearts be troubled.", reference: "John 14:27" },
    { quote: "For the wages of sin is death, but the gift of God is eternal life in Christ Jesus our Lord.", reference: "Romans 6:23" },
    { quote: "Commit your work to the Lord, and your plans will be established.", reference: "Proverbs 16:3" },
    { quote: "But they who wait for the Lord shall renew their strength; they shall mount up with wings like eagles.", reference: "Isaiah 40:31" },
    { quote: "The Lord is my strength and my shield; my heart trusts in him, and he helps me.", reference: "Psalm 28:7" },
    { quote: "Blessed is the man who trusts in the Lord, whose trust is the Lord.", reference: "Jeremiah 17:7" },

    // Add more verses up to 100
];

// Function to display a random verse
function displayRandomVerse() {
    const verse = bibleVerses[Math.floor(Math.random() * bibleVerses.length)];
    const quoteDisplay = document.getElementById("bible-quote");
    const referenceDisplay = document.getElementById("bible-reference");

    // Fade out effect
    quoteDisplay.style.opacity = 0; 
    referenceDisplay.style.opacity = 0;

    // After fade out, update text and fade in
    setTimeout(() => {
        quoteDisplay.textContent = verse.quote; 
        referenceDisplay.textContent = verse.reference;
        quoteDisplay.style.opacity = 1; 
        referenceDisplay.style.opacity = 1;
    }, 500); // Wait for half a second before changing the text
}

// Change verse every 20 seconds
setInterval(displayRandomVerse, 20000);

// Initial verse display
displayRandomVerse();
</script>

<style>
.bible-verse-section {
    padding: 20px;
    border-radius: 10px;
    margin: 20px 0;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.quote {
    font-size: 1.5rem;
    color: #343a40;
    font-style: italic;
    transition: opacity 0.5s ease;
}

.reference {
    font-size: 1rem;
    color: #6c757d;
    margin-top: 10px;
    transition: opacity 0.5s ease;
}

@media (max-width: 768px) {
    .quote {
        font-size: 1.3rem;
    }
    .reference {
        font-size: 0.9rem;
    }
}
</style>





  console.log ("Error in Fetching the News Api!")
<!-- Download Notes Section -->
<section id="download-notes" class="download-notes-section py-5">
    <h2 class="section-title text-center" style="color: #007bff; font-size: 32px; margin-bottom: 20px;">Download Notes</h2>

    <!-- Year/Semester Filter -->
    <div class="filter-section text-center mb-4">
        <form id="filterForm">
            <select name="year_semester" id="yearSemesterSelect" class="form-control unit-select" style="width: 300px; margin: 0 auto;">
                <option value="">Select Year/Semester</option>
                <?php
                $year_semesters = get_terms(array('taxonomy' => 'year_semester', 'hide_empty' => false));
                foreach ($year_semesters as $ys) : ?>
                    <option value="<?php echo esc_attr($ys->slug); ?>">
                        <?php echo esc_html($ys->name); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </form>
    </div>

    <!-- Display Course Units and Notes -->
    <div id="courseUnitsContainer" class="course-units">
        <!-- Dynamic content will be loaded here -->
    </div>
</section>

<script>
jQuery(document).ready(function($) {
    // Load course units based on the selected year/semester
    $('#yearSemesterSelect').change(function() {
        var selectedYearSemester = $(this).val();
        if (selectedYearSemester) {
            $.ajax({
                url: ajax_obj.ajax_url,
                type: 'GET',
                data: {
                    action: 'fetch_course_units',
                    year_semester: selectedYearSemester
                },
                success: function(response) {
                    $('#courseUnitsContainer').html(response);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Error fetching course units:', textStatus, errorThrown);
                }
            });
        } else {
            $('#courseUnitsContainer').empty();
        }
    });

    // Toggle notes visibility on unit click
    $(document).on('click', '.unit-toggle', function() {
        $(this).next('.notes-list').slideToggle(); // Toggle notes list visibility
    });

    // Increment download count on button click
    $(document).on('click', '.download-button', function(e) {
        e.preventDefault();

        var noteId = $(this).data('note-id'); // Get note ID
        var postId = $(this).data('post-id'); // Get post ID
        var noteUrl = $(this).data('note-url'); // Get note URL

        // Ensure noteId and postId are available
        if (!noteId || !postId) {
            console.error('Note ID or Post ID is missing.');
            return;
        }

        // AJAX request to update download count in the database
        $.ajax({
            url: ajax_obj.ajax_url,
            type: 'POST',
            data: {
                action: 'increment_download_count',
                note_id: noteId,
                post_id: postId,
                nonce: ajax_obj.nonce // Include nonce for security
            },
            success: function(response) {
                if (response.success) {
                    // Update the download count display in HTML
                    $(`[data-note-id="${noteId}"]`).closest('.note-item').find('.download-count').text(response.data.new_count + ' downloads');
                    window.open(noteUrl, '_blank'); // Open the PDF in a new tab after success
                } else {
                    console.error('Failed to update download count:', response.data.message);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error updating download count:', textStatus, errorThrown);
            }
        });
    });
});
</script>

<style>
    /* Section Styling */
    .download-notes-section {
        background-color: #f9f9f9;
        border-radius: 8px;
        padding: 30px;
        max-width: 1200px; /* Limit max width for desktop */
        margin: 0 auto; /* Center section */
    }

    /* Card Styling for Units */
    .course-unit-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        background-color: #ffffff;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .course-unit-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }

    /* Toggle Button */
    .unit-toggle {
        display: flex;
        justify-content: space-between;
        cursor: pointer;
        font-size: 1.1rem;
        color: #007bff;
        font-weight: bold;
        padding: 10px 0;
    }

    /* Notes List Styling */
    .notes-list {
        display: none; /* Hidden by default, shown when toggled */
        margin-top: 10px;
        padding-left: 20px;
    }

    .note-item {
        display: flex;
        justify-content: space-between;
        align-items: center; /* Align items center for better spacing */
        padding: 8px 0;
        border-bottom: 1px solid #e1e1e1;
    }

    .note-item:last-child {
        border-bottom: none;
    }

    .download-count {
        font-size: 0.9rem;
        color: #666;
        margin-right: 10px;
    }

    /* Download Button */
    .download-button {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 8px 15px; /* Increased padding for better touch target */
        border-radius: 4px;
        font-size: 0.9rem;
        transition: background-color 0.3s ease, transform 0.2s ease; /* Added transition for animation */
        cursor: pointer;
        margin-left: 10px; /* Space between count and button */
    }

    .download-button:hover {
        background-color: #0056b3;
        transform: scale(1.05); /* Scale effect on hover */
    }

    /* Responsive Styles */
    @media (max-width: 768px) {
        .download-notes-section {
            padding: 20px; /* Reduced padding for smaller screens */
        }

        .course-unit-card {
            margin-bottom: 10px; /* Reduced margin for mobile */
            padding: 10px; /* Reduced padding */
        }

        .unit-toggle {
            font-size: 1rem; /* Slightly smaller font size */
        }

        .note-item {
            flex-direction: column; /* Stack items vertically */
            padding: 5px 0; /* Reduced padding */
        }

        .download-button {
            padding: 8px 10px; /* Adjusted padding for mobile */
            font-size: 0.85rem; /* Smaller font size */
            width: 100%; /* Full width for easier clicking */
        }

        .download-count {
            font-size: 0.8rem; /* Smaller font size for mobile */
        }
    }

    @media (max-width: 480px) {
        .unit-toggle {
            font-size: 0.9rem; /* Further reduced font size for very small screens */
        }

        .download-button {
            width: 100%; /* Full width button for better touch targets */
        }
    }
</style>


 
 <!-- Timetable Section -->
<section id="timetable" class="timetable-section py-5">
    <h2 class="section-title text-center" style="color: #007bff; font-size: 28px; font-weight: bold; margin-bottom: 10px;">Class Timetable</h2>

    <!-- Display Current Date, Day of the Week, and Time in East Africa Time -->
    <p class="text-center" style="color: #007bff; font-size: 16px; font-weight: bold;">
        <?php 
        date_default_timezone_set('Africa/Nairobi'); // Set timezone to East Africa Time
        echo date("l, F j, Y - g:i A"); 
        ?>
    </p>

    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>Day</th>
                    <th>Time</th>
                    <th>Unit</th>
                    <th>Location</th>
                    <th>Lecturer</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Timetable data
                $timetable = array(
                    "Monday" => array(
                        "10:00 AM - 1:00 PM" => array(
                            "unit" => "Installation & Customization",
                            "location" => "I, J",
                            "lecturer" => "Mr. Kariuki"
                        ),
                    ),
                    "Tuesday" => array(
                        "10:00 AM - 1:00 PM" => array(
                            "unit" => "Introduction to Programming",
                            "location" => "Lab D (or A)",
                            "lecturer" => "Mr. Gavuna"
                        ),
                    ),
                    "Wednesday" => array(
                        "2:00 PM - 5:00 PM" => array(
                            "unit" => "HIV/AIDS Awareness & Management",
                            "location" => "Online",
                            "lecturer" => ""
                        ),
                    ),
                    "Thursday" => array(
                        "7:00 AM - 10:00 AM" => array(
                            "unit" => "Business Studies",
                            "location" => "MB15",
                            "lecturer" => "N/A"
                        ),
                        "10:00 AM - 1:00 PM" => array(
                            "unit" => "Math for Science",
                            "location" => "MB15",
                            "lecturer" => "N/A"
                        ),
                        "2:00 PM - 5:00 PM" => array(
                            "unit" => "Introduction to Computer System",
                            "location" => "Online",
                            "lecturer" => "Mr. Hassan"
                        ),
                    ),
                    "Friday" => array(),
                    "Saturday" => array(),
                    "Sunday" => array(),
                );

                foreach ($timetable as $day => $sessions) {
                    if (empty($sessions)) {
                        echo "<tr><td>$day</td><td colspan='4' class='no-sessions'>No sessions scheduled</td></tr>";
                    } else {
                        foreach ($sessions as $time => $details) {
                            echo "<tr>";
                            echo "<td class='day'>$day</td>";
                            echo "<td>$time</td>";
                            echo "<td>{$details['unit']}</td>";
                            echo "<td>{$details['location']}</td>";
                            echo "<td>{$details['lecturer']}</td>";
                            echo "</tr>";
                        }
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Custom CSS for Timetable -->
    <style>
        .timetable-section {
            background-color: #f9f9f9;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: 0 auto;
        }

        .table-container {
            overflow-x: auto; /* Allow horizontal scrolling on smaller screens */
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            font-size: 16px;
        }

        .table th, .table td {
            padding: 12px; /* Increased padding for comfort */
            border: 1px solid #ddd;
            text-align: center;
        }

        .table thead tr {
            background-color: #007bff;
            color: #fff;
        }

        .no-sessions {
            color: #666;
            text-align: center;
        }

        .day {
            color: #007bff;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .table, .table thead, .table tbody, .table th, .table td, .table tr {
                display: block;
                width: 100%;
            }

            .table th, .table td {
                padding: 8px;
                font-size: 14px;
                text-align: center;
            }

            .table thead {
                display: none;
            }

            .table tr {
                margin-bottom: 10px;
                border-bottom: 1px solid #ddd;
            }

            .table td {
                display: flex;
                justify-content: center;
                flex-direction: column;
                align-items: center;
                border: none;
                text-align: center;
            }

            .table td:before {
                content: attr(data-label);
                font-weight: bold;
                color: #007bff;
                margin-bottom: 5px;
            }
        }
    </style>
</section>


  <!-- Register as Class Member Form -->
<section id="register" class="register-section py-5">
    <h2 class="section-title text-center" style="color: #007bff;">Register as a Class Member</h2>
    <form method="POST" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" class="form-container">
        <div class="form-group">
            <label for="member_name">Full Name</label>
            <input type="text" name="member_name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="registration_number">Registration Number</label>
            <input type="text" name="registration_number" class="form-control" required>
            <small class="form-text text-muted">Format: e.g., bsit001j2024</small>
        </div>
        <div class="form-group">
            <label for="member_email">Email</label>
            <input type="email" name="member_email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="member_phone">Phone Number (Kenya - +254)</label>
            <input type="tel" name="member_phone" class="form-control" pattern="^(\+254)?[0-9]{9}$" placeholder="+2547XXXXXXXX" required>
            <small class="form-text text-muted">Format: +2547XXXXXXXX</small>
        </div>
        <input type="hidden" name="action" value="register_class_member">
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</section>

<!-- Submit Query Form -->
<section id="submit-query" class="submit-query-section py-5">
    <h2 class="section-title text-center" style="color: #007bff;">Submit a Query</h2>
    <form method="POST" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" class="form-container">
        <div class="form-group">
            <label for="query_name">Name</label>
            <input type="text" name="query_name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="query_email">Email</label>
            <input type="email" id="query_email" name="query_email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="query_registration">Registration Number</label>
            <input type="text" id="query_registration" name="query_registration" class="form-control" readonly required>
        </div>
        <div class="form-group">
            <label for="query_message">Your Query</label>
            <textarea name="query_message" class="form-control" rows="4" required></textarea>
        </div>
        <input type="hidden" name="action" value="submit_query">
        <button type="submit" class="btn btn-primary">Submit Query</button>
    </form>
</section>

<script>
    jQuery(document).ready(function($) {
        $('#query_email').on('blur', function() {
            let email = $(this).val();
            $.ajax({
                url: '<?php echo admin_url("admin-ajax.php"); ?>',
                type: 'POST',
                data: {
                    action: 'fetch_registration_number',
                    email: email
                },
                success: function(response) {
                    if (response.success) {
                        $('#query_registration').val(response.data.registration_number);
                    } else {
                        alert('You are not a class member');
                        $('#query_registration').val('');
                    }
                }
            });
        });
    });
</script>
 
 
</script>


    </form>
    
</section>

</div>

<?php get_footer(); ?>

<!-- Custom CSS to hide/show notes -->
<style>
    /* Global Styles */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    color: #333;
}

h1.cms-heading {
    font-size: 2.5rem;
    margin-bottom: 30px;
}

.section-title {
    font-size: 2rem;
    margin-bottom: 20px;
}

/* Announcements Section */
.announcements-list {
    display: flex;
    flex-wrap: wrap;
}

.announcement-card {
    background-color: #fff;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s;
}

.announcement-card:hover {
    transform: translateY(-5px);
}

.announcement-image {
    max-height: 200px;
    object-fit: cover;
}

/* Download Notes Section */
.unit-select {
    max-width: 300px;
    margin: 0 auto;
}

/* Course Unit Cards */
.course-unit-card {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s;
}

.course-unit-card:hover {
    transform: translateY(-5px);
}

.note-toggle-label {
    display: block;
    margin: 10px 0;
    cursor: pointer;
    color: #007bff;
}

.notes-content {
    padding: 10px;
    background-color: #f9f9f9;
    border-radius: 5px;
    border: 1px solid #007bff;
}

/* Timetable Section */
.table {
    width: 100%;
    border-collapse: collapse;
}

.table th, .table td {
    border: 1px solid #007bff;
    padding: 15px;
    text-align: center;
}

.table th {
    background-color: #007bff;
    color: white;
}

/* Form Styles */
.form-group {
    margin-bottom: 15px;
}

.form-control {
    width: 100%;
    padding: 10px;
    border: 1px solid #007bff;
    border-radius: 5px;
    transition: border-color 0.3s;
}

.form-control:focus {
    border-color: #0056b3;
    outline: none;
}

.btn-primary {
    background-color: #007bff;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.btn-primary:hover {
    background-color: #0056b3;
}

/* Responsive Styles */
@media (max-width: 768px) {
    .announcement-card, .course-unit-card {
        flex: 1 1 100%; /* Full width on smaller screens */
    }

    .course-units .row {
        display: flex;
        flex-direction: column;
    }
}

/* Global Styles */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    color: #333;
}

/* Section Titles */
.section-title {
    font-size: 2rem;
    margin-bottom: 20px;
}

/* Form Container Styles */
.form-container {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s;
    max-width: 600px; /* Max width for larger screens */
    margin: 0 auto; /* Center the form on larger screens */
}

.form-container:hover {
    transform: translateY(-5px);
}

/* Form Group Styles */
.form-group {
    margin-bottom: 15px;
}

.form-control {
    width: 100%;
    padding: 8px; /* Reduced padding for desktop */
    border: 1px solid #007bff;
    border-radius: 5px;
    transition: border-color 0.3s;
}

.form-control:focus {
    border-color: #0056b3;
    outline: none;
}

/* Button Styles */
.btn-primary {
    background-color: #007bff;
    color: white;
    padding: 8px 12px; /* Reduced padding for desktop */
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
    width: 100%; /* Full width button */
}

.btn-primary:hover {
    background-color: #0056b3;
}

/* Responsive Styles */
@media (max-width: 768px) {
    .section-title {
        font-size: 1.5rem; /* Smaller title for mobile */
    }

    .form-container {
        margin: 0 15px; /* Add some margin for mobile view */
    }
}

/* Adjustments for larger screens */
@media (min-width: 769px) {
    .form-group {
        margin-bottom: 12px; /* Reduce margin on larger screens */
    }

    .form-control {
        padding: 12px; /* Increase padding slightly for comfort */
    }

    .btn-primary {
        padding: 10px 15px; /* Adjust button padding for desktop */
    }
}


</style>
