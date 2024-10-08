import EmblaCarousel from 'embla-carousel';

export class Carousel {
	/**
	 * Creates a new Carousel instance.
	 * @param {Object} emblaNode - An object containing references to carousel elements.
	 * @param {HTMLElement} emblaNode.parentNode - The main carousel container element.
	 * @param {HTMLElement} emblaNode.viewportNode - The viewport element of the carousel.
	 * @param {boolean} [emblaNode.withBtn] - Whether to include navigation buttons.
	 * @param {boolean} [emblaNode.withDotsBtn] - Whether to include dot navigation.
	 * @param {EmblaCarouselType["OptionsType"]} [userOptions={ loop: true }] - Options for the Embla Carousel.
	 * @param {Array} [plugins=[]] - Array of plugins for the Embla Carousel.
	 */

	constructor(emblaNode, userOptions = { loop: true }, plugins = []) {
		/**
		 * The main carousel container element.
		 * @type {HTMLElement}
		 */
		this.emblaNode = emblaNode.parentNode;

		/**
		 * The viewport element of the carousel.
		 * @type {HTMLElement}
		 */
		this.viewportNode = emblaNode.viewportNode;

		/**
		 * The Embla Carousel API instance.
		 * @type {Object}
		 */
		this.emblaApi = EmblaCarousel(this.viewportNode, userOptions, plugins);

		if (emblaNode.withBtn) {
			const wrapper = document.createElement('div');
			wrapper.classList.add('carousel-arrows');

			/**
			 * The previous button element.
			 * @type {HTMLButtonElement}
			 */
			this.prevBtnNode = document.createElement('button');
			this.prevBtnNode.classList.add('arrow-btn', 'prev');

			/**
			 * The next button element.
			 * @type {HTMLButtonElement}
			 */
			this.nextBtnNode = document.createElement('button');
			this.nextBtnNode.classList.add('arrow-btn', 'next');

			wrapper.append(this.prevBtnNode, this.nextBtnNode);
			this.viewportNode.parentNode.append(wrapper);

			this.addPrevNextBtnsClickHandlers();
		}

		if (emblaNode.withDotsBtn) {
			/**
			 * The container for dot buttons.
			 * @type {HTMLDivElement}
			 */
			this.dotNodes = document.createElement('div');
			this.dotNodes.classList.add('carousel-dots');

			this.viewportNode.parentNode.append(this.dotNodes);

			this.addDotBtnsAndClickHandlers();
		}

		this.emblaApi.on('destroy', () => {
			if (emblaNode.withBtn) {
				this.removePrevNextBtnsClickHandlers();
			}
			if (emblaNode.withDotsBtn) {
				this.removeDotBtnsAndClickHandlers();
			}
		});
	}

	getEmblaApi() {
		return this.emblaApi;
	}

	addPrevNextBtnsClickHandlers() {
		const scrollPrev = () => {
			this.getEmblaApi().scrollPrev();
		};
		const scrollNext = () => {
			this.getEmblaApi().scrollNext();
		};

		this.prevBtnNode.addEventListener('click', scrollPrev, false);
		this.nextBtnNode.addEventListener('click', scrollNext, false);

		this.togglePrevNextBtnsState();
		this.getEmblaApi().on('select', () => this.togglePrevNextBtnsState());
		this.getEmblaApi().on('init', () => this.togglePrevNextBtnsState());
		this.getEmblaApi().on('reInit', () => this.togglePrevNextBtnsState());
	}

	removePrevNextBtnsClickHandlers() {
		this.prevBtnNode.removeEventListener('click', this.emblaNode.btn.scrollPrev, false);
		this.nextBtnNode.removeEventListener('click', this.emblaNode.btn.scrollNext, false);
	}

	togglePrevNextBtnsState() {
		if (this.getEmblaApi().canScrollPrev()) {
			this.prevBtnNode.removeAttribute('disabled');
		} else {
			this.prevBtnNode.setAttribute('disabled', 'disabled');
		}

		if (this.getEmblaApi().canScrollNext()) {
			this.nextBtnNode.removeAttribute('disabled');
		} else {
			this.nextBtnNode.setAttribute('disabled', 'disabled');
		}
	}

	addDotBtnsAndClickHandlers() {
		const addDotBtnsWithClickHandlers = () => {
			this.dotNodes = this.emblaNode.parentNode.querySelector('.carousel-dots');

			this.dotNodes.innerHTML = this.getEmblaApi()
				.scrollSnapList()
				.map(() => '<button class="embla__dot" type="button"></button>')
				.join('');

			const scrollTo = (index) => {
				this.getEmblaApi().scrollTo(index);
			};

			this.dotNodes = Array.prototype.slice.call(
				this.dotNodes.querySelectorAll('.embla__dot'),
				0
			);
			this.dotNodes.forEach((dotNode, index) => {
				dotNode.addEventListener('click', () => scrollTo(index), false);
			});
		};

		const toggleDotBtnsActive = () => {
			const previous = this.getEmblaApi().previousScrollSnap();
			const selected = this.getEmblaApi().selectedScrollSnap();
			this.dotNodes[previous].classList.remove('embla__dot--selected');
			this.dotNodes[selected].classList.add('embla__dot--selected');
		};

		this.emblaApi
			.on('init', addDotBtnsWithClickHandlers)
			.on('reInit', addDotBtnsWithClickHandlers)
			.on('init', toggleDotBtnsActive)
			.on('reInit', toggleDotBtnsActive)
			.on('select', toggleDotBtnsActive);
	}

	removeDotBtnsAndClickHandlers() {
		this.dotNodes.innerHTML = '';
	}
}
