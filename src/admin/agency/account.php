<?php
require('../dbconnect.php');

if(isset(
  // これらが入力されていたら
  $_POST['agency_name'], 
  $_POST['manager_last_name'], 
  $_POST['manager_first_name'], 
  $_POST['manager_last_name_kana'], 
  $_POST['manager_first_name_kana'], 
  $_POST['agent_department'], 
  $_POST['login_email'], 
  $_POST['password']
  )) {

  // ログイン情報の登録
  $stmt = $db->prepare(
    'insert into users
    (
      login_email,
      password
    )
    values
    (
      :login_email,
      :password
    )'
    );

  $login_email = $POST_['login_email'];
  $password = $POST_['password'];

  $param = array(
    ':login_email'=>$login_email,
    ':password'=>$password
  );

  $stmt->execute($param);



  // その他の情報の登録
  $stmt = $db->prepare(
    'insert into managers
    (
      agent_id,
      user_id,
      manager_last_name,
      manager_first_name,
      manager_last_name_kana,
      manager_first_name_kana,
      agent_department
    )
    values
    (
      :agent_id,
      :user_id,
      :manager_last_name,
      :manager_first_name,
      :manager_last_name_kana,
      :manager_first_name_kana,
      :agent_department
    )'
    );
  
  // $agent_id = agentsテーブルのIDを取得。条件は、ポストされたagent_nameと、agent_nameカラムのレコードが等しい
  // $user_id = userテーブルのIDを取得。条件は、ポストされたlogin_emailとlogin_emailカラムのレコードが等しい
  $manager_last_name = $_POST['manager_last_name'];
  $manager_first_name = $_POST['manager_first_name'];
  $manager_last_name_kana = $_POST['manager_last_name'];
  $manager_first_name_kana = $_POST['manager_first_name'];
  $agent_department = $_POST['agent_department'];


  }


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
  <!-- <?php include(dirname(__FILE__) . "/agency_header.php"); ?> -->

  <div>
    <h1>新規登録</h1>
    <div>
      <form action="" method="POST">
        <div>
          <label for="companyName">会社名<span>必須</span></label>
          <input type="text" name="agency_name" id="companyName" required>
        </div>
        <div>
          <label for="familyName">氏</label>
          <input type="text" name="manager_last_name" id="familyName" required>
        </div>
        <div>
          <label for="managerName">名</label>
          <input type="text" name="manager_first_name" id="managerName" required>
        </div>
        <div>
          <label for="familyNameKana">氏(カナルビ)</label>
          <input type="text" name="manager_first_name_kana" id="familyNameKana" pattern="(?=.*?[\u30A1-\u30FA])[\u30A1-\u30FC]*" required>
        </div>
        <div>
          <label for="managerNameKana">名(カナルビ)</label>
          <input type="text" name="manager_last_name_kana" id="managerNameKana" pattern="(?=.*?[\u30A1-\u30FA])[\u30A1-\u30FC]*" required>
        </div>
        <div>
          <label for="agent_department">部署</label>
          <input type="text" name="agent_department" id="agentDepartment" required>
        </div>
        <div>
          <label for="loginMailAddress">ログイン用メールアドレス<span>必須</span></label>
          <input type="email" name="login_mail" id="loginMailAddress" required>
        </div>
        <div>
          <label for="loginPassWord">ログイン用パスワード<span>必須</span></label>
          <input type="password" name="password" id="loginPassword" required>
        </div>
        <input type="submit" name="btn_confirm">会員登録</input>
      </form>
    </div>
  </div>
  <!-- <?php include(dirname(__FILE__) . "/agency_footer.php"); ?> -->
</body>

</html>