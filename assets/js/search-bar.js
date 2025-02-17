jQuery(document).ready(function ($) {
  $("#woocommerce-product-search-field").on("input", function () {
    var searchQuery = $(this).val();

    if (searchQuery.length > 2) {
      // Pornim căutarea doar după 3 caractere
      $.ajax({
        url: search_bar.ajax_url,
        type: "POST",
        data: {
          action: "woocommerce_search_products",
          search_query: searchQuery,
        },
        success: function (response) {
          if (response) {
            $("#search-suggestions").html(response).show();
          } else {
            $("#search-suggestions").hide();
          }
        },
      });
    } else {
      $("#search-suggestions").hide();
    }
  });

  // Ascunde sugestiile când se face click în altă parte
  $(document).on("click", function (e) {
    if (!$(e.target).closest("#search-suggestions").length) {
      $("#search-suggestions").hide();
    }
  });
});
