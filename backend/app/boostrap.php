<?php
// load config
require_once 'config/config.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Origin,Access-Control-Allow-Methods,Access-Control-Allow-Methods,Authorization ,X-Requested-With');

require_once 'helpers/SESSION_helpers.php';
require_once 'helpers/url_helper.php';
// autoload core libraries
spl_autoload_register(function ($className) {
    require_once 'libraries/' . $className . '.php';
});
