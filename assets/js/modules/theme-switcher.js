/* ============================================
   THEME SWITCHER (Dark / Light mode toggle)
   ============================================ */
document.addEventListener("DOMContentLoaded", () => {
	const STORAGE_KEY = "futureco-theme";

	// Todos os botões de toggle (desktop + mobile, ambos headers)
	const toggles = document.querySelectorAll(".theme-switcher__toggle");

	/**
	 * Aplica o tema no <body> e sincroniza os botões.
	 * @param {'dark'|'light'} theme
	 */
	const applyTheme = (theme) => {
		if (theme === "dark") {
			document.body.setAttribute("data-theme", "dark");
		} else {
			document.body.removeAttribute("data-theme");
		}

		// Sincroniza visual de todos os toggles
		toggles.forEach((btn) => {
			btn.classList.toggle("is-active", theme === "dark");

			// Atualiza label
			const label = btn.querySelector(".theme-switcher__label");
			if (label) {
				label.textContent = theme === "dark" ? "Modo Escuro" : "Modo Claro";
			}
		});
	};

	// Carrega preferência salva ou respeita preferência do sistema
	const saved = localStorage.getItem(STORAGE_KEY);
	if (saved) {
		applyTheme(saved);
	} else if (
		window.matchMedia &&
		window.matchMedia("(prefers-color-scheme: dark)").matches
	) {
		applyTheme("dark");
	}

	// Click handler — alterna e salva
	toggles.forEach((btn) => {
		btn.addEventListener("click", () => {
			const isDark = document.body.getAttribute("data-theme") === "dark";
			const newTheme = isDark ? "light" : "dark";
			applyTheme(newTheme);
			localStorage.setItem(STORAGE_KEY, newTheme);
		});
	});
});
