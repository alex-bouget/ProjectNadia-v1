<?php

error_reporting(E_ERROR);
include_once __DIR__ . "/../app/AppApi.php";
include_once __DIR__ . "/../client/AccountAPI.php";

$api = new AppApi();
$api2 = new AccountAPI();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Nadia-App Authorize</title>
    <script src="form_launcher.js"></script>
</head>

<body>
    <?php
    if (!$api2->connect_account($_POST["UserName"], $_POST["AToken"], "Token")) { ?>
        <script>
            formLauncher(
                "GET",
                "connection.php", {
                    "APPID": "<?php echo $_POST["APPID"]; ?>",
                    "tempToken": "<?php echo $_POST["tempToken"]; ?>",
                    "URI": "<?php echo $_POST["URI"]; ?>",
                    "Error": "<?php echo urlencode("Problem with account connection,\ntry again"); ?>"
                }
            );
        </script>
    <?php
        exit();
    }

    $result = json_decode($api->addAccount($_POST["APPID"], $_POST["Token"], $_POST["AToken"]), true);
    ?>
    <script>
        formLauncher(
            "POST",
            "<?php echo urldecode($_POST["URI"]) ?>", {
                "UserToken": <?php echo json_encode($result["Token"]); ?>,
                "A-Token": <?php echo json_encode($result["A-Token"]); ?>,
                "UserName": <?php echo json_encode($_POST["UserName"]); ?>
            }
        )
    </script>
</body>
</html>