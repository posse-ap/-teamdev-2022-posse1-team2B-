<?php 
require("../dbconnect.php");
session_start();
//POSTデータをカート用のセッションに保存
if($_SERVER['REQUEST_METHOD']==='POST'){
  $agent_id = $_POST['agent_id'];
  $_SESSION['keep'][$agent_id]=$agent_id; //セッションにデータを格納
}
$keeps=array();
if(isset($_SESSION['keep'])){
$keeps=$_SESSION['keep'];
}
var_dump($keeps);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>キープ中のエージェンシー企業</title>
  <link rel="stylesheet" href="../css/reset.css">
  <link rel="stylesheet" href="../css/index.css">
</head>
<body>
  <?php include (dirname(__FILE__) . "/student_header.php");
  ?>
  <div class="main">
    <h1>キープ中のエージェンシー企業</h1>
    <?php if(count($keeps) > 0): ?>
      <table>
        <a href="./agent_detail.php">
          <thead>
            <tr>
              <th>エージェンシー企業名</th>
              <th>得意な業種</th>
              <th>対応エリア</th>
              <th>対象学生</th>
              <th>対応企業の規模</th>
              <!-- <th>備考</th> -->
            </tr>
          </thead>  
          <tbody>
            <?php foreach($keeps as $keep){
              $stmt = $db->prepare('SELECT * FROM agents WHERE id = :id');
              bindValue(':id', $keep);
              $stmt->execute();
              $agent = $stmt->fetch();
            ?>
            <tr>
              <td><?php print($agent['agent_name']); ?></td>
              <td><?php print($agent['industry']); ?></td>
              <td><?php print($agent['supported_area']); ?></td>
              <td><?php print($agent['target_student']); ?></td>
              <td><?php print($agent['corporate_scale']); ?></td>
              <td><?php //print($agent['remarks']); ?></td>
              <td>
                <form method="POST" action="">
                  <input type="submit" value="削除">
                  <input type="hidden" name="keep_id" value="<?php print($keep['agent_id']); ?>">
                </form>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </a>
    </table>
    <form action="./contact.php" method="POST">
      <input type="hidden" name="agent_id" value="<?php print_r($agent['agent_id']);?>">
      <button type="submit" class="inquirybtn">エージェンシー企業に問い合わせる</button>
    </form>
    <form action="" method="POST">
      <input type="hidden" name="kind" value="delete">
      <input type="hidden" name="product" value="<?php echo $key;?>">
      <input type="submit" value="削除">
      </input>
    </form>
    <?php else: ?>
      <p>キープしてるエージェンシー企業はありません。</p>
    <?php endif;?>
    <a href='javascript:history.back()' class="returnbtn">戻る</a>
  </div>
  <?php include (dirname(__FILE__) . "/student_footer.php");?>
  <script src="./student.js"></script>
</body>
</html>