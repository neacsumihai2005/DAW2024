<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Group Classes</title>
    <link rel="stylesheet" href="\SalaFitness\app\views\groupclasses\styles.css">
</head>
<body>
<h1>All Group Classes</h1>
<table>
    <tr>
        <th>Name</th>
        <th>Description</th>
        <th>Instructor Name</th>
        <th>Date</th>
    </tr>
    <?php foreach ($groupclasses as $groupclass) : ?>
        <tr>
            <td><?= $groupclass["name"] ?></td>
            <td><?= $groupclass["description"] ?></td>
            <td><?= $groupclass["instructor_name"] ?></td>
            <td><?= $groupclass["schedule"] ?></td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
