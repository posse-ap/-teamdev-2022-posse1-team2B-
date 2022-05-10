  <!-- 
    ・入力画面→確認画面の遷移
    →https://gray-code.com/php/make-the-form-vol2/
  -->
<?php
require(dirname(__FILE__, 3) . '/dbconnect.php');
  //変数の初期化
  // 入力画面や確認画面の表示をスイッチするフラグ
  // 0→入力画面 1→確認画面
  $page_flag = 0;
  // もし会員登録ボタンがおされたら＝フォームデータの中に$_POST[""membership registration"]が含まれていたら→page_flag変数の値を1にする＝確認画面に表示を変える
  if(isset($_POST["membership_registration"])) {
    $page_flag = 1;
  }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>エージェンシー企業アカウント登録画面</title>
  <link rel="stylesheet" href="agency.css">
</head>
<body>
  <?php include (dirname(__FILE__) . "/agency_header.php"); 
  if ($page_flag === 1):
  ?>
  <!--確認画面 -->
  <div>
    <h1>登録内容確認</h1>
    <form method="POST" action="../../thanks.php">
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
  <?php else: ?>
  <!-- 入力画面 -->
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
        <button type="submit" name="membership_registration">会員登録</button>
        <!-- <input type="submit" name="membership_registration" value ="会員登録"/> -->
      </form>
    </div>
  </div>
  <?php endif; ?>
  <?php include (dirname(__FILE__) . "/agency_footer.php");?>
  <script src="./agency.js"></script>
</body>
</html>