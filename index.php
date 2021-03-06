<?php
require 'lib/fw.php';

function get_paste($name) {
  $db = new Database();

  if (apc_exists($name)) {
    $row = apc_fetch($name);
  } else {
    $row = $db->query('SELECT content FROM pastes WHERE name = :name LIMIT 1',
      array(':name' => $name));
    error_log('DB QUERY');
    apc_store($name, $row);
  }
  return $row;
}

class Index extends Controller {
  public function GET() {
    $this->render('main.php');
  }

  public function POST() {
    $content = $_POST['content'];

    # Check to make sure paste isn't empty or consist of whitespace
    if (!empty($content) AND !ctype_space($content)) {
      $db = new Database();

      # Insert content
      $db->query('INSERT INTO pastes (name, content) VALUES (NULL, :content)',
        array(':content' => $content));

      # Set the name value to be the MD5 hash of the id field
      $db->query('UPDATE pastes SET name = SUBSTR(MD5(id), 1, 6) WHERE id = LAST_INSERT_ID()');

      $rows = $db->query('SELECT name FROM pastes WHERE id = LAST_INSERT_ID()');

      $name = $rows[0]['name'];

      # Redirect to the paste
      $this->redirect("/paste/$name");
    } else {
      $data['error'] = 'Paste cannot be blank';
      $this->render('main.php', $data);
    }
  }
}

class PasteHandler extends Controller {
  public function GET($name) {
    $rows = get_paste($name);

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
  '/paste/(.*)' => 'PasteHandler',
);

FW::route($urls);

?>
