<?php 
session_start();
require('../dbconnect.php');
if (isset($_SESSION['user_id']) && $_SESSION['time'] + 60 * 60 * 24 > time()) {
    // SESSIONにuser_idカラムが設定されていて、SESSIONに登録されている時間から1日以内なら
    $_SESSION['time'] = time();
    // SESSIONの時間を現在時刻に更新
} else {
    // そうじゃないならログイン画面に飛んでね
    header('Location: http://' . $_SERVER['HTTP_HOST'] . 'agency_login.php');
    exit();
}?>

<!-- 掲載修正依頼画面
・会社名
・ 会社住所
・アイコン画像
・備考
・修正を申し込む画面
-->
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="agency.css">
</head>
<body>
  <?php include (dirname(__FILE__) . "/agency_header.php");?>
  <h1>掲載内容修正申し込み</h1>
  <form action="../../thanks.php" method="POST">
    <div>
      <label for="companyName">会社名</label>
      <input type="text" id="companyName">
    </div>
    <div>
      <label for="companyAddress">会社住所</label>
      <input type="text" id="companyAddress">
    </div>
    <div>
      <label for="companyRemarks">備考</label>
      <input type="text" name="company_remarks" id="companyRemarks">
    </div>
    <div>
      <label for="companyImage">アイコン画像</label>
      <input type="text" id="companyimage">
    </div>
    <button type="submit">修正を申し込む</button>
  </form>
  <?php include (dirname(__FILE__) . "/agency_footer.php");?>
  <script src="agency.js"></script>
</body>
</html>