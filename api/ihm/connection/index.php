<?php

error_reporting(E_ERROR);
include_once __DIR__ . "/../../app/AppApi.php";
include_once __DIR__ . "/../../client/AccountAPI.php";

$api = new AppApi();
$api2 = new AccountAPI();
$tokenGood = isset(json_decode($api->testTempToken($_POST["APPID"], $_POST["tempToken"]), true)["Error"]);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Nadia-App Authorize</title>
    <script src="../form_launcher.js"></script>
</head>

<body>
    <?php
    include __DIR__ . "/../test_token.php";
    include __DIR__ . "/../test_account.php";

    $result = json_decode($api->have_account($_POST["Token"], $_POST["APPID"]), true);

    if (isset($result["Error"])) { ?>
        <h1>App Authorize</h1>
        <br>
        <p><?php echo json_decode($api->getAppName($_POST["APPID"]), true)["Name"]; ?> want to use your nadia account like connection</p>
        <form method="POST" action="addAppAccount.php">
            <input type="hidden" value=<?php echo "${_POST["APPID"]}"; ?> name="APPID">
            <input type="hidden" value=<?php echo "${_POST["tempToken"]}"; ?> name="tempToken">
            <input type="hidden" value=<?php echo "${_POST["URI"]}"; ?> name="URI">
            <input type="hidden" value=<?php echo "${_POST["UserName"]}"; ?> name="UserName">
            <input type="hidden" value=<?php echo "${_POST["Token"]}"; ?> name="Token">
            <input type="hidden" value=<?php echo "${_POST["AToken"]}"; ?> name="AToken">
            <input type="submit" value="Connect">
        </form>
        <form method="POST" action=<?php echo urldecode($_POST["URI"]); ?>>
            <input type="hidden" value="User not want you" name="Error">
            <input type="submit" value="Refuse">
        </form>
    <?php } else { ?>
        <script>
            formLauncher(
                "POST",
                <?php echo json_encode($_POST["URI"]); ?>, {
                    "Token": <?php echo json_encode($result[0]); ?>,
                    "A-Token": <?php echo json_encode($result[1]); ?>,
                    "UserName": <?php echo json_encode($result[2]); ?>
                }
            );
        </script>
    <?php } ?>
</body>

</html>