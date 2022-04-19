<script>
    formLauncher(
        "POST",
        "../connection/",
        <?php
        echo "{";
        foreach ($_POST as $key => $value) {
            if ($key != "Purpose") {
                echo "'" . $key . "':'" . $value . "',";
            }
        }
        echo "}";
        ?>
    );
</script>