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

<div class="login-form">
    <form action="index.php?ctrl=security&action=login" method="post">
        <div class="form-content">
            <label for="user-name">User Name :</label>
            <input type="text" id="userName" name="userName" placeholder="Ton nom ici...">
        </div>
        <div class="form-content">
            <label for="password">Password :</label>
            <input type="password" id="password" name="password" placeholder="Mot de passe...">
        </div>
        <div class="form-submit">
            <input type="submit" value="Log in">
        </div>
    </form>
</div>