/**
 * General Module
 * Handles: Smooth scroll for anchor links, Global initializations
 */
document.addEventListener("DOMContentLoaded", function () {
	/* ============================================
     SMOOTH SCROLL FOR ANCHOR LINKS
     ============================================ */
	const header = document.getElementById("site-header"); // Needed for offset calculation

	document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
		anchor.addEventListener("click", function (e) {
			const targetId = this.getAttribute("href");
			if (targetId === "#") return;

			// Handle simple fragment identifiers if they exist on the page
			try {
				const target = document.querySelector(targetId);
				if (target) {
					e.preventDefault();
					const headerHeight = header ? header.offsetHeight : 0;
					const targetPosition =
						target.getBoundingClientRect().top +
						window.pageYOffset -
						headerHeight;
					window.scrollTo({
						top: targetPosition,
						behavior: "smooth",
					});
				}
			} catch (err) {
				// Ignore invalid selectors
			}
		});
	});
});
