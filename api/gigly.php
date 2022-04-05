<?php
function get_properties($key) {
    global $properties;
    return $properties[$key];
}

function create_token($length) {
    $Symbol = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $token = substr(str_shuffle(str_repeat($x = $Symbol, ceil($length / strlen($x)))), 1, $length);
    return $token;
}

function reach_equivalent($array, $entry, $entry_name) {
    foreach ($array as $value) {
        if ($value[$entry_name] == $entry) {
            return true;
        }
    }
    return false;
}

function get_once($array, $entry, $entry_name, $ouptut_name) {
    foreach ($array as $value) {
        if ($value[$entry_name] == $entry) {
            return $value[$ouptut_name];
        }
    }
    return -1;
}

function get_all($array, $entry, $entry_name) {
    $d = array();
    foreach ($array as $value) {
        if ($value[$entry_name] == $entry) {
            $d[] = $value;
        }
    }
    return $d;
}

function get_key($array, $entry, $entry_name) {
    foreach ($array as $key=>$value) {
        if ($value[$entry_name] == $entry) {
            return $key;
        }
    }
    return false;

}