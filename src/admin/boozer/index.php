<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>menu</title>
  <link rel="stylesheet" href="../../css/reset.css">
  <link rel="stylesheet" href="../../css/index.css">
  <link rel="stylesheet" href="../../css/agency.css">
</head>
<body>
  <?php include (dirname(__FILE__) . "/boozer_header.php");?>
  <div class="main">
    <h2 class="pagetitle">掲載企業一覧</h2>
    <div class="boozerindexinner">
      <div>
        <div>
          <img src="" alt="">
          <h3>エージェントA</h3>
          <a href="edit.php" class="editbtn">編集</a>
          <button class="deletebtn">削除</button>
        </div>
        <div>
          <img src="" alt="">
          <h3>エージェントB</h3>
          <a href="edit.php" class="editbtn">編集</a>
          <button class="deletebtn">削除</button>
        </div>
        <div>
          <img src="" alt="">
          <h3>エージェントC</h3>
          <a href="edit.php" class="editbtn">編集</a>
          <button class="deletebtn">削除</button>
        </div>
        <a href="./agentslist.php" class="inquirybtn">企業一覧をもっと見る</a>
      </div>
      <div>
        <a href="./payment.php" class="loginbtn">明細確認</a>
        <a href="./students.php" class="inquirybtn">学生情報</a>
      </div>
    </div>
  </div>
  <?php include (dirname(__FILE__) . "/boozer_footer.php");?>
</body>
</html>