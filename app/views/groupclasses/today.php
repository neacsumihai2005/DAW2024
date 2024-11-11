<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Today's Group Classes</title>
    <link rel="stylesheet" href="\SalaFitness\app\views\groupclasses\styles.css">
</head>
<body>
<h1>Group Classes left for today</h1>
<?php if (count($todayGroupClasses) > 0): ?>
    <table>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Instructor Name</th>
            <th>Date</th>
        </tr>
        <?php foreach ($todayGroupClasses as $groupclass) : ?>
            <tr>
                <td><?= $groupclass["name"] ?></td>
                <td><?= $groupclass["description"] ?></td>
                <td><?= $groupclass["instructor_name"] ?></td>
                <td><?= $groupclass["schedule"] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>No more group classes left for today.</p>
<?php endif; ?>
</body>
</html>
