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
if(isset($_POST['create'])) {
    $name = $_POST['name'];
    $url = $_POST['url'];
    $notification_email = $_POST['notification_email'];
    $tel_number = $_POST['tel_number'];
    $post_number = $_POST['post_number'];
    $prefecture = $_POST['prefecture'];
    $municipalitie = $_POST['municipalitie'];
    $address_number = $_POST['address_number'];
    $category = $_POST['category'];
   // トランザクション開始
    $db->beginTransaction();
    try {
      // $stmt = $db->prepare('insert into agents (agent_name, url, notification_email, tel_number, post_number, prefecture, municipalitie, adress_number, category) values ("a", "b", "c", "d", "e", "f", "g", "h", "i")');
      $stmt = $db->prepare('INSERT INTO agents 
        (
          agent_name, 
          url, 
          notification_email, 
          tel_number, 
          post_number, 
          prefecture, 
          municipalitie, 
          adress_number, 
          category
        ) 
        values 
        (
          :agent_name, 
          :url, 
          :notification_email, 
          :tel_number, 
          :post_number, 
          :prefecture, 
          :municipalitie, 
          :address_number, 
          :category
        )'
      );
  //   $created_at = date("Y-m-d H:i:s");
  //   $updated_at = date("Y-m-d H:i:s");
    $param = array(
      ':agent_name' => $name,
      ':url' => $url,
      ':notification_email' => $notification_email,
      ':tel_number' => $tel_number,
      ':post_number' => $post_number,
      ':prefecture' => $prefecture,
      ':municipalitie' => $municipalitie,
      ':adress_number' => $address_number,
      ':category' => $category
      // ':created_at' => $created_at,
      // ':updated_at' => $updated_at
    );
  // その配列をexecute
    $stmt->execute($param);
    $res = $db->commit();
    }catch(PDOException $e) {
      // 	// エラーが発生した時トランザクションが開始したところまで巻き戻せる
        $db->rollBack();
        echo "エラーが発生しました";
    }
    if ($res){
      ?>
      <script language="javascript" type="text/javascript">
        window.location = './thanks.php';
      </script>
      <?php
      exit;
    }else{
      print('データの追加に失敗しました<br>');
    }
}
  // $stmt->bindValue(':agent_name', $name);
  // $stmt->bindValue(':url', $url);
  // $stmt->bindValue(':notification_email', $notification_email);
  // $stmt->bindValue(':tel_number', $tel_number);
  // $stmt->bindValue(':post_number', $post_number);
  // $stmt->bindValue(':prefecture', $prefecture);
  // $stmt->bindValue(':municipalitie', $municipalitie);
  // $stmt->bindValue(':address_number', $address_number);
  // $stmt->bindValue(':category', $category);
  // $add = $stmt->execute();

// }


?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>新規作成</title>
  <link rel="stylesheet" href="../../css/reset.css">
  <link rel="stylesheet" href="../../css/index.css">
</head>
<body>
  <?php include (dirname(__FILE__) . "/boozer_header.php");?>
  <div class="main">
    <h2 class="pagetitle">エージェンシー掲載情報を登録</h2>
    <p class="announce">※URL、通知先メールアドレス、電話番号は学生画面には表示されません。</p>
    <form action="" method="POST" class="inputform">
      <dl>
        <dd>会社名</dd><dt><input name='name' type="text" required></dt>
        <dd>企業サイトのURL</dd><dt><input name='url' type="text" required></dt>
        <dd>通知先メールアドレス</dd><dt><input name='notification_email' type='email' required></dt>
        <dd>電話番号</dd><dt><input name='tel_number' type='tel' required></dt>
        <dd>郵便番号</dd><dt><input name='post_number' type="text" required></dt>
        <dd>都道府県</dd><dt><input name='prefecture' type="text" required></dt>
        <dd>市区町村</dd><dt><input name='municipalitie' type="text" required></dt>
        <dd>町域・番地</dd><dt><input name='address_number' type="text" required></dt>
        <dd>特異な業種</dd><dt><input name='category' type='text' required></dt>
        <!-- <dd>掲載期間</dd><dt><input name='post_period' type="number"></dt> -->
        <!-- <dd>アイコン画像</dd><dt><input name='image' type="file"></dt> -->
        <!-- <dd>備考</dd><dt><textarea name="" id="" cols="30" rows="10"></textarea></dt> -->
      </dl>
      <div class="pageendbuttons">
        <a href='javascript:history.back()' class="returnbtn endbtn">戻る</a>
        <input class="submitbtn endbtn ignore" type='submit' name='create' value ='新規作成'>
      </div>  
    </form>
  </div>
  <?php include (dirname(__FILE__) . "/boozer_footer.php");?>
</body>
</html>