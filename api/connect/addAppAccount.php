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

$result = json_decode($api->addAccount($_POST["APPID"], $_POST["Token"], $_POST["AToken"]), true);
?>

<form method="GET" action=<?php echo urldecode($_POST["URI"]); ?> id="formul">
    <input type="hidden" value=<?php echo "${result["Token"]}"; ?> name="UserToken">
    <input type="hidden" value=<?php echo "${result["A-Token"]}"; ?> name="AToken">
    <input type="hidden" value=<?php echo "${_POST["UserName"]}"; ?> name="UserName">
</form>
<script>
    document.getElementById("formul").submit();
</script>