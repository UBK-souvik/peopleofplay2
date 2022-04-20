<!-- Load Stripe.js on your website. -->
<script src="https://js.stripe.com/v3"></script>

<!-- Create a button that your customers click to complete their purchase. Customize the styling to suit your branding. -->
<button
  style="background-color:#6772E5;color:#FFF;padding:8px 12px;border:0;border-radius:4px;font-size:1em;cursor:pointer"
  id="checkout-button-price_1IKiRzBgD4GNlNtNjddx1Y7S" role="link" type="button"> Checkout </button>

<div id="error-message"></div>
<script>
(function() {
  var stripe = Stripe('pk_live_51HPhuEBgD4GNlNtNzEw6LuXpPfkYnaUh4QqO4oFK9fcuKxs7hNwPNXKmXCh2hYXkxnbDgoxTnEuVWOoWtjLD7oCg00yDlmLgmy');
  var checkoutButton = document.getElementById('checkout-button-price_1IKiRzBgD4GNlNtNjddx1Y7S');
  checkoutButton.addEventListener('click', function () {
    stripe.redirectToCheckout({
      lineItems: [{price: 'price_1IKiRzBgD4GNlNtNjddx1Y7S', quantity: 1}],
      mode: 'subscription',

      successUrl: 'https://peopleofplay.com/success',
      cancelUrl: 'https://peopleofplay.com/canceled',
    })
    .then(function (result) {
      if (result.error) {
        var displayError = document.getElementById('error-message');
        displayError.textContent = result.error.message;
      }
    });
  });
})();
</script>