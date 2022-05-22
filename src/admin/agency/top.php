<!-- エージェンシー企業用TOP画面
ログイン、新規作成ボタンがある画面
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
  <link rel="stylesheet" href="../../css/agency.css">
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