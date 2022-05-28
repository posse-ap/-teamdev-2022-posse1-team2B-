<?php
session_start();
require('../../dbconnect.php');
if (isset($_SESSION['user_id']) && $_SESSION['time'] + 60 * 60 * 24 > time()) {
  // SESSIONにuser_idカラムが設定されていて、SESSIONに登録されている時間から1日以内なら
  $_SESSION['time'] = time();
  // SESSIONの時間を現在時刻に更新
} else {
  // そうじゃないならログイン画面に飛んでね
  header('Location: http://' . $_SERVER['HTTP_HOST'] . '../login.php');
  exit();
} ?>

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
  <link rel="stylesheet" href="../../css/reset.css">
  <link rel="stylesheet" href="../../css/index.css">
</head>

<body>
  <?php include(dirname(__FILE__) . "/agency_header.php"); ?>
  <div class="main">
    <h1 class="pagetitle">掲載内容修正申し込み</h1>
    <form action="../../thanks.php" method="POST" class="inputform">
      <div>
        <label for="companyName">会社名</label>
        <input type="text" id="companyName">
      </div>
      <div>
        <label for="companyAddress">会社公式ホームページURL</label>
        <input type="text" id="companyAddress">
      </div>
      <div>
        <label for="companyPostnumber">電話番号</label>
        <input type="text" id="companyTelnumber">
      </div>
      <div>
        <label for="companyRemarks">郵便番号</label>
        <input type="text" name="company_remarks" id="companyRemarks">
      </div>
      <div>
        <label for="companyAddress">都道府県</label>
        <input type="text" id="companyAddress">
      </div>
      <div>
        <label for="companyRemarks">市区町村</label>
        <input type="text" name="company_remarks" id="companyRemarks">
      </div>
      <div>
        <label for="companyRemarks">番地以降</label>
        <input type="text" name="company_remarks" id="companyRemarks">
      </div>
      <div>
        <label for="companyRemarks">備考</label>
        <input type="text" name="company_remarks" id="companyRemarks">
      </div>
      <div>
        <label for="companyRemarks">通知用メールアドレス（掲載されない情報です）</label>
        <input type="text" name="company_remarks" id="companyRemarks">
      </div>
      <div>
        <label for="companyImage">アイコン画像</label>
        <input type="text" id="companyimage">
      </div>
      <button name="fix" type="submit" class="submitbtn" onclick="
              <?php
              $from = 'boozer@craft.com';
              $to   = 'test@posse-ap.com';
              $subject = 'Modification request from a agency';
              $body = 'please check information from here';

              $ret = mb_send_mail($to, $subject, $body, "From: {$from} \r\n");
              var_dump($ret);
              ?>
              ">修正を申し込む</button>
    </form>
  </div>
  <?php include(dirname(__FILE__) . "/agency_footer.php"); ?>
  <script src="agency.js"></script>
</body>

</html>