<!DOCTYPE html>
<?php

error_reporting(E_ERROR);
include_once __DIR__ . "/../../client/AccountAPI.php";

$api2 = new AccountAPI();
?>
<html>

<head>
    <title>Nadia-Root</title>
    <script src="../form_launcher.js"></script>
</head>

<body>
    <?php
    include __DIR__ . "/../test_token.php";
    include __DIR__ . "/../test_account.php";
    if ($_POST["pass"] != $_POST["pass2"]) { ?>
        <script>
            formLauncher(
                "POST",
                "index.php", {
                    "APPID": <?php echo json_encode($_POST["APPID"]); ?>,
                    "tempToken": <?php echo json_encode($_POST["tempToken"]); ?>,
                    "URI": <?php echo json_encode($_POST["URI"]); ?>,
                    "UserName": <?php echo json_encode($_POST["UserName"]); ?>,
                    "Token": <?php echo json_encode($_POST["Token"]); ?>,
                    "AToken": <?php echo json_encode($_POST["AToken"]); ?>,
                    "Error": "passwords not matching"
                }
            );
        </script>
    <?php
        exit();
    }
    $data = json_decode($api2->change_password($_POST["UserName"], $_POST["oldPass"], $_POST["pass"]), true);
    if (isset($data["Error"])) { ?>
        <script>
            formLauncher(
                "POST",
                "index.php", {
                    "APPID": <?php echo json_encode($_POST["APPID"]); ?>,
                    "tempToken": <?php echo json_encode($_POST["tempToken"]); ?>,
                    "URI": <?php echo json_encode($_POST["URI"]); ?>,
                    "UserName": <?php echo json_encode($_POST["UserName"]); ?>,
                    "Token": <?php echo json_encode($_POST["Token"]); ?>,
                    "AToken": <?php echo json_encode($_POST["AToken"]); ?>,
                    "Error": <?php echo json_encode($data["Error"]); ?>
                }
            );
        </script>
    <?php
        exit();
    }
    ?>
    <script>
        formLauncher(
            "POST",
            "<?php echo urldecode($_POST["URI"]) ?>", {}
        );
    </script>
</body>

</html>