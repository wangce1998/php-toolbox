<?php

require_once __DIR__.'/vendor/autoload.php';

try {
    $data = \PHPToolbox\Json::decode('{"name":"","info":{},"arr":[]}');
    var_dump(\PHPToolbox\Json::isEmptyObject($data['info']));
    // var_dump(gettype($data['info']));
    // echo \PHPToolbox\Json::encode($data);
    // var_dump($data);
} catch (Exception $exception) {
    echo $exception->getMessage();
}

