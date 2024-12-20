<!-- formular.php -->
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adaugă Exercițiu</title>
    <link rel="stylesheet" href="\DAW2024\app\views\exercises\stylesFormular.css">
</head>
<body>

    <h1>Adaugă un Exercițiu</h1>

    <!-- Formularul pentru adăugarea unui exercițiu -->
    <form action="/DAW2024/exercises/store" method="POST">
        <label for="name">Nume Exercițiu:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="description">Descriere:</label>
        <textarea id="description" name="description" required></textarea><br><br>

        <label for="category">Categorie:</label>
        <input type="text" id="category" name="category" required><br><br>

        <label for="youtube_video_id">ID YouTube Video: (ID NOT FULL LINK)</label>
        <input type="text" id="youtube_video_id" name="youtube_video_id" required><br><br>

        <button type="submit">Adaugă Exercițiu</button>
    </form>

</body>
</html>
