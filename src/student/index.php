<?php
require("../dbconnect.php");
//全エージェント会社の情報取得
$stmt = $db->prepare('SELECT * FROM agents');
$stmt->execute();
$agents = $stmt->fetchAll();
session_start();
if($_SERVER['REQUEST_METHOD']==='POST'){
  if(isset($_POST['agent_id'])){
    $agent_id = $_POST['agent_id'];
    $_SESSION['keep'][$agent_id]=$agent_id; //セッションにデータを格納
    if(isset($_POST['cancel'])) {
      unset($_SESSION['keep'][$agent_id]);
    }
  }
}
$keeps=array();
if(isset($_SESSION['keep'])){
  $keeps=$_SESSION['keep'];
  $_SESSION['time'] = time();
}

if($_SERVER['REQUEST_METHOD']==='POST'){
  if(isset($_POST["finance"])) {
    $page_flag = 1;
    $finance = $_POST['finance'];
    $_SESSION['category']=$finance;
  } elseif(isset($_POST["it"])) {
    $page_flag = 1;
    $it = $_POST['it'];
    $_SESSION['category']=$it;
  } elseif(isset($_POST["ad"])) {
    $page_flag = 1;
    $ad = $_POST['ad'];
    $_SESSION['category']=$ad;} elseif (isset($_POST["tradingCompany"])){
    $page_flag = 1;
    $tradingCompany = $_POST['tradingCompany'];
    $_SESSION['category']=$tradingCompany;
  } elseif (isset($_POST["food"])) {
    $page_flag = 1;
    $food = $_POST['food'];
    $_SESSION['category']=$food;
  } elseif (isset($_POST["realEstate"])){
    $page_flag = 1;
    $realEstate = $_POST['realEstate'];
    $_SESSION['category']=$realEstate;
  }
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
  <script src="https://kit.fontawesome.com/36c0fb6822.js" crossorigin="anonymous"></script>
</head>
<body>
  <?php include (dirname(__FILE__) . "/student_header.php");?>
  <div class="main">
    <div> 
      <a href="condition_selection.php" class="conditionsearch">こだわり条件から探す <i class="fa-solid fa-magnifying-glass"></i></a>
      <div class="monthlyrankingbox">
        <h1 class="pagetitle">月間ランキング</h1>
        <ul>
          <?php
          $counter = 0;
          foreach($agents as $index => $agent): ?>
          <li>
            <a href="./agent_detail.php?id=<?php echo$agent['id']; ?>">
              <p class="agentname"><?= $agent['agent_name']?></p>

              <p class="agentcategory">得意な業種：<?php
              $stmt = $db->prepare('select * from characteristic left join agents on characteristic.agent_id = agents.id right join category on characteristic.category_id = category.id where agent_id = :agent_id');
              $stmt->bindValue(':agent_id', $agent['id']);
              $stmt->execute();
              $matched_category = $stmt->fetchAll();
              print_r($matched_category[0]['category_name']);
              ?></p>

              <p class="agentcategory">対応エリア：<?php
              $stmt = $db->prepare('select * from characteristic left join agents on characteristic.agent_id = agents.id right join job_area on characteristic.job_area_id = job_area.id where agent_id = :agent_id');
              $stmt->bindValue(':agent_id', $agent['id']);
              $stmt->execute();
              $matched_job_area = $stmt->fetchAll();
              print_r($matched_job_area[0]['area']);
              ?></p>

              <form action="" method="POST">
                <!-- <form action="keep.php" method="POST"> -->
                <input type="hidden" name="agent_id" value="<?php print_r($agent['id']);?>">
                <?php
                // echo $agent['id'];
                if(isset($keeps[$agent['id']]) === true):
                ?>
                <p class=">キープ済み</p>
                <?php else: ?>
                <button id="keep<?php echo $index; ?>" type="submit" name='keep' class="keepbtn margintop">キープする</button>
                <?php endif;?>
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
        <form action="./agency_list.php" method="POST">
          <div class="horizontalrankingboxes">
            <div class="rankingboxes">
              <h2 class="pagetitle">業種別ランキング</h2>
              <ul class>
                <li><input type="submit" name="finance" value="金融"></li>
                <li><input type="submit" name="it" value="IT"></li>
                <li><input type="submit" name="ad" value="広告"></li>
                <li><input type="submit" name="tradingCompany" value="商社"></li>
                <li><input type="submit" name="food" value="食品"></li>
                <li><input type="submit" name="realEstate" value="不動産"></li>
              </ul>
            </div>
            <div class="rankingboxes">
              <h2 class="pagetitle">求人エリア別ランキング</h2>
              <ul class>
                <li><input type="submit" name="kanto" value="関東"></li>
                <li><input type="submit" name="kansai" value="関西"></li>
                <li><input type="submit" name="tokai" value="東海"></li>
                <li><input type="submit" name="kyushu" value="九州"></li>
              </ul>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <?php include (dirname(__FILE__) . "/student_footer.php");?>
  <script src="student.js"></script>
</body>
</html>