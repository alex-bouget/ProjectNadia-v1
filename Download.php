<?php include "Site/php/begin.php"; ?>
<div>
    <div class="partie">
        <h1>Télécharger</h1>
        <p>Telecharger les jeux et applications ici : </p>
        <br>
        <?php
        foreach(json_decode(file_get_contents("Site/Download/Download.json"), true) as $key => $value) {
            echo "<p>".$key."<br>";
            $t = 0;
            foreach ($value as $key1 => $value1) {
                if ($t == 0) {
                    $t = 1;
                } else {
                    echo " - ";
                }
                echo "<a href=\"".$value1."\">".$key1."</a>";
            }
            echo "</p><br>";
        }
        ?>
    </div>
</div>
<?php include "Site/php/end.php"; ?>