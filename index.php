<?php get_header(); ?>

<div class="main-container">

    <!-- Container for photo and record links -->
    <div class="main-content">

        <?php

        // number of posts limited on backend, but also limit number here
        $args = array(
            'post_type' => 'portrait_post',
            'posts_per_page' => 1
        );
        $main_posts = new WP_Query($args);

        while ($main_posts->have_posts()) {
            $main_posts->the_post();

            ?>

        <!-- Main image -->
        <div class="main-content__portrait">
            <img src="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" alt="">
            <!-- Image caption -->
            <p class="main-content__portrait-caption"><?php the_excerpt(); ?></p>
            <!-- Portrait excerpt -->
            <p class="main-content__excerpt"><?php the_content(); ?></p>
        </div>

        <?php

        }
        wp_reset_query();

        ?>

        <!-- Record and links -->
        <div class="main-content__music">
            <!-- Image -->
            <div class="music__image">
                <img src="<?php bloginfo('template_directory'); ?>/assets/brent_penny_record.jpg" alt="">
            </div>
            <!-- Links -->
            <div class="music__links">
                <h3>Buy the record here:</h3>
                <ul>
                    <li><a href="#"><i class="fab fa-spotify"></i> Spotify</a></li>
                    <li><a href="#"><i class="fab fa-itunes-note"></i> Apple Music</a></li>
                    <li><a href="#"><i class="fab fa-soundcloud"></i> Soundcloud</a></li>
                    <li><a href="#"><i class="fab fa-bandcamp"></i> Bandcamp</a></li>
                </ul>
            </div>
        </div>

    </div>

    <!-- Container for tour dates and contact info/links -->
    <div class="sub-content">

        <!-- Tour dates list -->
        <div class="sub-content__tour">
            <h1>Tour Dates</h1>

            <?php

            $args = array(
                'post_type' => 'tour_date_post'
            );
            $main_posts = new WP_Query($args);

            while ($main_posts->have_posts()) {
                $main_posts->the_post();

                ?>

            <p class="tour-dates"><a href="<?php echo get_post_meta(get_the_ID(), 'show_link', true); ?>" target="_blank"><span class="tour-dates__single"><?php echo date('m-d-y', get_post_meta(get_the_ID(), 'show_date', true)); ?></span> - <?php the_content(); ?></a></p>


            <?php

            }
            wp_reset_query();

            ?>

        </div>

        <!-- Contact info/links -->
        <div class="sub-content__contact">
            <h2>Contact / Social</h2>
            <ul>
                <li><a href="#"><i class="fab fa-instagram fa-3x"></i></a></li>
                <li><a href="#"><i class="fab fa-facebook-square fa-3x"></i></a></li>
                <li><a href="#"><i class="fab fa-twitter fa-3x"></i></a></li>
                <li class="contact-email"><a href="#">email@email.com</a></li>
            </ul>
        </div>

    </div>

</div>

<?php get_footer(); ?>