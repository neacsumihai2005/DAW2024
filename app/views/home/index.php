<!-- app/views/home/index.php -->
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="\SalaFitness\app\views\home\styles.css">
    <title>Login - Sala Fitness</title>
</head>
<body>
    
    <!-- Formularul de login -->
    <form action="/SalaFitness/dashboard" method="POST">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br><br>

    <label for="password">Parolă:</label>
    <input type="password" id="password" name="password" required><br><br>

    <button type="submit">Autentificare</button>
</form>

    <!-- Link către pagina de înregistrare -->
    <p>Nu ai cont? <a href="/SalaFitness/register">Înregistrează-te aici</a></p>

</body>
</html>
