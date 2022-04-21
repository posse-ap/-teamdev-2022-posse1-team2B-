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
  // include "agency_header.php" //こっちだとDOCTYPEとかがダブっちゃう＋パスの書き方が不安→dirnameを使う
  // include "agency_header2.php" //読み込みたい内容のみ書く
  include (dirname(__FILE__) . "/agency_header2.php");
  ?>
  <h1>新規登録</h1>
    <!-- 
          この見た目は回すべきか？何を回すべき？ 内容次第。項目をデータベースで登録して出力→回す。 そういうわけじゃないならそのまま書いて良い。
          form 囲うのは一か所 dlタグ。フォーム HTML サンプルで検索
    -->
  <div>
    <form>
        <div>
            <label for="companyName">会社名<span>必須</span></label>
            <input type="text" name="company_name" id="companyName" required>
        </div>
        <div>
            <label for="inquiryMailAddress">お問い合わせ通知先メールアドレス<span>必須</span></label>
            <p>※学生からのお問い合わせの通知先となります</p>
            <!-- pタグここに入れて良いの？ -->
        </div>
        <div>
            <label for="loginMailAddress">ログイン用メールアドレス<span>必須</span></label>
            <input type="email" name="login_mail_address" id="loginMailAddress" required>
        </div>
        <div>
            <label for="loginPassWord">ログイン用パスワード<span>必須</span></label>
            <input type="password" name="login_password" id="loginPassword" required>
        </div>
      <button>会員登録</button>
    </form>
  </div>
  <?php  
  // include "agency_footer.php"
  ?>
</body>
</html>