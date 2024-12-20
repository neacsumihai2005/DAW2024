<!-- app/views/workouts/index.php -->

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Workout-urile tale</title>
    <!-- Include CSS-ul pentru stiluri -->
    <link rel="stylesheet" href="/DAW2024/app/views/workouts/stylesIndex.css">
</head>
<body>

    <h1>Workout-urile tale</h1>

    <!-- Afișarea lista de workout-uri -->
    <?php if (empty($workouts)): ?>
        <p>Nu ai salvat niciun workout încă.</p>
    <?php else: ?>
        <table>
            <tr>
                <th>Exercițiu</th>
                <th>Seturi</th>
                <th>Repetări</th>
                <th>Greutate</th>
                <th>Data</th>
            </tr>
            <?php foreach ($workouts as $workout): ?>
            <tr>
                <td><?php echo htmlspecialchars($workout['exercise_name']); ?></td>
                <td><?php echo htmlspecialchars($workout['sets']); ?></td>
                <td><?php echo htmlspecialchars($workout['reps']); ?></td>
                <td><?php echo htmlspecialchars($workout['weight'] ?? 'N/A'); ?></td>
                <td><?php echo htmlspecialchars($workout['date']); ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>

    <!-- Formularul pentru adăugarea unui workout -->
    
    <div class="container">
    <h2>Adaugă un Workout Nou</h2>

    <form action="/DAW2024/workouts/save" method="POST" class="workout-form">
        <label for="exercise_id">Exercițiul:</label>
        <select id="exercise_id" name="exercise_id" required>
            <option value="">Selectează un exercițiu</option>
            <?php foreach ($exercises as $exercise): ?>
                <option value="<?php echo htmlspecialchars($exercise['id']); ?>">
                    <?php echo htmlspecialchars($exercise['name']); ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="reps">Repetări:</label>
        <input type="number" id="reps" name="reps" required><br><br>

        <label for="sets">Seturi:</label>
        <input type="number" id="sets" name="sets" required><br><br>

        <label for="weight">Greutate (kg):</label>
        <input type="number" id="weight" name="weight" step="0.1"><br><br>

        <label for="description">Descriere:</label>
        <textarea id="description" name="description" rows="4" cols="50" required></textarea><br><br>

        <button type="submit">Adaugă Workout</button>
    </form>
</div>

</body>
</html>
