<!DOCTYPE html>
<?php
error_reporting(E_ERROR);
include __DIR__ . "/../../ihmTheme/themeLoader.php";
include_once __DIR__ . "/../../app/AppApi.php";
include_once __DIR__ . "/../../client/AccountAPI.php";
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
            <h2>All your nadia-application</h2>
            <div>
                <?php
                $Api = new AppApi();
                $allApp = json_decode($Api->getAllMyApp($_POST["Token"], $_POST["AToken"]), true);
                foreach ($allApp as $app) {
                ?>
                    <div class='app'>
                        <h3><?php echo $app["appName"]; ?></h3>
                        <p><?php echo $app["appDesc"]; ?></p>
                        <form method="POST" action="appData.php">
                            <input type="hidden" value=<?php echo "${_POST["APPID"]}"; ?> name="APPID">
                            <input type="hidden" value=<?php echo "${_POST["tempToken"]}"; ?> name="tempToken">
                            <input type="hidden" value=<?php echo "${_POST["URI"]}"; ?> name="URI">
                            <input type="hidden" value=<?php echo "${_POST["UserName"]}"; ?> name="UserName">
                            <input type="hidden" value=<?php echo "${_POST["Token"]}"; ?> name="Token">
                            <input type="hidden" value=<?php echo "${_POST["AToken"]}"; ?> name="AToken">
                            <input type="hidden" value=<?php echo "${app["appId"]}"; ?> name="AppViewer">
                            <input type="submit" value="Go to the app">
                        </form>
                    </div>
                <?php } ?>
                <form method="POST" action=<?php echo urldecode($_POST["URI"]); ?>>
                    <input type="submit" value="return">
                </form>
            </div>
        </div>
    </div>
</body>

</html>