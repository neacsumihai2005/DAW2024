<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Știri Fitness</title>
</head>
<body>
    <h1>Știri din Lumea Fitness-ului</h1>

    <?php
        // Verificăm dacă există știri
        if (!empty($news_items)) {
            echo "<ul>";
            foreach ($news_items as $news) {
                echo "<li><a href='" . $news['link'] . "'>" . $news['title'] . "</a><br>";
                echo "<p>" . $news['description'] . "</p></li>";
            }
            echo "</ul>";
        } else {
            echo "<p>Nu au fost găsite știri.</p>";
        }
    ?>

</body>
</html>
