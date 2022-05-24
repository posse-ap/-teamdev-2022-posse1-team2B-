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
  <link rel="stylesheet" href="../../css/reset.css">
  <link rel="stylesheet" href="../../css/index.css">
  <link rel="stylesheet" href="../../css/agency.css">
</head>
<body>
  <?php include (dirname(__FILE__) . "/boozer_header.php");?>
  <div class="main">
    <div class="boozerindexouter">
      <div>
        <h2 class="pagetitle">掲載企業一覧</h2>
        <?php 
        $counter = 0;
        foreach($agents as $agent): ?>
        <div>
          <a href='./agentslist.php?agent_id=<?php echo $agent['id'];?>'>
            <form action="delete.php" method="POST" class="indexagencybox">
              <img src="" alt="">
              <h3><?php echo $agent['agent_name']; ?></h3>
              <input type="hidden" name="agent_id" value="<?php echo $agent['id'];?>">
              <div>
                <input class="editbtn" type="submit" name="edit" formaction="edit.php" value="編集">
                <input class="deletebtn" type="submit" name="delete" value="削除">
              </div>
            </form>
          </a>
        </div>
        <?php 
          if ($counter >= 2) {break;}
          $counter++;
          endforeach;
        ?>
        <a  class="inquirybtn" href="./agentslist.php">企業一覧をもっと見る</a>
      </div>
      <div class="boozerindexinner">
        <a class="loginbtn" href="./payment.php">明細確認</a>
        <a class="inquirybtn" href="./students.php">学生情報</a>
      </div>
    </div>
    <a href="./create_contents.php" class="inquirybtn indexbtn">エージェンシーの掲載内容を登録する</a>
  </div>
  <?php include (dirname(__FILE__) . "/boozer_footer.php");?>
  <script src="boozer.js"></script>
</body>
</html>