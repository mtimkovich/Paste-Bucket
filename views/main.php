<html>
  <head>
    <title>Paste Bucket</title>
    <link rel='stylesheet' href='views/format.css'>
  </head>
  <body>

    <center>

      <h1>Paste Bucket</h1>

      <form method='post'>
        <textarea name='content'></textarea>
        <br>
        <div class='error'><?= $error ?></div>
        <input type='submit'>
      </form>

    </center>
  </body>
</html>
