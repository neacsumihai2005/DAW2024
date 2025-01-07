<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sala Fitness</title>
    <link rel="stylesheet" href="/DAW2024/app/views/dashboard/styles.css">
</head>
<body>
    <h1>Welcome to your Dashboard</h1>

    <div class="dashboard-buttons">
        <a href="/DAW2024/exercises/index">
            <button class="dashboard-btn">Exercises List</button>
        </a>
        <a href="/DAW2024/classes/index">
            <button class="dashboard-btn">All Group Classes</button>
        </a>
        <a href="/DAW2024/classes/today">
            <button class="dashboard-btn">Group Classes Today</button>
        </a>
        <a href="/DAW2024/workouts/index">
            <button class="dashboard-btn">See Your Workouts</button>
        </a>
        <a href="/DAW2024/news">
            <button class="dashboard-btn">See Fitness News</button>
        </a>
    </div>

    <!-- Butonul de ștergere a contului -->
    <form action="/DAW2024/user/delete" method="POST" onsubmit="return confirm('Ești sigur că vrei să ștergi contul? Această acțiune este ireversibilă!');">
            <button class="delete-btn" type="submit">Șterge Contul</button>
    </form>

    <!-- Butonul de logout -->
    <form action="/DAW2024/logout" method="POST">
        <button class="logout-btn" type="submit">Log Out</button>
    </form>
</body>
</html>
