<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="site/css/norm.css">
    <link rel="stylesheet" href="site/css/header.css">
    <script src="site/js/modules/localforage.js"></script>
    <script src="site/js/modules/RCJS_API.js"></script>
    <script src="site/js/modules/XMLsync.js"></script>
    <script src="site/js/Nadia.js"></script>
    <script src="site/js/site.js"></script>
    <title>Nadia-Web</title>
</head>

<body>
    <header>
        <img src="site/img/icone.png" alt="icone">
        <div id="navig">
            <nav>
                <?php
                foreach (json_decode(file_get_contents(__DIR__ . "/header.json"), true) as $key => $value) {
                    echo "<p><a href=\"" . $value . "\">" . $key . "</a></p>";
                }
                ?>
            </nav>
        </div>
        <div class="circular" id="avatar_div">
            <img id="avatar_img" alt="se connecter" src="Site/img/connect.jpg">
            <div id="listA">
                <p><a href="account.php">Info</a></p>
                <p><a href="createApp.php">Create App</a></p>
            </div>
        </div>
    </header>
    <div>
        <div class="partie">
            <h1>Nadia</h1>
            <h3>Un compte, Une personne, Des applications</h3>
        </div>
    </div>
</body>

</html>