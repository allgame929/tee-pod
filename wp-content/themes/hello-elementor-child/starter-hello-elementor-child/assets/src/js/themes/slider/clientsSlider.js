/* eslint no-undef: 'off' */
/* eslint no-console: 'off' */
import $ from 'jquery';
import Swiper from 'swiper/bundle';
// import "fslightbox"

const clientsSlider = () => {
	const target = '.swiperCardSlider';
	const $target = $(target);

	const init = () => {
		if ($target.length) {
			exec();
		}
	};

	const exec = () => {
		// eslint-disable-next-line
		const swiper = new Swiper('.swiperCardSlider', {
			slidesPerView: 'auto', // Allow slides to auto-size
			spaceBetween: 20, // Adjust space between slides
			centeredSlides: false, // Disable centered slides to create marquee effect
			loop: true, // Enable loop
			speed: 5000, // Set speed for smooth continuous effect
			autoplay: {
				delay: 0, // Set to 0 for continuous autoplay
				disableOnInteraction: false, // Continue autoplay after interaction
			},
			freeMode: true, // Enable freeMode to remove snap effect
			freeModeMomentum: false,
		});
	};

	init();
};

try {
	clientsSlider();
} catch (error) {
	throw Error(error);
}
