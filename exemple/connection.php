<?php

include "PcJsApi.php";
$nadia = "http://github/Github/ProjectNadia/api/";
$app = array(
    "dBYLSf0RiVCjhK91xzTD7ParJ",
    "Wf8LWuYFUabEh735pl0wMHtQTV1dR69eNBrDogM2vtSGRxzz7XcmOJbywI98LXTZHQKSKy"
);

$pcjs = new PcJsApi($nadia);

$data = $pcjs->getJsBySystem("GetTempToken", array(
    "appKey" => $app[0],
    "appSecret" => $app[1]
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
$actual_link = implode("/", $actual_link) . "/result.php";

?>
<form method="GET" action=<?php echo $nadia . "connect/"; ?> id="formul">
    <input type="hidden" value=<?php echo "${data["appId"]}"; ?> name="APPID">
    <input type="hidden" value=<?php echo "${data["TempToken"]}"; ?> name="tempToken">
    <input type="hidden" value=<?php echo "${actual_link}"; ?> name="URI">
</form>
<script>
    document.getElementById("formul").submit();
</script>