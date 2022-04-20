<?php
require('../dbconnect.php');
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>エージェンシー企業アカウント登録画面</title>
</head>
<body>
  <?php 
  include "agency_header.php"
  ?>
  <h1>新規登録</h1>
  <div>
    <div>
      <p>会社名</p>
      <div>必須</div>
      <form>
        <label>
          <input type="text" name="company_name" required>
        </label>
      </form>
    </div>
    <div>
      <p>お問い合わせ通知先メールアドレス</p>
      <div>必須</div>
      <p>※学生からのお問い合わせの通知先となります</p>
      <form>
        <label>
          <input type="email" name="inquiry_mail_address" required>
        </label>
      </form>
    </div>
    <div>
      <p>ログイン用メールアドレス</p>
      <div>必須</div>
      <form>
        <label>
          <input type="email" name="login_mail_address" required>
        </label>
      </form>
    </div>
    <div>
      <p>ログイン用パスワード</p>
      <div>必須</div>
      <form>
        <label>
          <input type="password" name="login_password" required>
        </label>
      </form>
    </div>
  </div>
  <button>会員登録</button>
</body>
</html>