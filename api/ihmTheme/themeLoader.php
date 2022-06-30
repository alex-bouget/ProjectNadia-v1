<?php

function getThemeFolder($AppId)
{
    $realDocRoot = realpath($_SERVER['DOCUMENT_ROOT']);
    $realDirPath = realpath(__DIR__);
    $suffix = str_replace($realDocRoot, '', $realDirPath);
    $prefix = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
    $folderUrl = $prefix . $_SERVER['HTTP_HOST'] . $suffix;
    return $folderUrl . "/$AppId/";
}

function header_construct($AppId)
{
    $folderUrl = getThemeFolder($AppId);
    if (is_dir(__DIR__ . "/" . $AppId)) {
        if (file_exists(__DIR__ . "/" . $AppId . "/header.html")) {
            $header = file_get_contents(__DIR__ . "/" . $AppId . "/header.html");
            $header = str_replace("<!ThemeUrl>", $folderUrl, $header);
            echo $header;
        }
    }
}

function style_construct($AppId)
{
    if (is_dir(__DIR__ . "/" . $AppId)) {
        if (file_exists(__DIR__ . "/" . $AppId . "/style.css")) {
            echo file_get_contents(__DIR__ . "/" . $AppId . "/style.css");
        }
    }
}
