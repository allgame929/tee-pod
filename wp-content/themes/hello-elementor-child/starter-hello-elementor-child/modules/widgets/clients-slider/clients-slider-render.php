<?php

/**
 * The template for rendering the widget
 * 
 * Author: Owen Prasimsha
 *
 * @package HelloElementor
 */
$gallery = $this->get_settings_for_display('image_gallery');
?>
<?php if (!empty($gallery)) { ?>

    <div class="swiper-container swiperCardSlider clients-slider">
        <div class="swiper-wrapper">

            <?php
            $slide_index = 1; // Start with slide 1
            foreach ($gallery as $image) {
                // Check if image URL exists
                $image_url = !empty($image['url']) ? esc_url($image['url']) : get_stylesheet_directory_uri() . '/starter-hello-elementor-child/assets/images/Logo-placeholder.svg';

                // Use dynamic alt text depending on the index
                $alt_text = !empty($image['alt']) ? esc_attr($image['alt']) : 'Clients Slider ' . $slide_index;

                // Only render the slide if image URL is present
                if ($image_url) {
            ?>
                    <div class="swiper-slide">
                        <img src="<?= $image_url ?>" alt="<?= $alt_text ?>">
                    </div>
            <?php
                    $slide_index++; // Increment the slide index for the next image
                } else {
                    echo "<div class='swiper-slide'>Image missing</div>";
                }
            } ?>

        </div>
    </div>

<?php } else { ?>
    <div class="swiper-container swiperCardSlider clients-slider">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <img src="<?= get_stylesheet_directory_uri() ?>/starter-hello-elementor-child/assets/images/Logo-placeholder.svg" alt="Slide 1 Image">
            </div>
            <div class="swiper-slide">
                <img src="<?= get_stylesheet_directory_uri() ?>/starter-hello-elementor-child/assets/images/Logo-placeholder.svg" alt="Slide 2 Image">
            </div>
            <div class="swiper-slide">
                <img src="<?= get_stylesheet_directory_uri() ?>/starter-hello-elementor-child/assets/images/Logo-placeholder.svg" alt="Slide 3 Image">
            </div>
            <div class="swiper-slide">
                <img src="<?= get_stylesheet_directory_uri() ?>/starter-hello-elementor-child/assets/images/Logo-placeholder.svg" alt="Slide 4 Image">
            </div>
            <div class="swiper-slide">
                <img src="<?= get_stylesheet_directory_uri() ?>/starter-hello-elementor-child/assets/images/Logo-placeholder.svg" alt="Slide 5 Image">
            </div>
            <div class="swiper-slide">
                <img src="<?= get_stylesheet_directory_uri() ?>/starter-hello-elementor-child/assets/images/Logo-placeholder.svg" alt="Slide 6 Image">
            </div>
            <div class="swiper-slide">
                <img src="<?= get_stylesheet_directory_uri() ?>/starter-hello-elementor-child/assets/images/Logo-placeholder.svg" alt="Slide 7 Image">
            </div>
            <div class="swiper-slide">
                <img src="<?= get_stylesheet_directory_uri() ?>/starter-hello-elementor-child/assets/images/Logo-placeholder.svg" alt="Slide 8 Image">
            </div>
        </div>
    </div>

<?php } ?>