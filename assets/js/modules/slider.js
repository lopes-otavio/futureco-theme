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
});
