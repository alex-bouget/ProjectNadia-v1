<!DOCTYPE html>
<?php

error_reporting(E_ERROR);
include_once __DIR__ . "/../../app/AppApi.php";
include __DIR__ . "/../../ihmTheme/themeLoader.php";

$api = new AppApi();
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
    $appData = json_decode($api->addApp($_POST["Aname"], $_POST["Adesc"], $_POST["Token"], $_POST["AToken"]), true);
    header_construct($_POST["APPID"]);
    ?>

    <div>
        <div class="partie">
            <h1>New App Information</h1>
            <br>
            <h2>SAVE THIS INFORMATIONS, YOU CAN'T RECOVER IT</h2>
            <p>AppName: <?php echo $_POST["Aname"] ?></p>
            <p>AppDesc: <?php echo $_POST["Adesc"] ?></p>
            <p><b>AppId</b>: <?php echo $appData["AppId"]; ?></p>
            <p><b>AppSecret</b>: <?php echo $appData["Secret"]; ?></p>
            <form method="POST" action=<?php echo urldecode($_POST["URI"]); ?>>
                <input type="submit" value="return">
            </form>
        </div </div>
</body>

</html>