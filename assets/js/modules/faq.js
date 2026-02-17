/**
 * FAQ Module
 * Handles: FAQ accordion toggle
 */

/* ============================================
   FAQ TOGGLE (Global function)
   ============================================ */
function toggleFaq(button) {
	const faqItem = button.closest(".faq-item");
	const isOpen = faqItem.classList.contains("open");

	// Close all other FAQ items
	document.querySelectorAll(".faq-item.open").forEach(function (item) {
		if (item !== faqItem) {
			item.classList.remove("open");
		}
	});

	// Toggle current
	faqItem.classList.toggle("open", !isOpen);
}

// No need for DOMContentLoaded since function is global and called inline onclick
