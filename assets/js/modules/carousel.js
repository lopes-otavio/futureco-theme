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

	// Auto-advance testimonials
	if (testimonialSlides.length > 1) {
		setInterval(function () {
			const newIndex =
				currentTestimonial === testimonialSlides.length - 1
					? 0
					: currentTestimonial + 1;
			showTestimonial(newIndex);
		}, 6000);
	}
});
