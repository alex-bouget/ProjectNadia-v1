<?php
include_once __DIR__ . "/../client/AccountAPI.php";
$account = new AccountAPI();
if (isset(json_decode($account->connect_account($_POST["UserName"], $_POST["AToken"], "Token"), true)["Error"])) {
    if (isset($_POST["URI"])) { ?>
    <script>
        formLauncher(
            "GET",
            "../", {
                "APPID": "<?php echo $_POST["APPID"]; ?>",
                "tempToken": "<?php echo $_POST["tempToken"]; ?>",
                "URI": "<?php echo $_POST["URI"]; ?>",
                "Purpose": "PasswordChange",
                "Error": "<?php echo urlencode("Problem with account connection,\ntry again"); ?>"
            }
        );
    </script>
<?php
    } else {
        echo "What are you doing bro ?";
    }
    die();
}
?>