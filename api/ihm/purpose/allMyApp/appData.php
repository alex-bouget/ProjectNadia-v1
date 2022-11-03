<!DOCTYPE html>
<?php
error_reporting(E_ERROR);
include __DIR__ . "/../../../ihmTheme/themeLoader.php";
include_once __DIR__ . "/../../../app/AppApi.php";
include_once __DIR__ . "/../../../client/AccountAPI.php";

$Api = new AppApi();
$allApp = json_decode($Api->getAppData($_POST["AppViewer"], $_POST["Token"], $_POST["AToken"]), true);

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
    include __DIR__ . "/../../test_token.php";
    include __DIR__ . "/../../test_account.php";
    include __DIR__ . "/../../test_admin.php";
    if (isset($_POST["Error"])) {
        echo "<h1>" . $_POST["Error"] . "</h1>";
    }
    header_construct($_POST["APPID"]);
    ?>
    <div>
        <div class="partie">
            <h1>Nadia-API</h1>
            <form method="POST" action="saveApp.php">
                <input type="hidden" value=<?php echo "${_POST["APPID"]}"; ?> name="APPID">
                <input type="hidden" value=<?php echo "${_POST["tempToken"]}"; ?> name="tempToken">
                <input type="hidden" value=<?php echo "${_POST["URI"]}"; ?> name="URI">
                <input type="hidden" value=<?php echo "${_POST["UserName"]}"; ?> name="UserName">
                <input type="hidden" value=<?php echo "${_POST["Token"]}"; ?> name="Token">
                <input type="hidden" value=<?php echo "${_POST["AToken"]}"; ?> name="AToken">
                <input type="hidden" value=<?php echo "${_POST["AppViewer"]}"; ?> name="AppViewer">
                <p>AppName: <input type="text" value="<?php echo $allApp["appName"] ?>" name="AppName"></p>
                <p>Description: <input type="text" value="<?php echo $allApp["appDesc"] ?>" name="AppDesc"></p>
                <input type="submit" value="Save">
            </form>
            <form method="POST" action=<?php echo urldecode($_POST["URI"]); ?>>
                <input type="submit" value="return">
            </form>
        </div>
    </div>
</body>

</html>