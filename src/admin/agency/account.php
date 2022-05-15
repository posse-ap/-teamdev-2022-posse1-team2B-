
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>エージェンシー企業アカウント登録画面</title>
</head>
<body>
  <?php include (dirname(__FILE__) . "/agency_header.php");?>
  <!--確認画面 -->
  <div>
    <h1>登録内容確認</h1>
    <form action="../../thanks.php" method="POST">
      <div>
        <label>会社名</label>
        <p><?php echo $_POST["company_name"];?></p>
      </div>
      <div>
        <label>お問い合わせ通知先メールアドレス</label>
        <p><?php echo $_POST["inquiry_mail_address"];?></p>
      </div>
      <div>
        <label>ログイン用メールアドレス</label>
        <p><?php echo $_POST["login_mail_address"];?></p>
      </div>
      <div>
        <label>ログイン用パスワード</label>
        <p><?php echo $_POST["login_password"];?></p>
      </div>
      <!-- 入力した値を受け渡す -->
      <button type="submit" name="btn_back" formaction="./account.php">戻る</button>
      <button type="submit" name="btn_submit">登録完了</button>
      <input type="hidden" name="company_name" value="<?php echo $_POST['company_name']; ?>">
      <input type="hidden" name="inquiry_mail_address" value="<?php echo $_POST['inquiry_mail_address']; ?>">
      <input type="hidden" name="login_mail_address" value="<?php echo $_POST['login_mail_address']; ?>">
      <input type="hidden" name="login_password" value="<?php echo $_POST['login_password']; ?>">
    </form>
  </div>
  <div>
    <h1>新規登録</h1>
    <div>
      <form action="" method="POST">
          <div>
              <label for="companyName">会社名<span>必須</span></label>
              <input type="text" name="company_name" id="companyName" value="<?php if(isset($_POST["company_name"])){echo $_POST["company_name"];}?>" required>
          </div>
          <div>
              <label for="inquiryMailAddress">お問い合わせ通知先メールアドレス<span>必須</span></label>
              <p>※学生からのお問い合わせの通知先となります</p>
              <input type="email" name="inquiry_mail_address" id="inquiryMailAddress" value="<?php if(isset($_POST["inquiry_mail_address"])){echo $_POST["inquiry_mail_address"];}?>" required>
          </div>
          <div>
              <label for="loginMailAddress">ログイン用メールアドレス<span>必須</span></label>
              <input type="email" name="login_mail_address" id="loginMailAddress" value="<?php if(isset($_POST["login_mail_address"])){echo $_POST["login_mail_address"];}?>" required>
          </div>
          <div>
              <label for="loginPassWord">ログイン用パスワード<span>必須</span></label>
              <input type="password" name="login_password" id="loginPassword" value="<?php if(isset($_POST["login_password"])){echo $_POST["login_password"];}?>" required>
          </div>
        <button type="submit" name="btn_confirm">会員登録</button>
      </form>
    </div>
  </div>
  <?php include (dirname(__FILE__) . "/agency_footer.php");?>
</body>
</html>