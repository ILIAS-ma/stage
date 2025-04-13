<?php
require 'user.php';

$users = readUsers();
?>

<table>
    <tr>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Email</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($users as $user): ?>
    <tr>
        <td><?php echo $user['nom']; ?></td>
        <td><?php echo $user['prenom']; ?></td>
        <td><?php echo $user['email']; ?></td>
        <td>
            <a href="update.php?id=<?php echo $user['id']; ?>">Modifier</a>
            <a href="delete.php?id=<?php echo $user['id']; ?>">Supprimer</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>