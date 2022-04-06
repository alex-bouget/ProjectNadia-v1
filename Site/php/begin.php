<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="Site/css/norm.css">
    <link rel="stylesheet" href="Site/css/header.css">
    <script src="Site/js/modules/localforage.js"></script>
    <script src="Site/js/modules/RCJS_API.js"></script>
    <script src="Site/js/modules/XMLsync.js"></script>
    <script src="Site/js/ClientAPI.js"></script>
    <script src="Site/js/PBattle.js"></script>
    <script src="Site/js/account.js"></script>
</head>

<body>
    <header>
        <img src="Site/img/gigly.png" alt="icone">
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
            </div>
        </div>
    </header>