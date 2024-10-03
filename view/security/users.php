<?php 

$users = $result['data']['users'];
?>

<h1>Liste des utilisateurs</h1>

<?php 

    echo "<ul>";
    foreach ($users as $user)
    {
        echo "<li>" . $user->getUserName() . " inscrit le : " . $user->getRegistrationDate() . "</li>";
    }
    echo "</ul>";

?>

