
<!DOCTYPE html>
    <html lang="en">
      <head>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title>PayPal Standard Payments Integration | Client Demo</title>
      </head>

      <body>
        <div id="paypal-button-container"></div>
        <!-- Sample PayPal credentials (client-id) are included -->
        <script src="https://www.paypal.com/sdk/js?client-id=AfA_Uq4UqUYZrrWeC_T3dA_C7KzuH5rKL9JL9qC8711T3hfd0ZzGbXkMEeo8-WAaFpWXHyexJ2oSYsof&currency=PHP&intent=capture"></script>
        <script>
          const paypalButtonsComponent = paypal.Buttons({
              // optional styling for buttons
              // https://developer.paypal.com/docs/checkout/standard/customize/buttons-style-guide/ 
              style: {
                color: "gold",
                shape: "rect",
                layout: "horizontal"
              },

              // set up the transaction
              createOrder: (data, actions) => {
                  // pass in any options from the v2 orders create call:
                  // https://developer.paypal.com/api/orders/v2/#orders-create-request-body]
                  const createOrderPayload = {
                      purchase_units: [
                          {
                              amount: {
                                value: "123"
                              }
                          }
                      ]
                  };
                  return actions.order.create(createOrderPayload);
              },

              // finalize the transaction
              onApprove: (data, actions) => {
                  const captureOrderHandler = (details) => {
                      const payerName = details.payer.name.given_name;
                      window.location = "../payment_success.php"
                  };

                  return actions.order.capture().then(captureOrderHandler);
              },

              // handle unrecoverable errors
              onError: (err) => {
                  console.error('An error prevented the buyer from checking out with PayPal');
              }
          });

          paypalButtonsComponent
              .render("#paypal-button-container")
              .catch((err) => {
                  console.error('PayPal Buttons failed to render');
              });
        </script>
      </body>
    </html>
