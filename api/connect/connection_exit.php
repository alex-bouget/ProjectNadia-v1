<?php
error_reporting(E_ERROR);
include __DIR__ . "/../client/AccountAPI.php";

$api = new AccountAPI();

$result = json_decode(
    ($_POST["alreadyConnected"] == "true") ?
        $api->connect_account($_POST["user"], $_POST["pass"], "AdminToken") : (
            ($_POST["type"] == "create") ?
            $api->create_account($_POST["user"], $_POST["pass"]) :
            $api->connect_account($_POST["user"], $_POST["pass"], "Password")
        ),
    true
);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Nadia-Connection</title>
    <script src="form_launcher.js"></script>
</head>

<body>
    <?php
    if (isset($result["Error"])) {
    ?>
        <script>
            formLauncher(
                "GET",
                "index.php", {
                    "APPID": "<?php echo $_POST["APPID"]; ?>",
                    "tempToken": "<?php echo $_POST["tempToken"]; ?>",
                    "URI": "<?php echo $_POST["URI"]; ?>",
                    "Error": "<?php echo urlencode($result["Error"]); ?>"
                }
            );
        </script>
    <?php } else { ?>
        <script>
            formLauncher(
                "POST",
                "app_connection.php", {
                    "APPID": <?php echo json_encode($_POST["APPID"]); ?>,
                    "tempToken": <?php echo json_encode($_POST["tempToken"]); ?>,
                    "URI": <?php echo json_encode($_POST["URI"]); ?>,
                    "UserName": <?php echo json_encode($result["UserName"]); ?>,
                    "Token": <?php echo json_encode($result["Token"]); ?>,
                    "AToken": <?php echo json_encode($result["A-Token"]); ?>
                }
            )
        </script>
    <?php } ?>
</body>

</html>