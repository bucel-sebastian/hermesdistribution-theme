jQuery(document).ready(function ($) {
  // Ascultăm evenimentul de submit al formularului
  $("#contact-form").on("submit", function (e) {
    e.preventDefault(); // Prevenim comportamentul implicit de submit

    // Colectăm datele din formular
    var formData = {
      nume: $('input[name="nume"]').val(),
      companie: $('input[name="companie"]').val(),
      email: $('input[name="email"]').val(),
      telefon: $('input[name="telefon"]').val(),
      subiect: $('input[name="subiect"]').val(),
      mesaj: $('textarea[name="mesaj"]').val(),
      tc: $('input[name="tc"]').is(":checked") ? 1 : 0,
    };

    // Trimitem datele prin AJAX
    $.ajax({
      url: contactForm.ajax_url, // URL-ul endpoint-ului AJAX
      type: "POST",
      data: {
        action: "submit_contact_form", // Acțiunea pentru hook-ul WordPress
        form_data: formData, // Datele formularului
        security: contactForm.nonce, // Nonce-ul
      },
      success: function (response) {
        if (response.success) {
          // Afișăm un mesaj de succes
          alert("Mesajul a fost trimis cu succes!");
          $(".contact-form-content form")[0].reset(); // Resetăm formularul
        } else {
          // Afișăm un mesaj de eroare
          alert(response.data);
        }
      },
      error: function () {
        alert("A apărut o eroare la comunicarea cu serverul.");
      },
    });
  });
});
