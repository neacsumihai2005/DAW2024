<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Înregistrare</title>
    <!-- Scriptul pentru Google reCAPTCHA v2 -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="stylesheet" href="/DAW2024/app/views/register/styles.css">
</head>
<body>
    <form id="register-form" action="/DAW2024/register" method="POST">
        <h1>Înregistrare utilizator</h1>

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

        <!-- Google reCAPTCHA v2 -->
        <div class="g-recaptcha" data-sitekey="6Lc7j6EqAAAAANcHLRf38wJidIkAFxKuoHWrWk6X"></div><br><br>

        <button type="submit">Înregistrează-te</button>
    </form>
</body>
</html>
