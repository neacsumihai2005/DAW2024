<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Workout-urile tale</title>
    <link rel="stylesheet" href="/DAW2024/app/views/workouts/stylesIndex.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Adăugăm Chart.js -->
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

    <h1>Numarul de seturi efectuate de user (indiferent de exercitiu) in timp</h1>

<div>
    <h2>Graficul pentru seturile efectuate</h2>
    <canvas id="setsChart" width="400" height="200"></canvas>
</div>

<script>
    // Injectăm datele PHP în JavaScript
    const workouts = <?php echo json_encode($workouts); ?>;

    // Funcția pentru crearea graficului
    function createSetsChart() {
        // Sortăm workout-urile după dată (presupunem că datele sunt în format 'YYYY-MM-DD')
        workouts.sort((a, b) => new Date(a.date) - new Date(b.date));

        // Extragem datele necesare pentru grafic
        const labels = workouts.map(item => item.date); // Timpul
        const setsData = []; // Seturile efectuate
        let totalSets = 0;

        // Calculăm numărul total de seturi pe măsură ce avansează timpul
        workouts.forEach(workout => {
            totalSets += workout.sets;
            setsData.push(totalSets); // Păstrăm totalul seturilor până la acel moment
        });

        // Creăm graficul
        const ctx = document.getElementById('setsChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels, // Etichetele pe axa X (timpul)
                datasets: [{
                    label: 'Numărul de Seturi',
                    data: setsData, // Numărul total de seturi
                    borderColor: 'rgb(75, 192, 192)', // Culoarea liniei
                    fill: false, // Nu umple zona sub linie
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Timpul'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Numărul Total de Seturi'
                        },
                        beginAtZero: true, // Asigurăm că axa Y începe de la 0
                    }
                }
            }
        });
    }

    // Inițializăm graficul
    createSetsChart();

</script>


</body>
</html>
