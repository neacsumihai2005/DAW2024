<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitness Exercises</title>
    <link rel="stylesheet" href="\DAW2024\app\views\exercises\styles.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Fitness Exercises</h1>
        </header>
        <main>
            <table>
                <tr>
                    <th>Exercise</th>
                    <th>Description</th>
                    <th>Video Tutorial</th>
                </tr>
                <?php foreach ($exercises as $exercise) : ?>
                    <tr>
                        <td><?= htmlspecialchars($exercise["name"]) ?></td>
                        <td><?= htmlspecialchars($exercise["description"]) ?></td>
                        <td>
                            <iframe src="https://www.youtube.com/embed/<?= htmlspecialchars($exercise["youtube_video_id"]) ?>" frameborder="0" allowfullscreen></iframe>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </main>
    </div>
</body>
</html>
