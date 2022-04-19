<?php
include_once __DIR__ . "/../app/AppApi.php";
$test_token = new AppApi();
$tokenGood = isset(json_decode($test_token->testTempToken($_GET["APPID"], $_GET["tempToken"]), true)["Error"]);
if ($tokenGood) { ?>
    <script>
        /*formLauncher(
            "POST",
            "<?php echo urldecode($_GET["URI"]) ?>", {
                "Error": "tempToken not valid"
            }
        );*/
    </script>
<?php
    die();
}

?>