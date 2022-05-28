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
}

if(isset($_POST['edit'])){
    $id = $_POST['agent_id'];
    // トランザクション開始
    $db->beginTransaction();
    try {
      $new_agent_name = $_POST["new_agent_name"];
      $new_post_number = $_POST["new_post_number"];
      $new_prefecture = $_POST["new_prefecture"];
      $new_municipalitie = $_POST["new_municipalitie"];
      $new_address_number = $_POST["new_address_number"];
      $stmt = $db->prepare('UPDATE agents SET agent_name = :new_agent_name, post_number = :new_post_number, prefecture = :new_prefecture, municipalitie = :new_municipalitie, adress_number = :new_address_number WHERE id = :id');
      // $stmt = $db->prepare('UPDATE agents SET agent_name = :new_agent_name WHERE id = 1');
      $stmt->bindValue(':id', $id);
      $stmt->bindParam(':new_agent_name', $new_agent_name);
      $stmt->bindParam(':new_post_number', $new_post_number);
      $stmt->bindParam(':new_prefecture', $new_prefecture);
      $stmt->bindParam(':new_municipalitie', $new_municipalitie);
      $stmt->bindParam(':new_address_number', $new_address_number);
      $stmt->execute();
      $res = $db->commit();
      } catch(PDOException $e) {
    // 	// エラーが発生した時トランザクションが開始したところまで巻き戻せる
      $db->rollBack();
      // echo "エラーが発生しました";
    }
      // 更新に成功したらサンクスページへ遷移する
    if( $res ) {
    ?>
        <script language="javascript" type="text/javascript">
          window.location = '../../thanks.php?edit';
        </script>
        <?php
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>edit</title>
  <link rel="stylesheet" href="../../css/reset.css">
  <link rel="stylesheet" href="../../css/index.css">
</head>
<body>
  <?php include (dirname(__FILE__) . "/boozer_header.php");?>
  <div class="main">
    <h2 class="pagetitle">掲載内容修正</h2>
    <form action="" method="POST" class="inputform">
      <dd>会社名</dd><dt><input type="text" name="new_agent_name"></dt>
      <dd>企業サイトのURL</dd><dt><input type="text" name='new_url' required></dt>
      <dd>電話番号</dd><dt><input name='new_tel_number' type='tel' required></dt>
      <dd>郵便番号</dd><dt><input type="text" name="new_post_number" pattern="\d{3}-?\d{4}"></dt>
      <dd>都道府県</dd><dt><input type="text" name="new_prefecture"></dt>
      <dd>市区町村</dd><dt><input type="text" name="new_municipalitie"></dt>
      <dd>町域・番地</dd><dt><input type="text" name="new_address_number"></dt>
      <dd>通知先メールアドレス</dd><dt><input name='new-notification_email' type='email' required></dt>
      <dd>得意な業種</dd><dt><input name='new_category' type='text' required></dt>
      <!-- <dd>掲載期間</dd><dt><input type="number" name=""></dt>
            掲載期間、アイコン画像、備考→agentsテーブルに入ってないけど、どうする？-->
      <!-- <dd>アイコン画像</dd><dt><input type="file" name="new_image"></dt> -->
      <dd>備考</dd><dt><textarea name="new_remarks" id="" cols="30" rows="10"></textarea></dt>
      <input type="hidden" name="agent_id" value= "<?php echo $_POST['agent_id']; ?>">
      <input class="submitbtn ignore" name="edit" type="submit" value="修正完了">
      <a href='javascript:history.back()' class="returnbtn">戻る</a>
    </form>
  </div>
  <?php include (dirname(__FILE__) . "/boozer_footer.php");?>
</body>
</html>

