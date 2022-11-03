<!-- LAUNCH Admin App lock -->
<script>
    formLauncher(
        "POST",
        "<?php echo urldecode($_POST["URI"]) ?>", {
            "Error": "App not have the right"
        }
    );
</script>