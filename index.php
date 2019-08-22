<?php get_header(); ?>

    <div class="main-container">

        <!-- Container for photo and record links -->
        <div class="main-content">

        <?php

        $args = array(
            'post_type' => 'portrait_post'
        );
        $main_posts = new WP_Query($args);

        while ($main_posts->have_posts()) {
            $main_posts->the_post();

            ?>

            <!-- Main image -->
            <div class="main-content__portrait">
                <img src="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" alt="">
                <!-- Image caption -->
                <p class="main-content__portrait-caption">Caption by so and so Here</p>
                <!-- Portrait excerpt -->
                <div class="main-content__excerpt"><?php the_excerpt(); ?></div>
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
                    <h4>Buy the record here:</h4>
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
                <h2>Tour Dates</h2>
                <div><span>DATE</span> <span>Venue</span> <span>Location</span></div>
                <p>11/02/2019 - First Avenue - Minneapolis, MN</p>
                <p>10/21/2019 - Eagles Club - Minneapolis, MN</p>
                <p>09/24/2019 - The Empty Bottle - Chicago, IL</p>
                <p>08/28/2019 - The Big Room - Los Angeles, CA</p>
                <div><span>DATE</span> - <span>Venue</span> - <span>Location</span></div>
                <p>11/02/2019 - First Avenue - Minneapolis, MN</p>
                <p>10/21/2019 - Eagles Club - Minneapolis, MN</p>
                <p>09/24/2019 - The Empty Bottle - Chicago, IL</p>
                <p>08/28/2019 - The Big Room - Los Angeles, CA</p>
                <div><span>DATE</span> - <span>Venue</span> - <span>Location</span></div>
                <p>11/02/2019 - First Avenue - Minneapolis, MN</p>
                <p>10/21/2019 - Eagles Club - Minneapolis, MN</p>
                <p>09/24/2019 - The Empty Bottle - Chicago, IL</p>
                <p>08/28/2019 - The Big Room - Los Angeles, CA</p>
                <div><span>DATE</span> - <span>Venue</span> - <span>Location</span></div>
            </div>

            <!-- Contact info/links -->
            <div class="sub-content__contact">
                <h2>Contact / Social</h2>
                <ul>
                    <li><a href="#"><i class="fab fa-instagram fa-3x"></i></a></li>
                    <li><a href="#"><i class="fab fa-facebook-square fa-2x"></i></a></li>
                    <li><a href="#"><i class="fab fa-twitter fa-lg"></i></a></li>
                    <li><a href="#">email@email.com</a></li>
                </ul>
            </div>

        </div>

    </div>

<?php get_footer(); ?>