
<!DOCTYPE html>
<html>
<head>
    <title>Payment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        h2 {
            color: #4CAF50;
            text-align: center;
            margin-top: 40px;
        }

        form {
            max-width: 400px;
            margin: 40px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: bold;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .payment-options {
            text-align: center;
            margin-top: 20px;
        }

        .payment-options img {
            width: 80px;
            margin: 10px;
            cursor: pointer;
        }

        /* CSS for the pop-up message */
        .popup {
            position: fixed;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            z-index: 9999;
        }

        .popup-content {
            text-align: center;
            margin-bottom: 10px;
        }

        .popup-close {
            position: absolute;
            top: 5px;
            right: 10px;
            font-size: 18px;
            cursor: pointer;
        }

        .popup-button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .popup-button:hover {
            background-color: #45a049;
        }
    </style>
   <script>
        function displayMessage(paymentMethod) {
            var popup = document.createElement('div');
            popup.classList.add('popup');

            var popupContent = document.createElement('div');
            popupContent.classList.add('popup-content');
            popupContent.innerHTML = '<h3>You selected:</h3><p>' + paymentMethod + '</p>';

            var popupClose = document.createElement('span');
            popupClose.classList.add('popup-close');
            popupClose.innerHTML = '&times;';
            popupClose.addEventListener('click', function() {
                document.body.removeChild(popup);
            });

            popup.appendChild(popupContent);
            popup.appendChild(popupClose);

            document.body.appendChild(popup);

            // Store the selected payment method in a hidden input field
            var paymentMethodInput = document.getElementById('payment_method');
            paymentMethodInput.value = paymentMethod;
        }
    </script>
</head>
<body>
    <h2>Payment</h2>
    <form action="" method="POST">
        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" id="first_name" required><br><br>

        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" id="last_name" required><br><br>

        <label for="phone_number">Phone Number:</label>
        <input type="text" name="phone_number" id="phone_number" required><br><br>

        <div class="payment-options">
            <img src="cbe.JPG" alt="Visa" onclick="displayMessage('Commericial Bank of Ethopia')">
            <img src="Dashen.JPG" alt="PayPal" onclick="displayMessage('Dashen Bank')">
            <img src="birhan.JPG" alt="Mastercard" onclick="displayMessage('Birhan Bank')">
            <img src="awash.JPG" alt="Visa" onclick="displayMessage('Awash Bank')">
            <img src="oromo.JPG" alt="Visa" onclick="displayMessage('Bank of Oromia')">
            <img src="abay.JPG" alt="Visa" onclick="displayMessage('Abay Bank')">
            <!-- Add more payment option images here -->
        </div>

        <input type="submit" value="Make Payment">
		
    </form>
</body>
</html>
