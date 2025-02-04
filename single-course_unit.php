<?php
get_header(); // Include the header

if (have_posts()) :
    while (have_posts()) : the_post(); ?>
        <div class="container">
            <h1><?php the_title(); ?></h1>
            <div><?php the_content(); ?></div>

            <?php
            // Display related notes
            $course_unit_id = get_the_ID();
            display_notes_for_course_unit($course_unit_id);
            ?>
        </div>
    <?php endwhile;
else :
    echo '<p>No course unitbnbnbn found.</p>';
endif;

get_footer(); // Include the footer
?>
