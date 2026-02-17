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
     PROCESS SLIDER
     ============================================ */
	const processSlider = document.getElementById("process-slider");
	const processPrev = document.getElementById("process-prev");
	const processNext = document.getElementById("process-next");

	if (processSlider && processPrev && processNext) {
		const scrollAmount = 350; // process card width roughly

		processPrev.addEventListener("click", function () {
			processSlider.scrollBy({ left: -scrollAmount, behavior: "smooth" });
		});

		processNext.addEventListener("click", function () {
			processSlider.scrollBy({ left: scrollAmount, behavior: "smooth" });
		});
	}
});
