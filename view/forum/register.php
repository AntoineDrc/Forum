<div class="h1-secondary">
    <h1>REGISTRATION FORM</h1>
</div>

<?php 

if (isset($_SESSION['passError']))
{
    echo "<p><b>" . $_SESSION['passError'] . "</b></p>";
    unset($_SESSION['passError']);
}

if (isset($_SESSION['mailError']))
{
    echo "<p><b>" . $_SESSION['mailError'] . "</b></p>";
    unset($_SESSION['mailError']);
}

if (isset($_SESSION['nameError']))
{
    echo "<p><b>" . $_SESSION['nameError'] . "</b></p>";
    unset($_SESSION['nameError']);
}
?>

<div class="registration-form">
    <h5>Required information</h5>
    <form action="index.php?ctrl=security&action=register" method="post">
        <label for="userName">User name</label>
        <input type="text" id="userName" name="userName" placeholder="Ton pseudo ici..." required>

        <label for="mail">Mail</label>
        <input type="mail" id="mail" name="mail" placeholder="Ton mail ici..." required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Ton password ici..." required>

        <label for="confirmPassword">Confirm password</label>
        <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Ton password ici..." required>

        <input type="submit" value="Sign in">
    </form>
</div>