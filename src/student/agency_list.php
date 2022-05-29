<?php
session_start();
require("../dbconnect.php");
$page_flag = 0;
if($_SERVER['REQUEST_METHOD']==='POST'){
  if(isset($_POST['finance'])) {
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
    $_SESSION['category']=$ad;
  } elseif (isset($_POST["tradingCompany"])){
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
  $category = array();
  if(isset($_SESSION['category'])){
    $category = $_SESSION['category'];
  }
  if(isset($_POST['kanto'])) {
    $page_flag = 2;
    $kanto = $_POST['kanto'];
    $_SESSION['aria']=$kanto;
  } elseif (isset($_POST["kansai"])){
    $page_flag = 2;
    $kansai = $_POST['kansai'];
    $_SESSION['aria']=$kansai;
  } elseif (isset($_POST["tokai"])){
    $page_flag = 2;
    $tokai = $_POST['tokai'];
    $_SESSION['aria']=$tokai;
  } elseif (isset($_POST["kyushu"])){
    $page_flag = 2;
    $kyushu = $_POST['kyushu'];
    $_SESSION['aria']=$kyushu;
  }
  $aria = array();
  if(isset($_SESSION['aria'])){
    $aria = $_SESSION['aria'];
  }
}
$stmt = $db->prepare('SELECT * FROM agents');
$stmt->execute();
$agents = $stmt->fetchAll();
// session_start();
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
// キープするボタンを押しても、金融とか何も選択していない状態のページにさせないため
if(isset($_POST['category'])) {
  $page_flag = 1;
}
if(isset($_POST['aria'])) {
  $page_flag = 2;
}
  ?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../css/reset.css">
  <link rel="stylesheet" href="../css/index.css">
</head>
<body>
<?php include (dirname(__FILE__) . "/student_header.php");?>
  <!-- 業種別ランキングをクリックした時 -->
  <div class="main">
    <?php if($page_flag === 1): ?>
    <div>
      <h1>
        <?php 
        print_r($category);
      ?>が得意なエージェンシー企業一覧</h1>
      <a href="./index.php">✕</a>
      <!-- 画面の右端に表示。クリックするとキープ画面に飛ぶ -->
      <a href="./keep.php">キープ中の企業</a>
      <ol>
        <?php
          foreach($agents as $index => $agent):
        ?>
        <li>        
          <p>会社名:<?php echo $agent['agent_name'];?></p>
          <p>得意な業種</p>
          <p>対応エリア</p>
          <form action="" method="POST">
            <?php
                if(isset($keeps[$agent['id']]) === true):
                ?>
                <p>キープ済み</p>
                <?php else: ?>
                <input type="hidden" name="category" value="<?php print_r($category);?>">
                <input type="hidden" name="agent_id" value="<?php print_r($agent["id"]);?>">
                <button id="keep<?php echo $index; ?>" type="submit" name='keep' class="keepbtn">キープする</button>
                <?php endif;?>
          </form>
        </li>
        <?php endforeach; ?>
      </ol>
    </div>
    <!-- 対応エリア別ランキングをクリックしたとき -->
    <?php elseif($page_flag = 2): ?>
    <div id="areaRank">
      <h1>
      <?php 
        print_r($aria);
        ?>エリアに対応しているエージェンシー企業一覧</h1>
      <a href="./index.php" class="exitbtn">✕</a>
      <!-- 画面の右端に表示。クリックするとキープ画面に飛ぶ -->
      <a href="./keep.php">キープ中の企業</a>
      <ol>
        <?php
            foreach($agents as $index => $agent):
        ?>
        <li>        
            <p>会社名<?php echo$agent['agent_name'];?></p>
            <p>得意な業種</p>
            <p>対応エリア</p>
            <form action="" method="POST">
              <?php
                  if(isset($keeps[$agent['id']]) === true):
                  ?>
                  <p>キープ済み</p>
                  <?php else: ?>
                  <input type="hidden" name="aria" value="<?php print_r($aria);?>">
                  <input type="hidden" name="agent_id" value="<?php print_r($agent["id"]);?>">
                  <button id="keep<?php echo $index; ?>" type="submit" name='keep' class="keepbtn">キープする</button>
                  <?php endif;?>
            </form>
        </li>
        <?php endforeach; ?>
      </ol>
    </div>
  </div>
  <?php endif; ?>
  <?php include (dirname(__FILE__) . "/student_footer.php");?>
  <script src="./student.js"></script>
</body>
</html>