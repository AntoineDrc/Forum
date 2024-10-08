<?php 

$users = $result['data']['users'];
?>

<div class="h1-secondary">
    <h1>Gestion des utilisateurs</h1>
</div>
<table>
    <tr>
        <th>Nom Utilisateur</th>
        <th>Date d'inscription</th>
        <th>Status</th>
        <th>Action</th>
    </tr>

    <?php foreach ($users as $user ): ?>
    <tr>
        <td><?= $user->getUserName() ?></td>
        <td><?= $user->getFormattedRegistrationDate() ?></td>
        <td><?= $user->getIsbanned() ? 'Banni' : 'Actif' ?></td>
        <td>
            <?php if ($user->getIsBanned()): ?>
                <a href="index.php?ctrl=security&action=unBanUser&id=<?= $user->getId() ?>">Debannir</a>
            <?php else: ?>
                <a href="index.php?ctrl=security&action=banUser&id=<?= $user->getId()?>">Bannir</a>
            <?php endif; ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

