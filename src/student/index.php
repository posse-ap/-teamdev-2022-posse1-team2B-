<?php
require("../dbconnect.php");
//全エージェント会社の情報取得
$stmt = $db->prepare('SELECT * FROM agents');
$stmt->execute();
$agents = $stmt->fetchAll();
session_start();
// if($_SERVER['REQUEST_METHOD']==='POST'){
//   if(isset($_POST['agent_id'])){
//     $agent_id = $_POST['agent_id'];
//     $_SESSION['keep'][$agent_id]=$agent_id; //セッションにデータを格納
//     if(isset($_POST['cancel'])) {
//       unset($_SESSION['keep'][$agent_id]);
//     }
//   }
// }
$keeps=array();
if(isset($_SESSION['keep'])){
  $keeps=$_SESSION['keep'];
  $_SESSION['time'] = time();
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Top画面</title>
  <link rel="stylesheet" href="../css/reset.css">
  <link rel="stylesheet" href="../css/index.css">
</head>
<body>
  <?php include (dirname(__FILE__) . "/student_header.php");?>
  <div class="main">
    <div> 
      <a href="condition_selection.php">こだわり条件から探す</a>
      <div>
        <h1 class="pagetitle">月間ランキング</h1>
        <ul>
          <?php
          $counter = 0;
          foreach($agents as $index => $agent): ?>
          <li>
          <a href="./agent_detail.php?id=<?php echo$agent['id']; ?>">
            <p><?= $agent['agent_name']?></p>
            <p>得意な業種<?= $agent['category']?></p>
            <p>対応エリア<?= $agent['prefecture']?></p>
            <form action="keep.php" method="POST">
              <input type="hidden" name="agent_id" value="<?php print_r($agent['id']);?>">
              <!-- <button type="submit" name='keep' class="keepbtn">キープする</button> -->
              <button type="submit" name='keep' class="keepbtn">キープする</button>
            </form>
          </a>
          </li>
          <?php 
            if ($counter >= 2) {break;}
            $counter++;
            endforeach; ?>
        </ul>
      </div>
      <div>
        <h2>業種別ランキング</h2>
        <form action="./agency_list.php" method="POST">
          <ul>
            <li><input type="submit" name="finance" value="金融"></li>
            <li><input type="submit" name="it" value="IT"></li>
            <li><input type="submit" name="ad" value="広告"></li>
            <li><input type="submit" name="tradingCompany" value="商社"></li>
            <li><input type="submit" name="food" value="食品"></li>
            <li><input type="submit" name="realEstate" value="不動産"></li>
          </ul>
          <h2>求人エリア別ランキング</h2>
          <ul>
            <li><input type="submit" name="kanto" value="関東"></li>
            <li><input type="submit" name="kansai" value="関西"></li>
            <li><input type="submit" name="tokai" value="東海"></li>
            <li><input type="submit" name="kyushu" value="九州"></li>
          </ul>
        </form>
      </div>
    </div>
  </div>
  <?php include (dirname(__FILE__) . "/student_footer.php");?>
  <script src="student.js"></script>
</body>
</html>