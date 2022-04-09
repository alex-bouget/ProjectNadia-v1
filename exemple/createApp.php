<?php

include_once __DIR__ . "/../api/app/AppApi.php";

error_reporting(E_ERROR);

$api = new AppApi();

$result = $api->addApp("Exemple", "This is an exemple", "RepcniDFd2tCjK4", "JzM7wbTjgkSNKxe6mZoan04csWLGF19IVi2fuPBy5dHX3qYDvrpAElQU8tOC");
var_dump($result);
