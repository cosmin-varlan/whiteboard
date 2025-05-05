<?php
function autoload($class)
{

    if (file_exists(DIRECTOR_SITE . SLASH . 'utils' . SLASH . strtolower($class) . '.php'))
    {
        require_once DIRECTOR_SITE . SLASH . 'utils' . SLASH . strtolower($class) . '.php';
    }
        else if (file_exists(DIRECTOR_SITE . SLASH . 'models' . SLASH . strtolower($class) . '.php'))
    {
        require_once DIRECTOR_SITE . SLASH . 'models' . SLASH . strtolower($class) . '.php';
    }
        else if (file_exists(DIRECTOR_SITE . SLASH . 'controllers' . SLASH . strtolower($class) . '.php'))
    {
        require_once DIRECTOR_SITE . SLASH . 'controllers'  . SLASH . strtolower($class) . '.php';
    }
        else if (file_exists(DIRECTOR_SITE . SLASH . 'views' . SLASH . strtolower($class) . '.php'))
    {
        require_once DIRECTOR_SITE . SLASH . 'views'  . SLASH . strtolower($class) . '.php';
    }
}
spl_autoload_register('autoload');

function print_rr($arr){
    echo "<pre>";
    print_r($arr);
    echo "</pre>";
}

?>