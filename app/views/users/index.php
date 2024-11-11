<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitness Gym Members</title>
    <link rel="stylesheet" href="\SalaFitness\app\views\users\styles.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Fitness Gym Members</h1>
        </header>
        <main>
            <table>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                </tr>
                <?php foreach ($users as $user) : ?>
                    <tr>
                        <td><?= $user["first_name"] ?></td>
                        <td><?= $user["last_name"] ?></td>
                        <td><?= $user["email"] ?></td>
                        <td><?= $user["phone_number"] ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </main>
    </div>
</body>
</html>
