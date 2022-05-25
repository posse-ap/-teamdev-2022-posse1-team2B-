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
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>掲載内容新規作成</title>
  <link rel="stylesheet" href="../../css/reset.css">
  <link rel="stylesheet" href="../../css/index.css">
</head>
<body>
  <?php include (dirname(__FILE__) . "/agency_header.php");?>
  <div class="main">
    <h1 class="pagetitle">掲載内容新規作成</h1>
      <div>
        <form action="../../thanks.php" method="POST" class="inputform">
            <div>
                <label for="companyName">会社名<span class="must">必須</span></label>
                <input type="text" name="company_name" id="companyName" required>
            </div>
            <div>
                <label for="companyAddress">会社住所<span class="must">必須</span></label>
                <input type="text" name="company_address" id="companyAddress" required>
            </div>
            <div>
                <label for="companyRemarks">備考</label>
                <input type="text" name="company_remarks" id="companyRemarks">
            </div>
            <div>
                <label for="iconImage" class="uploadicon">アイコン画像を選択</label>
                <input type="file" name="icon_image" id="iconImage" accept="image/*" class="ignore iconimage">
            </div>
            <div class="pageendbuttons">
              <a href="./index.php" class="returnbtn endbtn">戻る</a>
              <!-- 入力した値を受け渡す -->
              <button type="submit" class="submitbtn endbtn">作成完了</button>
            </div>
            <input type="hidden" name="company_name" value="<?php if(isset($_POST["company_name"])){ echo $_POST["company_name"];} ?>">
            <input type="hidden" name="company_address" value="<?php if(isset($_POST["company_address"])){ echo $_POST["company_address"];} ?>">
            <input type="hidden" name="company_remarks" value="<?php if(isset($_POST["company_remarks"])){ echo $_POST["company_remarks"];} ?>">
            <input type="hidden" name="icon_image" value="<?php if(isset($_POST["icon_image"])){ echo $_POST["icon_image"];} ?>">
        </form>
      </div>
    </div>
  <?php include (dirname(__FILE__) . "/agency_footer.php");?>
</body>
<script src="./agency.js"></script>
</html>