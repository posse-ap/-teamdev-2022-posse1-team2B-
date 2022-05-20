<?php
session_start();
require('../../dbconnect.php');
if (isset($_SESSION['user_id']) && $_SESSION['time'] + 60 * 60 * 24 > time()) {
    // SESSIONにuser_idカラムが設定されていて、SESSIONに登録されている時間から1日以内なら
    $_SESSION['time'] = time();
    // SESSIONの時間を現在時刻に更新
} else {
    // そうじゃないならログイン画面に飛んでね
    header('Location: http://' . $_SERVER['HTTP_HOST'] . './agency_login.php');
    exit();
}
// 1日以上間隔が空いた時にログインをさせる仕組み
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>エージェンシー企業メニュー画面</title>
  <link rel="stylesheet" href="./agency.css">
</head>
<body>
  <?php include(dirname(__FILE__) . "/agency_header.php");?>
  <h2>掲載情報登録</h2>
  <a href="./createcontents.php">新規作成</a>
  <a href="./fixcontents.php">掲載情報修正依頼</a>
  <h2>申し込み済み学生情報</h2>
  <a href="./students.php">学生情報</a>
  <?php include(dirname(__FILE__) . "/agency_footer.php");?>
  <script src="./agency.js"></script>
</body>
</html>