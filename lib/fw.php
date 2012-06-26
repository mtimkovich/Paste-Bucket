<?php
require './lib/constants.php';
require './lib/controller.php';
require './lib/model.php';

class FW {
    public function route ($urls) {
        $method = $_SERVER['REQUEST_METHOD'];

        $found = false;

        foreach ($urls as $regex => $class) {
            $regex = str_replace('/', '\/', $regex);
            $regex = '^' . $regex . '\/?$';

            if (preg_match("/$regex/i", $GLOBALS['PATH'], $matches)) {
                array_shift($matches);

                $found = true;

                if (class_exists($class)) {
                    $obj = new $class;

                    if (method_exists($obj, $method)) {
                        $obj->$method($matches);
                    } else {
                        throw new BadMethodCallException("Method, $method, not supported");
                    }
                } else {
                    throw new Exception("Class, $class, not found.");
                }
                break;
            }
        }

        if (!$found) { 
            throw new Exception("URL, $PATH, not found.");
        }
    }
}

?>
