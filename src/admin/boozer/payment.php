<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <?php foreach ($hoges as $hoge) : ?>
  <div>
    <h3>エージェントA</h3>
    <a href="./payment_detail.php">詳細</a>
    <span>未払い</span>
  </div>
  <?php endforeach; ?>
</body>
</html>