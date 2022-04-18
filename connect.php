<?php

include "Site/php/PcJsApi.php";
$nadia = "http://github/Github/ProjectNadia/api/";

$pcjs = new PcJsApi($nadia);
include "api/private/Admin_app.php";

$data = $pcjs->getJsBySystem("GetTempToken", array(
    "appKey" => $admin_app["AppId"],
    "appSecret" => $admin_app["Secret_Key"]
));

$actual_link = explode(
    "/",
    (
        (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ?
        "https" :
        "http"
    ) . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"
);
unset($actual_link[count($actual_link) - 1]);
$actual_link = implode("/", $actual_link) . "/resultConnect.php";

?>
<form method="GET" action=<?php echo $nadia . "connect/"; ?> id="formul">
    <input type="hidden" value=<?php echo "${data["appId"]}"; ?> name="APPID">
    <input type="hidden" value=<?php echo "${data["TempToken"]}"; ?> name="tempToken">
    <input type="hidden" value=<?php echo "${actual_link}"; ?> name="URI">
</form>
<script>
    document.getElementById("formul").submit();
</script>