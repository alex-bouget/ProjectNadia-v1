<footer>
    <?php
    foreach (json_decode(file_get_contents(__DIR__ . "/end.json"), true) as $key => $value) {
        echo "<p><a href=\"" . $value . "\">" . $key . "</a></p>";
    }
    ?>
</footer>
<!--<iframe src="https://gigly.alwaysdata.net/Utopia/client" width="100%" height="100%"></iframe>-->
</body>

</html>