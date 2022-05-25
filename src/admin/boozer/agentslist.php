<?php
require("../../dbconnect.php");
$stmt = $db->prepare('select * from agents');
$stmt->execute();
$agents = $stmt->fetchAll();
$page_flag = 0;
if(isset($_GET['agent_id'])){
  $page_flag = 1;
  $id = $_GET['agent_id'];
  $stmt = $db->prepare('SELECT * FROM agents WHERE id = :agent_id');
  $stmt->bindValue(':agent_id', $id);
  $stmt->execute();
  $agency = $stmt->fetchAll();
  $stmt = $db->prepare('SELECT * FROM managers WHERE agent_id = :agent_id');
  $stmt->bindValue(':agent_id', $id);
  $stmt->execute();
  $managers = $stmt->fetchAll();

  
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>agentslist</title>
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <link rel="stylesheet" href="../../css/reset.css">
  <link rel="stylesheet" href="../../css/index.css">
</head>
<body>
  <?php include (dirname(__FILE__) . "/boozer_header.php");
    if($page_flag === 1): ?>
  <div>
    <h2>エージェンシー企業の詳細情報</h2>
      <form method="POST" action="edit.php">
        <img src="" alt="">
        <h3><?=$agency[0]['agent_name'] ?></h3>
        <dl>
          <dt>電話番号</dt>
          <dd><?= $agency[0]['tel_number']?></dd>
          <dt>得意な業界</dt>
          <dd><?= $agency[0]['category'] ?></dd>
          <dt>企業サイトのURL</dt><dd><?= $agency[0]['url'] ?></dd>
          <dt>通知先メールアドレス</dt><dd><?= $agency[0]['notification_email'] ?></dd>
          <dt>電話番号</dt><dd><?= $agency[0]['tel_number'] ?></dd>
          <dt>会社住所</dt>
          <dd><?= $agency[0]['post_number'], $agency[0]['prefecture'], $agency[0]['municipalitie'], $agency[0]['adress_number']?></dd>
          <dt>特異な業種</dt><dd><?= $category ?></dd>
          <dt>登録エージェント</dt>
          <?php foreach($managers as $index => $manager): ?>
            <dd><?= $manager['manager_last_name'], $manager['manager_first_name']?></dd>
          <?php endforeach;?>
        </dl>
        <input type="hidden" name="agent_id" value="<?php echo $agency[0]['id'];?>">
        <input class="editbtn" type="submit" name="edit" value="エージェンシ―企業の掲載を編集">
        <input  class="deletebtn" type="submit" name="delete" formaction="delete.php"  value="エージェンシ―企業の掲載を削除">
      </form>
      <a href='javascript:history.back()'>戻る</a>
  </div>
  <?php else: ?>
  <div>
    <h2>掲載企業一覧</h2>
    <?php foreach ($agents as $index => $agent) : ?>
    <div>
      <a href='./agentslist.php?agent_id=<?php echo $agent['id'];?>'>
        <form method="POST" action="edit.php">
          <img src="" alt="">
          <h3><?=$agent['agent_name'] ?></h3>
          <input type="hidden" name="agent_id" value="<?php echo $agent['id']; ?>">
          <input type="submit" name="edit" value="編集">
          <input type='submit' formaction='delete.php' name='delete' value ='削除'>
        </form>
      </a>
    </div>
    <?php endforeach;?>
    <a href='javascript:history.back()'>戻る</a>
  </div>
  <?php 
  endif; 
  include (dirname(__FILE__) . "/boozer_footer.php");
  ?>
</body>
</html>