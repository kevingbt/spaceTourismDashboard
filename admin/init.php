<?php

$conf = json_decode(file_get_contents('../confSpace.json'), true);
foreach ($conf as $key => $value) {
    $_ENV[$key] = $value;
}

spl_autoload_register(function (string $x) {
    require_once '..' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . $x . '.php';
});
