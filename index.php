<?php
require 'fw.php';
require 'controller.php';
require 'model.php';

class Index extends Controller {
    public function GET() {
        $this->render('main.php');
    }

    public function POST() {
        $paste = $_POST['paste'];

        if (!empty($paste)) {
            echo $paste;
        } else {
            $data['error'] = 'Paste cannot be blank';
            $this->render('main.php', $data);
        }
    }
}

class PasteHandler extends Controller {
    public function GET($params) {
        $content = get_paste($params[0]);

        if ($content) {
            echo $content;
        } else {
            $this->error(404);
        }
    }
}

$urls = array(
    '/' => 'Index',
    '/paste/(.*)' => 'PasteHandler',
);

FW::route($urls);

?>
