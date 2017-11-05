<?php

if (file_exists(__DIR__."/../vendor/autoload.php")) {
    require __DIR__."/../vendor/autoload.php";
} else {
    function ___loadClass($class)
    {
        $ex = explode("\\", $class, 2);
        if ($ex[0] === "App") {
            require __DIR__."/../app/".str_replace("\\", "/", $ex[1]).".php";
        } else {
            require __DIR__."/".str_replace("\\", "/", $class).".php";
        }
    }
    spl_autoload_register("___loadClass");
}

// Load helpers
$scan = scandir(__DIR__."/helpers");
unset($scan[0], $scan[1]);
foreach ($scan as $file) {
    require __DIR__."/helpers/".$file;
}

$app = new IceTea\IceTea();
$app->build();
