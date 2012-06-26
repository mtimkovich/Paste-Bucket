<?php

class FW {
    public function route ($urls) {
        $method = $_SERVER['REQUEST_METHOD'];

        $PATH = $_SERVER['REQUEST_URI'];

        $BASE_PATH = dirname($_SERVER['SCRIPT_NAME']);
        $PATH = str_replace($BASE_PATH, '', $PATH);

        $found = false;

        foreach ($urls as $regex => $class) {
            $regex = str_replace('/', '\/', $regex);
            $regex = '^' . $regex . '\/?$';

            if (preg_match("/$regex/i", $PATH, $matches)) {
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
