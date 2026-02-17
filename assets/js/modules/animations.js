/**
 * Animations Module
 * Handles: Scroll animations (Intersection Observer), Counter animation
 */
document.addEventListener("DOMContentLoaded", function () {
	/* ============================================
     SCROLL ANIMATIONS (Intersection Observer)
     ============================================ */
	const scrollElements = document.querySelectorAll(".scroll-animate");
	if (scrollElements.length > 0) {
		const observer = new IntersectionObserver(
			function (entries) {
				entries.forEach(function (entry) {
					if (entry.isIntersecting) {
						entry.target.classList.add("visible");
						observer.unobserve(entry.target);
					}
				});
			},
			{
				threshold: 0.1,
				rootMargin: "0px 0px -50px 0px",
			},
		);

		scrollElements.forEach(function (el) {
			observer.observe(el);
		});
	}

	/* ============================================
     COUNTER ANIMATION
     ============================================ */
	const statValues = document.querySelectorAll(".stat-value[data-target]");
	if (statValues.length > 0) {
		const counterObserver = new IntersectionObserver(
			function (entries) {
				entries.forEach(function (entry) {
					if (entry.isIntersecting) {
						const el = entry.target;
						const target = parseInt(el.getAttribute("data-target"));
						const suffix = el.textContent.replace(/[0-9]/g, "").trim();
						let current = 0;
						const increment = Math.ceil(target / 60);
						const duration = 2000;
						const stepTime = duration / (target / increment);

						const timer = setInterval(function () {
							current += increment;
							if (current >= target) {
								current = target;
								clearInterval(timer);
							}
							el.textContent = current + suffix;
						}, stepTime);

						counterObserver.unobserve(el);
					}
				});
			},
			{ threshold: 0.5 },
		);

		statValues.forEach(function (el) {
			counterObserver.observe(el);
		});
	}
});
