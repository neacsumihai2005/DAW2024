<!-- app/views/workouts/index.php -->

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Workout-urile tuturor</title>
    <!-- Include CSS-ul pentru stiluri -->
    <link rel="stylesheet" href="/DAW2024/app/views/workouts/stylesIndex.css">
</head>
<body>

    <h1>Workout-urile tuturor</h1>

    <!-- Afișarea lista de workout-uri -->
    <?php if (empty($workouts)): ?>
        <p>Nu este salvat niciun workout încă.</p>
    <?php else: ?>
        <table>
            <tr>
                <th>Utilizator</th> <!-- Adăugat pentru a afișa numele utilizatorului -->
                <th>Exercițiu</th>
                <th>Seturi</th>
                <th>Repetări</th>
                <th>Greutate</th>
                <th>Data</th>
            </tr>
            <?php foreach ($workouts as $workout): ?>
            <tr>
                <td><?php echo htmlspecialchars($workout['first_name'] . ' ' . $workout['last_name']); ?></td> <!-- Numele utilizatorului -->
                <td><?php echo htmlspecialchars($workout['exercise_name']); ?></td>
                <td><?php echo htmlspecialchars($workout['sets']); ?></td>
                <td><?php echo htmlspecialchars($workout['reps']); ?></td>
                <td><?php echo htmlspecialchars($workout['weight'] ?? 'N/A'); ?></td>
                <td><?php echo htmlspecialchars($workout['date']); ?></td>
            </tr>
            <?php endforeach; ?>
        </table>

    <?php endif; ?>
</div>

</body>
</html>
