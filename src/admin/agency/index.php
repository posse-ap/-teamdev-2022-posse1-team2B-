<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>エージェンシー企業メニュー画面</title>
  <link rel="stylesheet" href=".../css/reset.css">
  <link rel="stylesheet" href=”../../css/index.css”>
  <link rel="stylesheet" href="../../css/agency.css">
</head>
<body>
  <?php include(dirname(__FILE__) . "/agency_header.php");?>
  <!-- <div class="main"> -->
    <h2>掲載情報登録</h2>
    <a href="./createcontents.php" class="newaccountbtn">新規作成</a>
    <a href="./fixcontents.php" class="loginbtn">掲載情報修正依頼</a>
    <h2>申し込み済み学生情報</h2>
    <a href="./students.php" class="newaccountbtn">学生情報</a>
  <!-- </div> -->
  <?php include(dirname(__FILE__) . "/agency_footer.php");?>
  <script src="./agency.js"></script>
</body>
</html>