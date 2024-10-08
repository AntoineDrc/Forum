<div class="h1-secondary">
    <h1>Log in</h1>
</div>

<?php 

if (isset ($_SESSION['nameError']))
{
    echo "<p><b>" . $_SESSION['nameError'] . "</b></p>";
    unset($_SESSION['nameError']);
}

if (isset($_SESSION['passError']))
{
    echo "<p><b>" . $_SESSION['passError'] . "</b></p>";
    unset($_SESSION['passError']);
}
?>



<form action="index.php?ctrl=security&action=login" method="post">
    <label for="userName"></label>
    <input type="text" id="userName" name="userName" placeholder="Ton nom ici...">

    <label for="password"></label>
    <input type="password" id="password" name="password" placeholder="Mot de passe...">

    <input type="submit" value="Log in">
</form>