<?php

error_reporting(E_ERROR);
include_once __DIR__ . "/../app/AppApi.php";
include_once __DIR__ . "/../client/AccountAPI.php";

$api = new AppApi();
$api2 = new AccountAPI();

if (!$api2->connect_account($_POST["UserName"], $_POST["AToken"], "Token")) { ?>
    <form method="GET" action="connection.php" id="formul">
        <input type="hidden" value=<?php echo "${_POST["APPID"]}"; ?> name="APPID">
        <input type="hidden" value=<?php echo "${_POST["tempToken"]}"; ?> name="tempToken">
        <input type="hidden" value=<?php echo "${_POST["URI"]}"; ?> name="URI">
        <input type="hidden" value=<?php echo urlencode("Problem with account connection,\ntry again"); ?> name="Error">
    </form>
    <script>
        document.getElementById("formul").submit();
    </script>
<?php
    exit();
}

$result = $api->have_account($_POST["Token"], $_POST["APPID"]);
var_dump($result);
if (is_bool($result) || $result == null) { ?>
    <title>App Authorize</title>
    <h1>App Authorize</h1>
    <br>
    <p><?php echo $api->getAppName($_POST["APPID"]); ?> Want use your nadia account</p>
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
    <form method="GET" action=<?php echo urldecode($_POST["URI"]); ?> id="formul">
        <input type="hidden" value=<?php echo "${result[0]}"; ?> name="UserToken">
        <input type="hidden" value=<?php echo "${result[1]}"; ?> name="AToken">
        <input type="hidden" value=<?php echo "${result[2]}"; ?> name="UserName">
    </form>
    <script>
        document.getElementById("formul").submit();
    </script>
<?php } ?>