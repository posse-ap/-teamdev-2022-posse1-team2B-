<?php 
session_start();
require('../dbconnect.php');
if (isset($_SESSION['user_id']) && $_SESSION['time'] + 60 * 60 * 24 > time()) {
    // SESSIONにuser_idカラムが設定されていて、SESSIONに登録されている時間から1日以内なら
    $_SESSION['time'] = time();
    // SESSIONの時間を現在時刻に更新
} else {
    // そうじゃないならログイン画面に飛んでね
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '../login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../../css/reset.css">
  <link rel="stylesheet" href="../../css/index.css">
</head>
<body>
<?php include (dirname(__FILE__) . "/agency_header.php");?>
<div class="main">
  <div>
    <h1 class="pagetitle">エージェンシー企業向けログイン画面</h1>
  </div>
  <div class="topbuttons">
    <a href="./account.php" class="newaccountbtn">新規会員登録</a>
    <a href="./login.php" class="loginbtn">ログイン</a>
  </div>
</div>
<?php include (dirname(__FILE__) . "/agency_footer.php");?>
<script src="agency.js"></script>
</body>
</html>