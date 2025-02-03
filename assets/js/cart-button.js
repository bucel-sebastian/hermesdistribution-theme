jQuery(function ($) {
  $(document.body).on("hermes_cart_updated", function (event) {
    $.ajax({
      url: wc_add_to_cart_params.ajax_url,
      type: "GET",
      data: {
        action: "get_cart_item_count",
      },
      success: function (response) {
        if (response.success) {
          const cartCount = response.data.count;

          if (cartCount > 0 && cartCount < 10) {
            $(".cart-count").show();
            $(".cart-count").text(cartCount);
          } else if (cartCount > 9) {
            $(".cart-count").show();
            $(".cart-count").text("9+");
          } else {
            $(".cart-count").hide();
          }
        } else {
          console.log("Failed to get cart count");
        }
      },
    });
  });
});
