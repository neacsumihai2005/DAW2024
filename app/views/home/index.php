<!-- app/views/home/index.php -->
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/DAW2024/app/views/home/styles.css">
    <title>Login - Sala Fitness</title>
</head>
<body>

    <!-- Formularul de login -->
    <div class="login-container">

        <form action="/DAW2024/login" method="POST">
            <h1>Autentificare</h1>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Introduceți adresa de email" required>

            <label for="password">Parolă:</label>
            <input type="password" id="password" name="password" placeholder="Introduceți parola" required>

            <button type="submit">Autentificare</button>
        </form>

        <p>Nu ai cont? <a href="/DAW2024/register/formular">Înregistrează-te aici</a></p>
    </div>

</body>
</html>
