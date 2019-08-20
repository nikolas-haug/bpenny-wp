<?php get_header(); ?>

    <div class="main-container">

        <!-- Container for photo and record links -->
        <div class="main-content">

            <!-- Main image -->
            <div class="main-content__portrait">
                <img src="https://source.unsplash.com/650x500" alt="">
                <!-- Image caption -->
                <p class="main-content__portrait-caption">Caption by so and so Here</p>
                <p class="main-content__excerpt">From there, after six days and seven nights, you arrive at Zobeide, the white city, well exposed to the moon, with streets wound about themselves as in a skein. They tell this tale of its foundation: men of various nations had an identical dream. They saw a woman running at night through an unknown city; she was seen from behind, with long hair, and she was naked. They dreamed of pursuing her. As they twisted and turned, each of them lost her. After the dream, they set out in search of that city; they never found it, but they found</p>
            </div>
            
            <!-- Record and links -->
            <div class="main-content__music">
                <!-- Image -->
                <div class="music__image">
                    <img src="<?php bloginfo('template_directory'); ?>/img/brent_penny_album.jpg" alt="">
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