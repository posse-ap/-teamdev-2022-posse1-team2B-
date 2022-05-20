<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>menu</title>
</head>
<body>
  <?php include (dirname(__FILE__) . "/boozer_header.php");?>
  <h2>掲載企業一覧</h2>
  <div>
    <img src="" alt="">
    <h3>エージェントA</h3>
    <a href="edit.php">編集</a>
    <button>削除</button>
  </div>
  <div>
    <img src="" alt="">
    <h3>エージェントB</h3>
    <a href="edit.php">編集</a>
    <button>削除</button>
  </div>
  <div>
    <img src="" alt="">
    <h3>エージェントC</h3>
    <a href="edit.php">編集</a>
    <button>削除</button>
  </div>
  <a href="./agentslist.php">企業一覧をもっと見る</a>

  <a href="./payment.php">明細確認</a>
  <a href="./students.php">学生情報</a>
  <?php include (dirname(__FILE__) . "/boozer_footer.php");?>
</body>
</html>