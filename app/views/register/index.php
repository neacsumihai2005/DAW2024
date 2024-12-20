<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Înregistrare</title>
    <script src="https://www.google.com/recaptcha/enterprise.js?render=6LeYeKEqAAAAAJFtMPom48D-fpGmBj0Lb14S7p1S"></script>
</head>
<body>
    <h1>Înregistrare utilizator</h1>
    <form id="register-form" action="DAW2024/register" method="POST">
        <label for="first_name">Prenume:</label>
        <input type="text" id="first_name" name="first_name" required><br><br>

        <label for="last_name">Nume:</label>
        <input type="text" id="last_name" name="last_name" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="phone_number">Telefon:</label>
        <input type="text" id="phone_number" name="phone_number" required><br><br>

        <label for="password">Parolă:</label>
        <input type="password" id="password" name="password" required><br><br>

        <button type="button" class="g-recaptcha" 
                data-sitekey="6LeYeKEqAAAAAJFtMPom48D-fpGmBj0Lb14S7p1S" 
                data-callback="onSubmit" 
                data-action="submit">
            Înregistrează-te
        </button>
    </form>

    <script>
        function onSubmit(token) {
            // Trimite formularul doar dacă reCAPTCHA este validat
            document.getElementById("register-form").submit();
        }
    </script>
</body>
</html>
