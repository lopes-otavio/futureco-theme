document.addEventListener("DOMContentLoaded", () => {
	/* ============================================
	   HEADER PRIMARY + SECONDARY (overlay slide-down)
	   ============================================ */

	const primary = document.querySelector('[data-header="primary"]');
	const secondary = document.querySelector('[data-header="secondary"]');

	if (primary && secondary) {
		const SHOW_AT = 160; // ajuste aqui (px) quando o secundário deve aparecer

		let ticking = false;

		const closeMenus = () => {
			document
				.querySelectorAll(".site-header .mobile-menu.open")
				.forEach((m) => {
					m.classList.remove("open");
				});
			document
				.querySelectorAll(".site-header .mobile-menu-btn")
				.forEach((btn) => {
					btn.setAttribute("aria-expanded", "false");
					const menuIcon = btn.querySelector(".menu-icon");
					const closeIcon = btn.querySelector(".close-icon");
					if (menuIcon) menuIcon.style.display = "block";
					if (closeIcon) closeIcon.style.display = "none";
				});
		};

		const setSecondaryVisible = (visible) => {
			if (visible) {
				primary.classList.add("is-hidden");
				secondary.classList.add("is-visible");
				secondary.setAttribute("aria-hidden", "false");
			} else {
				primary.classList.remove("is-hidden");
				secondary.classList.remove("is-visible");
				secondary.setAttribute("aria-hidden", "true");
				// se voltar pro topo, garante menus fechados pra evitar “menus fantasmas”
				closeMenus();
			}
		};

		const update = () => {
			const y = window.scrollY || 0;
			setSecondaryVisible(y > SHOW_AT);
			ticking = false;
		};

		window.addEventListener(
			"scroll",
			() => {
				if (!ticking) {
					requestAnimationFrame(update);
					ticking = true;
				}
			},
			{ passive: true },
		);

		window.addEventListener("resize", () => {
			// Em resize, fecha menus pra não quebrar layout
			closeMenus();
		});

		update();
	}

	/* ============================================
	   MOBILE MENU (funciona em ambos headers)
	   sem IDs duplicados, tudo por escopo
	   ============================================ */

	document.querySelectorAll(".site-header").forEach((header) => {
		const btn = header.querySelector(".mobile-menu-btn");
		const menu = header.querySelector(".mobile-menu");

		if (!btn || !menu) return;

		const menuIcon = btn.querySelector(".menu-icon");
		const closeIcon = btn.querySelector(".close-icon");

		const setIcons = (open) => {
			if (menuIcon) menuIcon.style.display = open ? "none" : "block";
			if (closeIcon) closeIcon.style.display = open ? "block" : "none";
			btn.setAttribute("aria-expanded", open ? "true" : "false");
		};

		setIcons(menu.classList.contains("open"));

		btn.addEventListener("click", () => {
			// fecha qualquer outro menu aberto (inclusive do outro header)
			document
				.querySelectorAll(".site-header .mobile-menu.open")
				.forEach((m) => {
					if (m !== menu) m.classList.remove("open");
				});
			document
				.querySelectorAll(".site-header .mobile-menu-btn")
				.forEach((b) => {
					if (b !== btn) {
						b.setAttribute("aria-expanded", "false");
						const mi = b.querySelector(".menu-icon");
						const ci = b.querySelector(".close-icon");
						if (mi) mi.style.display = "block";
						if (ci) ci.style.display = "none";
					}
				});

			const open = menu.classList.toggle("open");
			setIcons(open);
		});

		// ao clicar num link, fecha o menu
		menu.querySelectorAll("a").forEach((a) => {
			a.addEventListener("click", () => {
				menu.classList.remove("open");
				setIcons(false);
			});
		});
	});
});
