<?php 

$users = $result['data']['users'];
?>

<div class="admin">
    <div class="h1-secondary">
        <h1>Gestion des utilisateurs</h1>
    </div>
    <table>
        <thead>
            <tr>
                <th>Nom Utilisateur</th>
                <th>Date d'inscription</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user ): ?>
            <tr>
                <td class="user"><?= $user->getUserName() ?></td>
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
        </tbody>
    </table>
</div>
