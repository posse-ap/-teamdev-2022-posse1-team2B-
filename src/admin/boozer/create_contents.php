<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>edit</title>
  <link rel="stylesheet" href="../../css/reset.css">
  <link rel="stylesheet" href="../../css/index.css">
</head>
<body>
<?php include (dirname(__FILE__) . "/boozer_header.php");?>
  <div class="main">
    <h2 class="pagetitle">掲載内容修正</h2>
    <form action="../thanks.php" method="POST">
      <dd>会社名</dd><dt><input type="text"></dt>
      <dd>郵便番号</dd><dt><input type="text"></dt>
      <dd>住所</dd><dt><input type="text"></dt>
      <dd>掲載期間</dd><dt><input type="number"></dt>
      <dd>アイコン画像</dd><dt><input type="file"></dt>
      <dd>備考</dd><dt><textarea name="" id="" cols="30" rows="10"></textarea></dt>
      <button class="submitbtn" type="submit" name="new_entry">新規作成</button>
    </form>
</div>
<?php include (dirname(__FILE__) . "/boozer_footer.php");?>
</body>
</html>