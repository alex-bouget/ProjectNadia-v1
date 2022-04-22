<!DOCTYPE html>
<?php
error_reporting(E_ERROR);
include __DIR__ . "/../../ihmTheme/themeLoader.php";
?>
<html>

<head>
    <style>
        <?php
        style_construct($_POST["APPID"]);
        ?>
    </style>
    <title>Nadia-Root</title>
    <script src="../form_launcher.js"></script>
</head>

<body>
    <?php
    include __DIR__ . "/../test_token.php";
    include __DIR__ . "/../test_account.php";
    include __DIR__ . "/../test_admin.php";
    if (isset($_POST["Error"])) {
        echo "<h1>" . $_POST["Error"] . "</h1>";
    }
    header_construct($_POST["APPID"]);
    ?>
    <div>
        <div class="partie">
            <h1>Nadia-API</h1>
            <h2>Change Password</h2>
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
        </div>
    </div>
</body>

</html>