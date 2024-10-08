<?php 
$user = App\Session::getUser();
?>

<div class="profile">
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
                <td><?= $user->getUserName() ?></td>
                <td><?= $user->getFormattedRegistrationDate() ?></td>
                <td><?= $user->getIsBanned() ? "Banni" : "Utilisateur" ?></td>
                <td>
                    <a href="index.php?ctrl=security&action=deleteAcc">
                        <button type="input">Supprimer</button>
                </td>
                </a>    
            </tr>
        </tbody>
    </table>
</div>
