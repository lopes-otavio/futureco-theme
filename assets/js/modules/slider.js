/**
 * Slider Module
 * Handles: Team slider logic
 */
document.addEventListener("DOMContentLoaded", function () {
	/* ============================================
     TEAM SLIDER
     ============================================ */
	const teamSlider = document.getElementById("team-slider");
	const teamPrev = document.getElementById("team-prev");
	const teamNext = document.getElementById("team-next");

	if (teamSlider && teamPrev && teamNext) {
		const scrollAmount = 316; // card width + gap

		teamPrev.addEventListener("click", function () {
			teamSlider.scrollBy({ left: -scrollAmount, behavior: "smooth" });
		});

		teamNext.addEventListener("click", function () {
			teamSlider.scrollBy({ left: scrollAmount, behavior: "smooth" });
		});
	}

	/* ============================================
     PROCESS SLIDER (Infinite Wrapper)
     ============================================ */
	const processSlider = document.getElementById("process-slider");
	const processPrev = document.getElementById("process-prev");
	const processNext = document.getElementById("process-next");

	if (processSlider && processPrev && processNext) {
		const getScrollAmount = () => {
			const card = processSlider.querySelector(".process-card");
			if (card) {
				const style = window.getComputedStyle(processSlider);
				const gap = parseInt(style.gap) || 24; // 1.5rem default
				return card.offsetWidth + gap;
			}
			return 350;
		};

		processNext.addEventListener("click", function () {
			const scrollAmount = getScrollAmount();
			const maxScroll = processSlider.scrollWidth - processSlider.clientWidth;

			if (processSlider.scrollLeft >= maxScroll - 10) {
				processSlider.scrollTo({ left: 0, behavior: "smooth" });
			} else {
				processSlider.scrollBy({ left: scrollAmount, behavior: "smooth" });
			}
		});

		processPrev.addEventListener("click", function () {
			const scrollAmount = getScrollAmount();

			if (processSlider.scrollLeft <= 10) {
				processSlider.scrollTo({
					left: processSlider.scrollWidth,
					behavior: "smooth",
				});
			} else {
				processSlider.scrollBy({ left: -scrollAmount, behavior: "smooth" });
			}
		});
	}
});
