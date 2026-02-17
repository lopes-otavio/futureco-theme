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
		contactForm.addEventListener("submit", function (e) {
			e.preventDefault();

			const formData = new FormData(contactForm);
			formData.append("action", "futureco_contact");
			formData.append("nonce", futurecoData.nonce);

			const submitBtn = contactForm.querySelector('button[type="submit"]');
			const originalText = submitBtn.innerHTML;
			submitBtn.innerHTML = "Enviando...";
			submitBtn.disabled = true;

			fetch(futurecoData.ajaxUrl, {
				method: "POST",
				body: formData,
			})
				.then(function (response) {
					return response.json();
				})
				.then(function (data) {
					if (data.success) {
						alert(
							"Mensagem enviada com sucesso! Entraremos em contato em breve.",
						);
						contactForm.reset();
					} else {
						alert(data.data || "Erro ao enviar mensagem. Tente novamente.");
					}
				})
				.catch(function () {
					alert("Erro de conexão. Tente novamente mais tarde.");
				})
				.finally(function () {
					submitBtn.innerHTML = originalText;
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
