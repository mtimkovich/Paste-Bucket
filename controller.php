<?php

class Controller {
    public function render($file, $vars = array()) {
        extract($vars);

        include "./views/$file";

        exit();
    }

    public function redirect($loc) {
        $BASE_PATH = dirname($_SERVER['SCRIPT_NAME']);

        header("Location: $BASE_PATH$loc");
    }

    public function error($number) {
        switch ($number) {
        case 404:
            header('HTTP/1.1 404 Not Found');
            break;
        }
    }
}

?>
