<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sala Fitness</title>
    <link rel="stylesheet" href="/SalaFitness/app/views/dashboard/styles.css">
</head>
<body>
    <h1>Welcome to your Dashboard</h1>

    <div class="dashboard-buttons">
        <a href="/SalaFitness/users/index">
            <button class="dashboard-btn">All Users</button>
        </a>
        <a href="/SalaFitness/exercises/index">
            <button class="dashboard-btn">All Exercises</button>
        </a>
        <a href="/SalaFitness/classes/index">
            <button class="dashboard-btn">All Group Classes</button>
        </a>
        <a href="/SalaFitness/classes/today">
            <button class="dashboard-btn">Group Classes Today</button>
        </a>
    </div>

    <!-- Butonul de ștergere a contului -->
    <form action="/SalaFitness/dashboard/delete" method="POST" onsubmit="return confirm('Ești sigur că vrei să ștergi contul? Această acțiune este ireversibilă!');">
            <button class="delete-btn" type="submit">Șterge Contul</button>
    </form>
</body>
</html>
