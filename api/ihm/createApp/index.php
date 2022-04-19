<!DOCTYPE html>
<?php
error_reporting(E_ERROR);
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
    include __DIR__ . "/../test_admin.php";
    if (isset($_POST["Error"])) {
        echo "<h1>" . $_POST["Error"] . "</h1>";
    }
    ?>
    <h1>Create App</h1>
    <br>
    <form method="POST" action="createApp.php">
        <input type="hidden" value=<?php echo "${_POST["APPID"]}"; ?> name="APPID">
        <input type="hidden" value=<?php echo "${_POST["tempToken"]}"; ?> name="tempToken">
        <input type="hidden" value=<?php echo "${_POST["URI"]}"; ?> name="URI">
        <input type="hidden" value=<?php echo "${_POST["UserName"]}"; ?> name="UserName">
        <input type="hidden" value=<?php echo "${_POST["Token"]}"; ?> name="Token">
        <input type="hidden" value=<?php echo "${_POST["AToken"]}"; ?> name="AToken">
        <p>App Name</p>
        <input type="text" name="Aname">
        <p>Description</p>
        <input type="text" name="Adesc">
        <br>
        <input type="submit" value="Create App">
    </form>
    <form method="POST" action=<?php echo urldecode($_POST["URI"]); ?>>
        <input type="submit" value="return">
    </form>
</body>

</html>