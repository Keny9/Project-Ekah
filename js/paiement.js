window.addEventListener('load', function () {
  var stripe = Stripe('pk_test_nexEKdAh5yqBBuHujvFYAwpq00HQmYWpWf');
  var elements = stripe.elements();

  var style = {
    base: {
      color: '#32325d',
      fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
      fontSmoothing: 'antialiased',
      fontSize: '16px',
      '::placeholder': {
        color: 'rgba(23, 41, 56, 0.4)',
      }
    },
    invalid: {
      color: '#fa755a',
      iconColor: '#fa755a'
    }
  };

  var cardNumberElement = elements.create('cardNumber', {
    style: style,
    placeholder: '4242 4242 4242 4242',
  });
  cardNumberElement.mount('#card-number-element');

  var cardExpiryElement = elements.create('cardExpiry', {
    style: style,
    placeholder: '04/24',
  });
  cardExpiryElement.mount('#card-expiry-element');

  var cardCvcElement = elements.create('cardCvc', {
    style: style,
    placeholder: '424'
  });
  cardCvcElement.mount('#card-cvc-element');



  function setOutcome(result) {
    var errorElement = document.querySelector('.error');
    errorElement.classList.remove('visible');

    if (result.token) {
    // Submit form
      var form = document.querySelector('form');
      form.querySelector('input[name="token"]').setAttribute('value', result.token.id);
      form.submit();
    } else if (result.error) {
      errorElement.textContent = result.error.message;
      errorElement.classList.add('visible');
    }
  }

  cardNumberElement.on('change', function(event) {
    setOutcome(event);
  });

  document.querySelector('form').addEventListener('submit', function(e) {
    e.preventDefault();
    var options = {
      address_zip: document.getElementById('postal-code').value,
    };
    stripe.createToken(cardNumberElement, options).then(setOutcome);
  });
}, false);
