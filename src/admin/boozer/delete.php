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
if(isset($_POST['delete'])){
  $agent_id = $_POST['agent_id'];
  $stmt = $db->prepare('SELECT * FROM agents WHERE id = :id');
  $stmt->bindValue(':id', $agent_id);
  $stmt->execute();
  $agency = $stmt->fetchAll();
}


if(isset($_POST['agency_delete'])){
// トランザクション開始
$db->beginTransaction();
try {
  $id = $_POST['id'];
  $stmt = $db->prepare('DELETE FROM agents WHERE id = :id');
  $stmt->bindValue(':id', $id);
  $stmt->execute();
  $res = $db->commit();
  } catch(PDOException $e) {
// 	// エラーが発生した時トランザクションが開始したところまで巻き戻せる
  $db->rollBack();
	echo "エラーが発生しました";
}
  // 更新に成功したらサンクスページへ遷移する
  if( $res ) {
    ?>
      <script language="javascript" type="text/javascript">
        window.location = './thanks.php';
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
  <title>エージェンシー企業の掲載を削除する</title>
  <link rel="stylesheet" href="../../css/reset.css">
  <link rel="stylesheet" href="../../css/index.css">
</head>
<body>
  <?php include (dirname(__FILE__) . "/boozer_header.php");?>
  <div?>
    <div class="main">
      <p class="pagetitle">本当にエージェンシー企業の掲載を削除しますか？</p>
      <div class="tableouter">
        <div class="table">
          <dd>会社名</dd><dt><?php echo $agency[0]['agent_name']; ?></dt>
          <dd>会社住所</dd><dt><?php echo $agency[0]['prefecture']; echo $agency[0]['municipalitie']; echo $agency[0]['adress_number'];?></dt>
          <dd>備考</dd><dt></dt>
        </div>  
      </div>
      <form action="delete.php" method="post">
        <input type="hidden" name="id" value="<?php echo$agency[0]['id'];?>">
        <button type="submit" name="agency_delete" class="deletebtn">掲載を削除</button>
        <a href='javascript:history.back()' class="returnbtn">戻る</a>
      </form>
    </div>
  </div>
  <?php include (dirname(__FILE__) . "/boozer_footer.php");?>
  <script src="boozer.js"></script>
</body>
</html>