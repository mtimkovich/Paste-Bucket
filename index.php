<?php
require 'fw.php';
require 'controller.php';
require 'model.php';

class Index extends Controller {
    public function GET() {
        $this->render('main.php');
    }

    public function POST() {
        $content = $_POST['content'];

        if (!empty($content) AND !ctype_space($content)) {
            $db = new Database();

            $db->query('INSERT INTO pastes (name, content) VALUES (NULL, :content)',
                array(':content' => $content));
            $db->query('UPDATE pastes SET name = SUBSTR(MD5(id), 1, 6) WHERE id = LAST_INSERT_ID()');

            $rows = $db->query('SELECT name FROM pastes ORDER BY id DESC LIMIT 1');

            $name = $rows[0]['name'];

            $this->redirect("/paste/$name");
        } else {
            $data['error'] = 'Paste cannot be blank';
            $this->render('main.php', $data);
        }
    }
}

class PasteHandler extends Controller {
    public function GET($params) {
        $db = new Database();

        $rows = $db->query('SELECT content FROM pastes WHERE name = :name',
            array(':name' => $params[0]));

        $content = $rows[0]['content'];

        if ($content) {
            header('Content-Type: text/plain');

            echo $content;
        } else {
            $this->error(404);
        }
    }
}

$urls = array(
    '/' => 'Index',
    '/paste' => 'Index',
    '/paste/(.*)' => 'PasteHandler',
);

FW::route($urls);

?>
