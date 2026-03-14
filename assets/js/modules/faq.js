/**
 * FAQ Module
 * Handles: FAQ accordion toggle via Event Delegation
 */

document.addEventListener("DOMContentLoaded", function () {
	const faqList = document.querySelector(".faq-list");
	if (!faqList) return;

	faqList.addEventListener("click", function (e) {
		const btn = e.target.closest(".faq-question");
		if (!btn) return;

		const faqItem = btn.closest(".faq-item");
		const isOpen = faqItem.classList.contains("open");

		// Close all other FAQ items in this list
		faqList.querySelectorAll(".faq-item.open").forEach(function (item) {
			if (item !== faqItem) {
				item.classList.remove("open");
			}
		});

		// Toggle current
		faqItem.classList.toggle("open", !isOpen);
	});
});
