<?php
require('../../dbconnect.php');
if(isset($_POST['delete'])){
  $agent_id = $_POST['agent_id'];
  $stmt = $db->prepare('SELECT * FROM agents WHERE id = :id');
  $stmt->bindValue(':id', $agent_id);
  $stmt->execute();
  $agency = $stmt->fetchAll();
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>エージェンシー企業の掲載を削除する</title>
  <link rel="stylesheet" href="boozer.css">
</head>
<body>
  <?php include (dirname(__FILE__) . "/boozer_header.php");?>
  <div?>
    <p>本当にエージェンシー企業の掲載を削除しますか？</p>
    <dd>会社名</dd><dt><?php echo $agency[0]['agent_name']; ?></dt>
    <dd>会社住所</dd><dt><?php echo $agency[0]['prefecture']; echo $agency[0]['municipalitie']; echo $agency[0]['adress_number'];?></dt>
    <dd>備考</dd><dt></dt>
    <form action="./thanks.php" method="post">
      <input type="hidden" value="<?php echo$agency[0]['id'];?>">
      <button type="submit">掲載を削除</button>
      <a href='javascript:history.back()'>戻る</a>
    </form>
  </div>
  <?php include (dirname(__FILE__) . "/boozer_footer.php");?>
  <script src="boozer.js"></script>
</body>
</html>