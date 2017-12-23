<?php
function md5string($password)
{
    $password = strrev($password);
    $password = sha1($password);
    for($i = 0;$i<15;$i++){
        $password = md5($password);
    }
    return $password;
}
?>