/* eslint no-undef: 'off' */
/* eslint no-console: 'off' */
import $ from "jquery";
import Swiper from 'swiper/bundle';
// import "fslightbox"


const exampleSlider = () => {
    const target = ".swiperCardSlider";
    const $target = $(target);

    const init = () => {
        if ($target.length) {
            exec();
        }
    };

    const exec = () => {
        // eslint-disable-next-line
        const swiper = new Swiper(".swiperCardSlider", {
            slidesPerView: 3,
            spaceBetween: 20,
            freeMode: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                841: {
                    slidesPerView: 3, 
                },
                840: {
                    slidesPerView: 2, 
                },
                600: {
                    slidesPerView: 2, 
                },
                280: {
                    slidesPerView: 1,
                }
            },
        });
    };
    
    init();
};

try {
  exampleSlider();
} catch (error) {
    throw Error(error);
}
