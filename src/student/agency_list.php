<?php
session_start();
require("../dbconnect.php");
$page_flag = 0;

$where = array();

if(isset($_POST['category'])) {
  $page_flag = 1;
  $category = $_POST['category'];
  // $category_array = array();
  // $category_array[] = "$category";
  // print_r($category_array[1]);
  $stmt = $db->prepare('SELECT id FROM category WHERE category_name = :category');
  $stmt -> bindValue(':category', $category);
  $stmt->execute();
  $category_id= $stmt->fetch();
  $where = 'category_id =' . $category_id['id'];
  echo$where;
    $sql = "SELECT * FROM characteristic WHERE " . $where;
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $rows=$stmt->fetchAll();
foreach($rows as $row) {
  $sql = 'select * from characteristic left join agents on characteristic.agent_id = agents.id left join category on characteristic.category_id = category.id left join job_area on characteristic.job_area_id = job_area.id where ' . $where;
  $stmt = $db->prepare($sql);
  $stmt->execute();
  $agent_categories=$stmt->fetchAll();
}}

if(isset($_POST['area'])) {
  $page_flag = 2;
  $area = $_POST['area'];
  // $category_array = array();
  // $category_array[] = "$area";
  // print_r($category_array[1]);
  $stmt = $db->prepare('SELECT id FROM job_area WHERE area = :area');
  $stmt -> bindValue(':area', $area);
  $stmt->execute();
  $area_id= $stmt->fetch();
  $where = 'job_area_id =' . $area_id['id'];
    $sql = "SELECT * FROM characteristic WHERE " . $where;
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $rows=$stmt->fetchAll();
foreach($rows as $row) {
  $sql = 'select * from characteristic left join agents on characteristic.agent_id = agents.id left join category on characteristic.category_id = category.id left join job_area on characteristic.job_area_id = job_area.id where ' . $where;
  $stmt = $db->prepare($sql);
  $stmt->execute();
  $agent_areas=$stmt->fetchAll();
}}


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
      <h1 class="pagetitle">
        <?php 
        print_r($category);
      ?>が得意なエージェンシー一覧</h1>
      <div class="exitcontainer">
        <a href="./index.php" class="exitbtn">✕</a>
      </div>
      <!-- 画面の右端に表示。クリックするとキープ画面に飛ぶ -->
      <a href="./keep.php" class="keepbtn">キープ中の企業</a>
      <ol>
        <?php
          if (isset($agent_categories)) {
            foreach($agent_categories as $index => $agent_category):
        ?>
            <li>
              <a href="./agent_detail.php?id=<?php echo $agent_category['agent_id']; ?>">
                <p>会社名:<?php echo $agent_category['agent_name'];?></p>
                <p>得意な業種:<?php echo $agent_category['category_name'];?></p>
                <p>対応エリア:<?php echo $agent_category['area'];?></p>
                <form action="" method="POST">
                  <?php
                      if(isset($keeps[$agent_category['agent_id']]) === true):
                      ?>
                      <p>キープ済み</p>
                      <?php else: ?>
                      <!-- <input type="hidden" name="category" value="<?php //print_r($agent_category);?>"> -->
                      <input type="hidden" name="agent_id" value="<?php print_r($agent_category["agent_id"]);?>">
                      <button id="keep<?php echo $index; ?>" type="submit" name='keep' class="keepbtn">キープする</button>
                      <?php endif;?>
                </form>
              </a>        
            </li>
        <?php 
          endforeach;
        }
        else {
        echo('<p>該当する企業はありません。</p>');
        }
        ?>
      </ol>
    </div>
    <!-- 対応エリア別ランキングをクリックしたとき -->
    <?php elseif($page_flag = 2): ?>
    <div id="areaRank">
      <h1  class="pagetitle">
      <?php 
        print_r($area);
        ?>エリアに対応しているエージェンシー企業一覧</h1>
      <a href="./index.php" class="exitbtn">✕</a>
      <!-- 画面の右端に表示。クリックするとキープ画面に飛ぶ -->
      <a href="./keep.php">キープ中の企業</a>
      <ol>
        <?php
            if (isset($agent_areas)) {
              foreach($agent_areas as $index => $agent_area):
        ?>
        <li>        
            <p>会社名:<?php echo$agent_area['agent_name'];?></p>
            <p>得意な業種:<?php echo$agent_area['category_name'];?></p>
            <p>対応エリア:<?php echo$agent_area['area'];?></p>
            <form action="" method="POST">
              <?php
                  if(isset($keeps[$agent_area['agent_id']]) === true):
                  ?>
                  <p class="returnbtn marginbottomnone">キープ済み</p>
                  <?php else: ?>
                  <input type="hidden" name="agent_id" value="<?php print_r($agent_area["agent_id"]);?>">
                  <button id="keep<?php echo $index; ?>" type="submit" name='keep' class="keepbtn">キープする</button>
                  <?php endif;?>
            </form>
        </li>
        <?php 
          endforeach;
        }
        else {
        echo('<p>該当する企業はありません。</p>');
        }
        ?>
      </ol>
    </div>
  </div>
  <?php endif; ?>
  <?php include (dirname(__FILE__) . "/student_footer.php");?>
  <script src="./student.js"></script>
</body>
</html>