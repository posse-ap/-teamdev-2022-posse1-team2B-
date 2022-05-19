<!-- 
・「登録開始」ってなに？
-->
<?php
require('../../dbconnect.php');
$stmt = $db->prepare('SELECT * FROM agents');
$stmt->execute();
$agents = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>menu</title>
  <link rel="stylesheet" href="boozer.css">
</head>
<body>
  <?php include (dirname(__FILE__) . "/boozer_header.php");?>
  <h2>掲載企業一覧</h2>
  <?php foreach($agents as $agent): ?>
  <div>
    <form action="delete.php" method="POST">
      <img src="" alt="">
      <h3><?php echo $agent['agent_name']; ?></h3>
      <a href="edit.php?id=<?php echo$agent['id']; ?>">編集</a>
      <!-- <a href="edit.php?id=1">編集</a> -->
      <input type="hidden" name="agent_id" value="<?php echo $agent['id'];?>">
      <input type="submit" name="delete" value="エージェンシ―企業の掲載を削除">
      <!-- この削除は、データベースから削除って意味？それとも単に掲載を削除？ -->
    </form>
  </div>
  <?php endforeach;?>
  <a href="./agentslist.php">企業一覧をもっと見る</a>
  <a href="./payment.php">明細確認</a>
  <a href="./students.php">学生情報</a>
  <?php include (dirname(__FILE__) . "/boozer_footer.php");?>
  <script src="boozer.js"></script>
</body>
</html>