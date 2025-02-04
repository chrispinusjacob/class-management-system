<?php
/* Template Name: TUMSA TV Real-Time Page */
get_header();


?>

<style>
    /* Full-screen TV-like container */
    .tv-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        background: linear-gradient(to bottom, #0f2027, #203a43, #2c5364); /* Dark gradient for immersive effect */
        overflow: hidden;
        font-family: 'Arial', sans-serif;
    }

    /* TV Frame */
    .tv-frame {
        position: relative;
        width: 80%;
        max-width: 1000px;
        height: 60%;
        border: 15px solid #444;
        border-radius: 20px;
        background-color: #000;
        box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.7);
        overflow: hidden;
    }

    /* Video inside the TV frame */
    iframe {
        width: 100%;
        height: 100%;
        border: none;
    }

    /* "TUMSA TV" Branding */
    .tumsa-branding {
        position: absolute;
        top: 10px;
        left: 10px;
        font-size: 1.5rem;
        font-weight: bold;
        color: #00cec9;
        text-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
        z-index: 2;
    }
</style>

<div class="button-container">
    <button class="go-back-button" onclick="window.location.href='/'">Go Back</button>
</div>

<style>
    .button-container {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 20px;
    }

    .go-back-button {
        background-color: #3498db; /* Attractive blue matching website theme */
        color: white;
        padding: 10px 20px;
        font-size: 1rem;
        font-weight: bold;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    }

    .go-back-button:hover {
        background-color: #2980b9; /* Slightly darker blue for hover effect */
        transform: scale(1.05); /* Slight zoom-in on hover */
        box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.3);
    }

    .go-back-button:active {
        transform: scale(0.95); /* Slight shrink for click effect */
        background-color: #1c598a; /* Even darker blue on click */
    }
</style>


<div class="tv-container">
    <div class="tv-frame">
        <!-- "TUMSA TV" Branding -->
        <div class="tumsa-branding">TUMSA TV</div>

        <!-- Embed YouTube Video -->
        <iframe 
            id="youtubeVideo" 
            src="" 
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
            allowfullscreen>
        </iframe>
    </div>
</div>

<script>
    // Function to calculate the video start time based on the server's current time
    window.onload = function () {
        const videoId = "GOB3mN3Dlo8"; // YouTube Video ID
        const videoDuration = 11340; // Replace with the actual duration of the video in seconds (e.g., 600 for 10 minutes)

        // Get the current timestamp from the server (PHP-generated)
        const serverTime = <?php echo time(); ?>;

        // Calculate the start time of the video in seconds
        const startTime = serverTime % videoDuration;

        // Construct the YouTube embed URL with real-time sync
        const videoUrl = `https://www.youtube.com/embed/${videoId}?autoplay=1&start=${startTime}&rel=0&modestbranding=1&playsinline=1&showinfo=0&controls=0&loop=1&playlist=${videoId}`;

        // Set the iframe source
        document.getElementById("youtubeVideo").src = videoUrl;
    };
</script>

<?php get_footer(); ?>
