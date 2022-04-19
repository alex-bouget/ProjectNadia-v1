<!DOCTYPE html>
<?php

error_reporting(E_ERROR);
include_once __DIR__ . "/../../client/AccountAPI.php";
$api2 = new AccountAPI();

?>
<html>

<head>
    <title>Nadia-Root</title>
    <script src="../form_launcher.js"></script>
</head>

<body>
    <?php
    include __DIR__ . "/../test_token.php";
    include __DIR__ . "/../test_account.php";
    if (isset($_POST["Error"])) {
        echo "<h1>" . $_POST["Error"] . "</h1>";
    }
    ?>
    <h1>Change Password</h1>
    <br>
    <form method="POST" action="passwChange.php">
        <input type="hidden" value=<?php echo "${_POST["APPID"]}"; ?> name="APPID">
        <input type="hidden" value=<?php echo "${_POST["tempToken"]}"; ?> name="tempToken">
        <input type="hidden" value=<?php echo "${_POST["URI"]}"; ?> name="URI">
        <input type="hidden" value=<?php echo "${_POST["UserName"]}"; ?> name="UserName">
        <input type="hidden" value=<?php echo "${_POST["Token"]}"; ?> name="Token">
        <input type="hidden" value=<?php echo "${_POST["AToken"]}"; ?> name="AToken">
        <p>Old password</p>
        <input type="text" name="oldPass">
        <p>password</p>
        <input type="text" name="pass">
        <p>retype password</p>
        <input type="text" name="pass2">
        <br>
        <input type="submit" value="Change password">
    </form>
    <form method="POST" action=<?php echo urldecode($_POST["URI"]); ?>>
        <input type="submit" value="return">
    </form>
</body>

</html>