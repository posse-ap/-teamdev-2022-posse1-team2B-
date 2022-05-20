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
</head>
<body>
  <?php include (dirname(__FILE__) . "/agency_header.php");?>
  <h1>掲載内容新規作成</h1>
    <div>
      <form>
          <div>
              <label for="companyName">会社名<span>必須</span></label>
              <input type="text" name="company_name" id="companyName" required>
          </div>
          <div>
              <label for="companyAddress">会社社員<span>必須</span></label>
              <input type="text" name="company_address" id="companyAddress" required>
          </div>
          <div>
              <label for="companyRemarks">備考</label>
              <input type="text" name="company_remarks" id="companyRemarks" required>
          </div>
          <div>
              <label for="iconImage">アイコン画像</label>
              <input type="file" name="icon_image" id="iconImage"  accept="image/*" required>
          </div>
          <button type="submit">作成完了</button>
      </form>
    </div>
    <?php include (dirname(__FILE__) . "/agency_footer.php");?>
</body>
</html>