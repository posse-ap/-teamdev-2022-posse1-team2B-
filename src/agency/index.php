<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>エージェンシー企業Top画面</title>
</head>
<body>
  <?php include(dirname(__FILE__) . "/agency_header.php");?>
  <h1>掲載情報登録</h1>
  <!-- <button type="button">新規作成</button>
  <button type="button">掲載情報修正依頼</button> -->
  <!-- 新規作成ページに移るだけだから、buttonタグじゃなくてaタグ？ -->
  <a href="./createcontents.php">新規作成</a>
  <a href="./fixcontents.php">掲載情報修正依頼</a>
  <h1>申し込み済み学生情報</h1>
  <a href="./students.php">学生情報</a>
  <?php include(dirname(__FILE__) . "/agency_footer.php");?>
</body>
</html>