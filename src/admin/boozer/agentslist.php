<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>agentslist</title>
</head>
<body>
  <h2>掲載企業一覧</h2>
  <?php foreach ($hoges as $hoge) : ?>
  <div>
    <img src="" alt="">
    <h3>エージェントA</h3>
    <a href="edit.php">編集</a>
    <button>削除</button>
  </div>
  <?php endforeach; ?>
</body>
</html>