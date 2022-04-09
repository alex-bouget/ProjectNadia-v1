# ProjectNadia

Nadia is a centralize account system

Is purpose is too simplified database with multiple account to one big database with all the account we can be connected to multiple application (like the api of google, facebook or twitter)

It's work with [PcJsApi](https://github.com/MisterMine01/PCJsApi)

## Exemple


Exemple of get account (php):
```php
include "PcJsApi.php";

$nadia = "url to PcJs Server";

$app = array(
    "AppId" => "Id",
    "Secret_Key" => "Key"
);

$uri = "url/exit.php";
// The url where nadia return the connection

$pcjs = new PcJsApi($nadia);

$data = $pcjs->getJsBySystem("GetTempToken", array(
    "appKey" => $app[0],
    "appSecret" => $app[1]
));
// Get a public token of connection to the app
// (like change secret key to a public key)

change_location(
    $nadia . "connect/",
    array(
        "APPID" => $data["AppId"],
        "tempToken" => $data["TempToken"],
        "URI" => $uri
    )
);
// change_location is a function who redirect with the get parameters
```
you can find an *exemple* of change_location
in [exemple/connection.php](https://github.com/MisterMine01/ProjectNadia/blob/main/exemple/connection.php)

Return in **exit.php**
```php
var_dump($_POST)
/*
array (size=3)
  'UserToken' => string 'token' (length=15)
  'AToken' => string 'AToken' (length=60)
  'UserName' => string 'name' (length=X)

OR

array (size=1)
  'Error' => string 'tempToken not valid' (length=19)

OR

array (size=1)
  'Error' => string 'User not want you' (length=17)
*/
```