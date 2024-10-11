<?php 
$user = App\Session::getUser();
?>

<div class="profile">
    <div class="h1-secondary">
        <h1>Profile de <?= $user->getUserName() ?></h1>
    </div>
    <table>
        <thead>
            <tr>
                <th>Nom utilisateur</th>
                <th>Date d'inscription</th>
                <th>Status</th>
                <th>Suppression du compte</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="user"><?= $user->getUserName() ?></td>
                <td><?= $user->getFormattedRegistrationDate() ?></td>
                <td><?= $user->getIsBanned() ? "Banni" : "Utilisateur" ?></td>
                <td>
                    <a href="index.php?ctrl=security&action=deleteAcc" class="delete-acc">
                        <button type="input">Supprimer</button>
                </td>
                </a>    
            </tr>
        </tbody>
    </table>
</div>
