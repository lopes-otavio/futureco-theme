document.addEventListener("DOMContentLoaded", function () {
	/* ============================================
     SMOOTH SCROLL FOR ANCHOR LINKS (Delegation)
     ============================================ */
	document.body.addEventListener("click", function (e) {
		const anchor = e.target.closest('a[href^="#"]');
		if (!anchor) return;

		const targetId = anchor.getAttribute("href");
		if (targetId === "#") return;

		try {
			const target = document.querySelector(targetId);
			if (target) {
				e.preventDefault();

				// Find active visible header for offset calculation
				const activeHeader = document.querySelector(
					'.site-header:not([style*="display: none"])',
				);
				const headerHeight = activeHeader ? activeHeader.offsetHeight : 0;

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
