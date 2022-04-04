<?php
include_once "../database.php";

function GetServerId()
{
	return json_encode(array("ServId" => get_properties("ServerId")));
}

function Lang()
{
	return json_encode(array("fr_FR", "en_US", "fr"));
}
