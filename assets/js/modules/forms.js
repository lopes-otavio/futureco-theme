/**
 * Forms Module
 * Handles: Contact form, Newsletter form
 */
document.addEventListener("DOMContentLoaded", function () {
	/* ============================================
     CONTACT FORM
     ============================================ */
	const contactForm = document.getElementById("contact-form");
	if (contactForm) {
		const phoneInput = document.getElementById("contact-phone");

		// Phone Mask: (00) 00000-0000
		if (phoneInput) {
			phoneInput.addEventListener("input", function (e) {
				let value = e.target.value.replace(/\D/g, "");
				if (value.length > 11) value = value.slice(0, 11);

				let formattedValue = "";
				if (value.length > 0) {
					formattedValue = "(" + value.slice(0, 2);
					if (value.length > 2) {
						formattedValue += ") " + value.slice(2, 7);
						if (value.length > 7) {
							formattedValue += "-" + value.slice(7);
						}
					}
				}
				e.target.value = formattedValue;
			});
		}

		contactForm.addEventListener("submit", function (e) {
			e.preventDefault();

			// Clear previous errors
			const feedback = document.getElementById("contact-form-feedback");
			if (feedback) {
				feedback.classList.remove("is-success", "is-error");
				feedback.textContent = "";
			}

			contactForm.querySelectorAll(".form-group").forEach((group) => {
				group.classList.remove("has-error");
				const errorMsg = group.querySelector(".error-message");
				if (errorMsg) errorMsg.textContent = "";
			});

			const submitBtn = contactForm.querySelector('button[type="submit"]');
			const submitBtnText = submitBtn.querySelector("span");
			const initialBtnText = submitBtnText
				? submitBtnText.textContent
				: submitBtn.textContent;

			// Basic Validation
			const nameInput = document.getElementById("contact-name");
			const emailInput = document.getElementById("contact-email");
			const phoneInput = document.getElementById("contact-phone");
			const messageInput = document.getElementById("contact-message");

			let hasError = false;

			function showError(input, message) {
				const group = input.closest(".form-group");
				if (group) {
					group.classList.add("has-error");
					const errorMsg = group.querySelector(".error-message");
					if (errorMsg) errorMsg.textContent = message;
				}
				hasError = true;
			}

			if (!nameInput.value.trim()) {
				showError(nameInput, "O nome é obrigatório.");
			}

			const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
			if (!emailInput.value.trim()) {
				showError(emailInput, "O email é obrigatório.");
			} else if (!emailRegex.test(emailInput.value.trim())) {
				showError(emailInput, "Por favor, insira um email válido.");
			}

			if (phoneInput && phoneInput.value.trim()) {
				const phoneDigits = phoneInput.value.replace(/\D/g, "");
				if (phoneDigits.length < 10 || phoneDigits.length > 11) {
					showError(
						phoneInput,
						"Por favor, insira um telefone válido (10 ou 11 dígitos).",
					);
				}
			}

			if (!messageInput.value.trim()) {
				showError(messageInput, "A mensagem é obrigatória.");
			}

			if (hasError) return;

			// Change button state
			if (submitBtnText) submitBtnText.textContent = "Enviando...";
			else submitBtn.textContent = "Enviando...";
			submitBtn.disabled = true;

			const formData = new FormData(contactForm);
			formData.append("action", "futureco_contact");
			formData.append("nonce", futurecoData.nonce);

			fetch(futurecoData.ajaxUrl, {
				method: "POST",
				body: formData,
			})
				.then(function (response) {
					return response.json();
				})
				.then(function (data) {
					if (data.success) {
						if (feedback) {
							feedback.textContent =
								"Mensagem enviada com sucesso! Entraremos em contato em breve.";
							feedback.classList.add("is-success");
						}
						contactForm.reset();
					} else {
						if (feedback) {
							feedback.textContent =
								data.data || "Erro ao enviar mensagem. Tente novamente.";
							feedback.classList.add("is-error");
						}
					}
				})
				.catch(function () {
					if (feedback) {
						feedback.textContent =
							"Erro de conexão. Tente novamente mais tarde.";
						feedback.classList.add("is-error");
					}
				})
				.finally(function () {
					if (submitBtnText) submitBtnText.textContent = initialBtnText;
					else submitBtn.textContent = initialBtnText;
					submitBtn.disabled = false;
				});
		});
	}

	/* ============================================
     NEWSLETTER FORM
     ============================================ */
	const newsletterForm = document.getElementById("newsletter-form");
	if (newsletterForm) {
		newsletterForm.addEventListener("submit", function (e) {
			e.preventDefault();

			const formData = new FormData(newsletterForm);
			formData.append("action", "futureco_newsletter");
			formData.append("nonce", futurecoData.nonce);

			fetch(futurecoData.ajaxUrl, {
				method: "POST",
				body: formData,
			})
				.then(function (response) {
					return response.json();
				})
				.then(function (data) {
					if (data.success) {
						alert("Inscrito com sucesso na newsletter!");
						newsletterForm.reset();
					} else {
						alert(data.data || "Erro ao inscrever. Tente novamente.");
					}
				})
				.catch(function () {
					alert("Erro de conexão. Tente novamente.");
				});
		});
	}
});
