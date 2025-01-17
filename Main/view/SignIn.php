<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - PawsitiveWellbeing</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }

        .container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 40px;
            background-color: white;
            padding: 40px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            width: 70%;
            max-width: 1000px;
        }

        .form-container {
            max-width: 400px;
            width: 100%;
        }

        h1 {
            text-align: center;
            font-size: 2.5em;
            color: #2c3e50;
        }

        .logo-container img {
            height: 300px;
        }

        form input, form button {
            display: block;
            margin: 10px 0;
            width: 100%;
            padding: 10px;
            font-size: 1.1em;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        form button {
            background-color: #3498db;
            color: white;
            cursor: pointer;
            border: none;
            font-size: 1.1em;
        }

        form button:hover {
            background-color: #2980b9;
        }

        .form-footer {
            text-align: center;
            margin-top: 20px;
        }

        .form-footer a {
            color: #3498db;
            text-decoration: none;
        }

        .form-footer a:hover {
            text-decoration: underline;
        }
        footer {
            background-color: #2c3e50;
            color: white;
            text-align: center;
            padding: 10px 0;
            width: 100%;
            position: absolute; /* Position it absolutely */
            bottom: 0; /* Stick it to the bottom */
        }


        .error-message {
            color: red;
            font-size: 1.2em;
            text-align: center;
        }

    </style>
</head>
<body>

    <!-- Sign-In Container -->
    <div class="container">
        <!-- Logo -->
        <div class="logo-container">
            <img src="../images/PrimaryLogo.png" alt="PawsitiveWellbeing Logo">
        </div>

        <!-- Sign-In Form -->
        <div class="form-container">
            <h1>Sign In</h1>
            <form id="sign-in-form" action="/submit" method="POST">
                <input type="text" name="email_or_id" placeholder="Enter your Email or ID" required>
                <input type="password" name="password" placeholder="Enter your Password" required>
                <button type="submit">Sign In</button>
            </form>

            <div class="form-footer">
                <p>Don't have an account? <a href="UserCategory.html">Sign Up</a></p>
            </div>

            <!-- Error Message (to show if the user doesn't exist) -->
            <div id="error-message" class="error-message" style="display: none;">
                <p>We couldn't find your account. Please <a href="signup.html">sign up</a> to create one.</p>
            </div>
        </div>
    </div>
    <footer>
        © 2025 PawsitiveWellbeing. All rights reserved.
    </footer>

    <script>
        document.getElementById('sign-in-form').addEventListener('submit', function(event) {
            event.preventDefault();

            // Example of checking if the email or ID is correct and password.
            // In a real scenario, you would check this against a database or API.
            const userInput = event.target.elements['email_or_id'].value;
            const passwordInput = event.target.elements['password'].value;
            const errorMessage = document.getElementById('error-message');

            // Simulating an invalid user for demonstration purposes
            const validUsers = {
                'user@example.com': 'password123',
                'user123': 'mypassword'
            };

            if (!(validUsers[userInput] && validUsers[userInput] === passwordInput)) {
                errorMessage.style.display = 'block';
            } else {
                // Redirect to a user dashboard or home page
                window.location.href = '/dashboard.html'; // Change to the actual URL for logged-in users
            }
        });
    </script>

</body>
</html>
