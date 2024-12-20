<!-- app/views/group_classes/add.php -->

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adaugă un Group Class</title>
    <link rel="stylesheet" href="/DAW2024/app/views/groupclasses/stylesFormular.css">
</head>
<body>

<div class="container">
    <h2>Adaugă un Group Class</h2>

    <form action="/DAW2024/classes/save" method="POST" class="group-class-form">
        <!-- Numele grupului -->
        <label for="name">Nume Group Class:</label>
        <input type="text" id="name" name="name" required placeholder="Introduceți numele grupului"><br><br>

        <!-- Descrierea grupului -->
        <label for="description">Descriere:</label>
        <textarea id="description" name="description" rows="4" required placeholder="Introduceți o descriere pentru grupul de clase"></textarea><br><br>

        <!-- Instructor -->
        <label for="instructor_id">Instructor:</label>
        <select id="instructor_id" name="instructor_id" required>
            <option value="">Selectează un instructor</option>
            <?php foreach ($users as $user): ?>
                <option value="<?php echo htmlspecialchars($user['id']); ?>">
                    <?php echo htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>

        <!-- Programul grupului -->
        <label for="schedule">Program:</label>
        <input type="datetime-local" id="schedule" name="schedule" required><br><br>

        <!-- Capacitatea grupului -->
        <label for="capacity">Capacitate:</label>
        <input type="number" id="capacity" name="capacity" required placeholder="Număr de participanți"><br><br>

        <button type="submit">Adaugă Group Class</button>
    </form>
</div>

</body>
</html>
