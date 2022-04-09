<?php

error_reporting(E_ERROR);
include __DIR__ . "/client/AccountAPI.php";

$api = new AccountAPI();


if ($_POST["type"] == "create") {
    $result = $api->create_account($_POST["user"], $_POST["pass"]);
} else {
    $result = $api->connect_account($_POST["user"], $_POST["pass"], "Password");
}
$result = json_decode($result, true);
if (isset($result["Error"])) {
?>
    <form method="GET" action="connection.php" id="formul">
        <input type="hidden" value=<?php echo "${_POST["APPID"]}"; ?> name="APPID">
        <input type="hidden" value=<?php echo "${_POST["tempToken"]}"; ?> name="tempToken">
        <input type="hidden" value=<?php echo "${_POST["URI"]}"; ?> name="URI">
        <input type="hidden" value=<?php echo urlencode($result["Error"]); ?> name="Error">
    </form>
    <script>
        document.getElementById("formul").submit();
    </script>
<?php } else { ?>
    <form method="POST" action="app_connection.php" id="formul2">
        <input type="hidden" value=<?php echo "${_POST["APPID"]}"; ?> name="APPID">
        <input type="hidden" value=<?php echo "${_POST["tempToken"]}"; ?> name="tempToken">
        <input type="hidden" value=<?php echo "${_POST["URI"]}"; ?> name="URI">
        <input type="hidden" value=<?php echo "${result["UserName"]}"; ?> name="UserName">
        <input type="hidden" value=<?php echo "${result["Token"]}"; ?> name="Token">
        <input type="hidden" value=<?php echo "${result["A-Token"]}"; ?> name="AToken">
    </form>
    <script>
        document.getElementById("formul2").submit();
    </script>
<?php } ?>