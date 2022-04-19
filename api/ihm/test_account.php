<?php
if (isset(json_decode($api2->connect_account($_POST["UserName"], $_POST["AToken"], "Token"), true)["Error"])) { ?>
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
    die();
}
?>