/**
 * Carousel Module
 * Handles: Testimonial carousel logic
 */
document.addEventListener("DOMContentLoaded", function () {
	/* ============================================
     TESTIMONIAL CAROUSEL
     ============================================ */
	const testimonialSlides = document.querySelectorAll(".testimonial-slide");
	const testimonialDots = document.querySelectorAll(
		"#testimonial-dots .carousel-dot",
	);
	const prevBtn = document.getElementById("testimonial-prev");
	const nextBtn = document.getElementById("testimonial-next");
	let currentTestimonial = 0;

	function showTestimonial(index) {
		testimonialSlides.forEach(function (slide, i) {
			slide.style.display = i === index ? "block" : "none";
		});
		testimonialDots.forEach(function (dot, i) {
			dot.classList.toggle("active", i === index);
		});
		currentTestimonial = index;
	}

	if (prevBtn) {
		prevBtn.addEventListener("click", function () {
			const newIndex =
				currentTestimonial === 0
					? testimonialSlides.length - 1
					: currentTestimonial - 1;
			showTestimonial(newIndex);
		});
	}

	if (nextBtn) {
		nextBtn.addEventListener("click", function () {
			const newIndex =
				currentTestimonial === testimonialSlides.length - 1
					? 0
					: currentTestimonial + 1;
			showTestimonial(newIndex);
		});
	}

	testimonialDots.forEach(function (dot) {
		dot.addEventListener("click", function () {
			showTestimonial(parseInt(this.getAttribute("data-index")));
		});
	});

	// Auto-advance testimonials with optimizations
	if (testimonialSlides.length > 1) {
		let carouselInterval;
		const startCarousel = () => {
			if (carouselInterval) clearInterval(carouselInterval);
			carouselInterval = setInterval(function () {
				const newIndex =
					currentTestimonial === testimonialSlides.length - 1
						? 0
						: currentTestimonial + 1;
				showTestimonial(newIndex);
			}, 6000);
		};

		const stopCarousel = () => {
			if (carouselInterval) {
				clearInterval(carouselInterval);
				carouselInterval = null;
			}
		};

		const carouselContainer = testimonialSlides[0].parentElement;

		if (carouselContainer && "IntersectionObserver" in window) {
			const observer = new IntersectionObserver(
				(entries) => {
					entries.forEach((entry) => {
						if (
							entry.isIntersecting &&
							document.visibilityState === "visible"
						) {
							startCarousel();
						} else {
							stopCarousel();
						}
					});
				},
				{ threshold: 0.1 },
			);

			observer.observe(carouselContainer);

			document.addEventListener("visibilitychange", () => {
				if (document.visibilityState === "visible") {
					const rect = carouselContainer.getBoundingClientRect();
					if (rect.top < window.innerHeight && rect.bottom >= 0) {
						startCarousel();
					}
				} else {
					stopCarousel();
				}
			});
		} else {
			startCarousel();
			document.addEventListener("visibilitychange", () => {
				if (document.visibilityState === "visible") startCarousel();
				else stopCarousel();
			});
		}
	}
});

/* ============================================
   PARTNERS OWL CAROUSEL (Requires jQuery)
   ============================================ */
if (typeof jQuery !== "undefined") {
	jQuery(document).ready(function ($) {
		const $partnersCarousel = $(".partners-owl-carousel");
		if ($partnersCarousel.length) {
			$partnersCarousel.owlCarousel({
				loop: true,
				margin: 50,
				nav: false,
				dots: false,
				autoplay: true,
				slideTransition: "linear",
				autoplayTimeout: 4000,
				autoplaySpeed: 4000,
				autoplayHoverPause: true,
				autoWidth: false,
				responsive: {
					0: {
						items: 2,
						margin: 30,
					},
					600: {
						items: 3,
						margin: 40,
					},
					1000: {
						items: 5,
						margin: 50,
					},
				},
			});
		}
	});
}
