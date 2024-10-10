/* eslint no-undef: 'off' */
/* eslint no-console: 'off' */
import $ from 'jquery';

const imageAnimateOnScroll = () => {
	const init = () => {
		exec();
	};

	const exec = () => {
		// Wait for the document to be fully loaded
		$(document).ready(function () {
			// Select all target sections using jQuery
			const $targetSections = $('.target-section[data-section]'); // Only target sections with the data-section attribute

			// Setting up the observer options
			let options = {
				root: null, // Observes based on the viewport
				threshold: 0.7, // Triggers when 10% of the section is visible
			};

			// Create the observer function
			let observer = new IntersectionObserver(function (entries) {
				entries.forEach(function (entry) {
					if (entry.isIntersecting) {
						// Add class when the section enters the viewport
						$(entry.target).addClass('animate-image');
					} else {
						// Remove class when the section leaves the viewport
						$(entry.target).removeClass('animate-image');
					}
				});
			}, options);

			// Start observing each section with the data-section attribute
			$targetSections.each(function () {
				observer.observe(this);
			});
		});
	};

	init();
};

try {
	imageAnimateOnScroll();
} catch (error) {
	throw Error(error);
}
