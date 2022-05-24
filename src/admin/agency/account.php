
<?php
require('../../dbconnect.php');

if (isset(
  // これらが入力されていたら
  $_POST['agent_name'],
  $_POST['manager_last_name'],
  $_POST['manager_first_name'],
  $_POST['manager_last_name_kana'],
  $_POST['manager_first_name_kana'],
  $_POST['agent_department'],
  $_POST['login_email'],
  $_POST['password']
)) {
  // ログイン情報の登録
  // echo $_POST['password'];
  $user_stmt = $db->prepare(
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

  $login_email = $_POST['login_email'];
  $password = $_POST['password'];

  $param = array(
    ':login_email' => $login_email,
    ':password' => sha1($password)
  );
  
  $user_stmt->execute($param);

  // その他の情報の登録
  $manager_stmt = $db->prepare(
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

  $agent_id_parameter = $_POST['agent_name'];
  // エージェント名を取得
  // echo $agent_id_parameter;
  // 取得できた
  $agent_id_stmt = $db->prepare('SELECT id FROM agents where agent_name = :agent_id_parameter');
  // agentsテーブルからIDをとりたい
  $agent_id_stmt->bindValue(':agent_id_parameter', $agent_id_parameter);
  // 条件は、登録されている名前と、取得したエージェント名が等しいこと
  $agent_id_stmt->execute();
  // 実行
  $agent_id = $agent_id_stmt->fetchAll();
  // 持ってきたものをエージェントIDという名前にする

  echo $agent_id[0]['id'];

  
  $user_id_stmt = $db->prepare('SELECT id FROM users where login_email = :login_email');
  $user_id_stmt->bindValue(':login_email', $login_email);
  $user_id_stmt->execute();
  $user_id = $user_id_stmt->fetchAll();
  echo $user_id[0]['id'];

  $manager_last_name = $_POST['manager_last_name'];
  $manager_first_name = $_POST['manager_first_name'];
  $manager_last_name_kana = $_POST['manager_last_name_kana'];
  $manager_first_name_kana = $_POST['manager_first_name_kana'];
  $agent_department = $_POST['agent_department'];



  $parameter = array(
    ':agent_id' => $agent_id[0]['id'],
    ':user_id' => $user_id[0]['id'],
    ':manager_last_name' => $manager_last_name,
    ':manager_first_name' => $manager_first_name,
    ':manager_last_name_kana' => $manager_last_name_kana,
    ':manager_first_name_kana' => $manager_first_name_kana,
    ':agent_department' => $agent_department
  );

  $manager_stmt->execute($parameter);
//   echo $manager_last_name;
}

// データを削除して再起動すると、登録したデータが消えてしまう



?>
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
  <link rel="stylesheet" href="../../css/reset.css">
  <link rel="stylesheet" href="../../css/index.css">
</head>

<body>
  <?php include(dirname(__FILE__) . "/agency_header.php"); ?>
  <div class="main">
    <h1 class="pagetitle">新規登録</h1>
    <div>
      <form action="account.php" method="POST" class="inputform">
        <div>
          <label for="companyName">会社名</label><br>
          <input type="text" name="agent_name" id="companyName" required>
        </div>
        <div class="half">
          <div>
            <label for="familyName">氏</label><br>
            <input type="text" name="manager_last_name" id="familyName" required>
          </div>
          <div>
            <label for="managerName">名</label><br>
            <input type="text" name="manager_first_name" id="managerName" required>
          </div>
        </div>
        <div class="half">
          <div>
            <label for="familyNameKana">氏（カナ）</label><br>
            <input type="text" name="manager_last_name_kana" id="familyNameKana" pattern="(?=.*?[\u30A1-\u30FA])[\u30A1-\u30FC]*" required>
          </div>
          <div>
            <label for="managerNameKana">名（カナ）</label><br>
            <input type="text" name="manager_first_name_kana" id="managerNameKana" pattern="(?=.*?[\u30A1-\u30FA])[\u30A1-\u30FC]*" required>
          </div>
        </div>
        <div>
          <label for="agent_department">部署</label><br>
          <input type="text" name="agent_department" id="agentDepartment" required>
        </div>
        <div>
          <label for="loginMailAddress">ログイン用メールアドレス<span class="must">必須</span></label><br>
          <input type="email" name="login_email" id="loginMailAddress" required>
        </div>
        <div>
          <label for="loginPassWord">ログイン用パスワード<span class="must">必須</span></label><br>
          <input type="password" name="password" id="loginPassword" required>
        </div>
        <div class="submitbtn">
          <input type="submit" name="btn_confirm" class="ignore submitbtn" style="display:none">会員登録</input>
        </div>
      </form>
    </div>
  </div>
  <!-- <?php include(dirname(__FILE__) . "/agency_footer.php"); ?> -->
</body>

</html>