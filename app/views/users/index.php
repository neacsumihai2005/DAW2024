<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitness Gym Members</title>
    <link rel="stylesheet" href="\DAW2024\app\views\users\styles.css">
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
                    <th>Action</th> <!-- Coloană pentru acțiuni (Promovare/Demote) -->
                    <th>Delete Account</th> <!-- Coloană pentru ștergere cont -->
                </tr>
                <?php foreach ($users as $user) : ?>
                    <tr>
                        <td>
                            <a href="#" class="edit-link" data-id="<?= $user["id"] ?>" data-type="first_name"><?= $user["first_name"] ?></a>
                        </td>
                        <td>
                            <a href="#" class="edit-link" data-id="<?= $user["id"] ?>" data-type="last_name"><?= $user["last_name"] ?></a>
                        </td>
                        <td>
                            <a href="#" class="edit-link" data-id="<?= $user["id"] ?>" data-type="email"><?= $user["email"] ?></a>
                        </td>
                        <td>
                            <a href="#" class="edit-link" data-id="<?= $user["id"] ?>" data-type="phone_number"><?= $user["phone_number"] ?></a>
                        </td>
                        <td>
                            <?php if ($user["role_id"] == 1) : ?>
                                <form action="/DAW2024/users/promote" method="POST">
                                    <input type="hidden" name="user_id" value="<?= $user["id"] ?>">
                                    <button type="submit">Promovează la Admin</button>
                                </form>
                            <?php elseif ($user["role_id"] == 2) : ?>
                                <form action="/DAW2024/users/demote" method="POST">
                                    <input type="hidden" name="user_id" value="<?= $user["id"] ?>">
                                    <button type="submit">Șterge rolul</button>
                                </form>
                            <?php elseif ($user["role_id"] == 3) : ?>
                                <span>Este Owner</span>
                            <?php endif; ?>
                        </td>

                        <!-- Coloană pentru ștergerea contului -->
                        <td>
                            <?php if ($user["role_id"] != 3) : ?>
                                <form action="/DAW2024/users/deleteSomeones" method="POST">
                                    <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                    <button type="submit">Șterge contul</button>
                                </form>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </main>
    </div>

    <!-- Formular pentru editare -->
    <div id="editModal" style="display:none;">
        <form action="/DAW2024/users/edit" method="POST">
            <input type="hidden" name="user_id" id="user_id">
            <input type="hidden" name="field_type" id="field_type"> <!-- Câmp ascuns pentru tipul câmpului -->
            <label for="new_value">Noua valoare:</label>
            <input type="text" name="new_value" id="new_value" required>
            <button type="submit">Salvează modificările</button>
            <button type="button" id="cancelEdit">Anulează</button>
        </form>
    </div>

    <script>
        // Funcționalitate pentru a deschide formularul de editare
        document.querySelectorAll('.edit-link').forEach(function(link) {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                var userId = this.getAttribute('data-id');
                var fieldType = this.getAttribute('data-type');  // Obținem tipul câmpului (de exemplu, 'phone_number')
                var currentValue = this.innerText;

                // Setăm valorile în formularul de editare
                document.getElementById('user_id').value = userId;
                document.getElementById('new_value').value = currentValue;
                document.getElementById('field_type').value = fieldType;  // Setăm tipul câmpului în formular

                // Deschidem formularul de editare
                document.getElementById('editModal').style.display = 'block';
            });
        });

        // Funcționalitate pentru a închide formularul de editare
        document.getElementById('cancelEdit').addEventListener('click', function() {
            document.getElementById('editModal').style.display = 'none';
        });
    </script>
</body>
</html>
