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

<h5>Required information</h5>
<div class="login-form">
<form action="index.php?ctrl=security&action=register" method="post">
    <div class="form-content">
        <label for="userName">User name :</label>
        <input type="text" id="userName" name="userName" placeholder="Ton pseudo ici..." required>
    </div>
    <div class="form-content">
        <label for="mail">Mail :</label>
        <input type="email" id="mail" name="mail" placeholder="Ton mail ici..." required>
    </div>
    <div class="form-content">
        <label for="password">Password :</label>
        <input type="password" id="password" name="password" placeholder="Ton password ici..." required>
    </div>
    <div class="form-content">
        <label for="confirmPassword">Confirm password :</label>
        <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Ton password ici..." required>
    </div>
    <div class="form-submit">
        <input type="submit" value="Sign in">
    </div>
</form>
</div>