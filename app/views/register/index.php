<!-- app/views/home/register.php -->
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Înregistrare - Sala Fitness</title>
    <link rel="stylesheet" href="/SalaFitness/app/views/register/styles.css">
</head>
<body>
    <h1>Înregistrează-te pentru un cont nou</h1>
    
    <!-- Formularul de înregistrare -->
    <form action="/SalaFitness/register" method="POST">
        <label for="first_name">Prenume:</label>
        <input type="text" id="first_name" name="first_name" required><br><br>

        <label for="last_name">Nume:</label>
        <input type="text" id="last_name" name="last_name" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="password">Parolă:</label>
        <input type="password" id="password" name="password" required><br><br>

        <button type="submit">Înregistrează-te</button>
    </form>

    <a href="/SalaFitness/home">Înapoi la login</a>
</body>
</html>
