<?php 
require("../dbconnect.php");
$page_flag = 0;
if(isset($_POST["search"])) {
  $page_flag = 1;
} 

session_start();
$stmt = $db->prepare('SELECT * FROM agents where valid = 1');
$stmt->execute();
$agents = $stmt->fetchAll();

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

if(isset($_POST["search"])) {
$where = array();
if(isset($_POST['category'])) {
  foreach($_POST['category'] as $category) {
    $category_array = array();
    // print_r($category);
    $category_array[] = "$category";
    // print_r($category_array[1]);
    $stmt = $db->prepare('SELECT id FROM category WHERE category_name = :category');
    $stmt -> bindValue(':category', $category_array[0]);
    $stmt->execute();
    $categories = $stmt->fetchAll();
    $where[] = 'category_id =' . $categories[0]['id'];
}}

if(isset($_POST['job_area'])) {
  foreach($_POST['job_area'] as $key => $job_area) {
      $job_area_array = array();
      $job_area_array[] = "$job_area";
      $stmt = $db->prepare('SELECT id FROM job_area WHERE area = :job_area');
      $stmt -> bindValue(':job_area', $job_area_array[$key]);
      $stmt->execute();
      $areas = $stmt->fetchAll();
      $where[] = 'job_area_id =' . $areas[0]['id'];
    }
}
if(isset($_POST['target_student'])) {
  foreach($_POST['target_student'] as $key => $target_student) {
    $target_student_array[] = "$target_student";
    $stmt = $db->prepare('SELECT id FROM target_student WHERE graduation_year = :target_student');
    $stmt -> bindValue(':target_student', $target_student_array[$key]);
    $stmt->execute();
    $targets = $stmt->fetchAll();
    $where[] = 'target_student_id =' . $targets[0]['id'];
  }
}

}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>こだわり条件で絞り込む</title>
  <link rel="stylesheet" href="../css/reset.css">
  <link rel="stylesheet" href="../css/index.css">
</head>
<body>
  <?php include (dirname(__FILE__) . "/student_header.php");?>
  <?php 
  if($page_flag === 1 || isset($_GET["back"])):?>
  <div class="main">
    <h1 class="pagetitle">絞り込み結果</h1>
    <div class="exitcontainer">
    <a href="./condition_selection.php" class="exitbtn">✕</a>
    </div>
    <a href="./keep.php" class="keepbtn">キープ中の企業</a>
    <?php if (count($where) > 0) : ?>
      <ul>
      <?php
        $sql = "SELECT * FROM characteristic WHERE " . implode(' AND ', $where);
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $rows=$stmt->fetchAll();
        foreach($rows as $row) :
      ?>
          <li class="agentdetailinner">
            <a href="./agent_detail.php">
              <div class="agentheader">
                <p><?php ?></p>
                <img src="../img/<?php ?>.png" alt="エージェンシー企業">
              </div>
              <dl class="agentinfo">
                <?php
                  $stmt = $db->prepare('select * from characteristic left join agents on characteristic.agent_id = agents.id left join category on characteristic.category_id = category.id left join job_area on characteristic.job_area_id = job_area.id left join target_student on characteristic.target_student_id = target_student.id where agent_id = :agent_id where valid = 1');
                  // $stmt = $db->prepare('SELECT * FROM agents WHERE id = :agent_id');
                  $stmt -> bindValue(':agent_id', $row['agent_id']);
                  $stmt->execute();
                  $agent_information=$stmt->fetch();
                ?>
                <div>
                  <dt>得意な業種：</dt>
                  <dd><?php print_r($agent_information['agent_name']);?></dd>
                </div>
                <div>
                  <dt>対応エリア：</dt>
                  <dd><?php print_r($agent_information['area']);?></dd>
                </div>
                <div>
                  <dt>対象学生：</dt>
                  <dd><?php print_r($agent_information['graduation_year']);?></dd>
                </div>
              </dl>
              <form action="./keep.php" method="POST">
                <input type="hidden" name="agent_id" value="">
                <button type="submit" class="keepbtn">キープする</button>
                <button type="submit" formaction="./contact.php" class="inquirybtn">エージェンシーにお問い合わせ</button>
              </form>
            </a>
          </li>
        <?php 
          endforeach;
          if(empty($rows)) :
        ?>
          <p class="announce">該当する企業はありません。</p>
        <?php
          endif;
        ?>
      </ul>
    <?php else:?>
      <p class="announce">条件を選択してください</p>
    <?php endif; ?>
  </div>
  <!-- こだわり条件から探すをクリックした場合に表示 -->
  <?php else:?>
  <div class="main">
    <div class="conditionselectioninner">
      <a href="./index.php" class="exitbtn">✕</a>
      <form action="" method="POST">
        <h1 class="pagetitle">条件で絞り込む</h1>
        <div>
          <div class="conditiongroup">
            <h2>得意業界</h2>
            <input type="checkbox" name="category[]" value='IT' id="it">
            <label from="it">IT</label>
            <input type="checkbox" name="category[]" value='飲食' id="food">
            <label from="food">飲食</label>
            <input type="checkbox" name="category[]" value='メーカー' id="maker">
            <label from="maker">メーカー</label>
            <input type="checkbox" name="category[]" value='サービス' id="service">
            <label from="service">サービス</label>
            <input type="checkbox" name="category[]" value='商社' id="tradingCompany">
            <label from="tradingCompany">商社</label>
            <input type="checkbox" name="category[]" value='建築' id="architecture">
            <label from="architecture">建築</label>
            <input type="checkbox" name="category[]" value='小売' id="retail">
            <label from="retail">小売</label>
            <input type="checkbox" name="category[]" value='事務' id="officeWork">
            <label from="officeWork">事務</label>
            <input type="checkbox" name="category[]" value='広告' id="ad">
            <label from="ad">広告</label>
            <input type="checkbox" name="category[]" value='金融' id="finance">
            <label from="finance">金融</label>
            <input type="checkbox" name="category[]" value='コンサルティング' id="consulting">
            <label from="consulting">コンサルティング</label>
            <input type="checkbox" name="category[]" value='物流' id="logistics">
            <label from="logistics">物流</label>
            <input type="checkbox" name="category[]" value='通信' id="communication">
            <label from="communication">通信</label>
            <input type="checkbox" name="category[]" value='住宅' id="residence">
            <label from="residence">住宅</label>
            <input type="checkbox" name="category[]" value='保険' id="insurance">
            <label from="insurance">保険</label>
          </div>
          <div class="conditiongroup">
            <h2>対応している求人エリア</h2>
            <input type="checkbox" name="job_area[]" value="関東" id="kantoRegion">
            <label from="kantoRegion">関東地方</label>
            <input type="checkbox" name="job_area[]" value="関西" id="kansaiRegion">
            <label from="kansaiRegion">関西地方</label>
            <input type="checkbox" name="job_area[]" value="東海" id="tokaiRegion">
            <label from="tokaiRegion">東海地方</label>
            <input type="checkbox" name="job_area[]" value="九州" id="kyushuRegion">
            <label from="kyushuRegion">九州地方</label>
          </div>
          <div class="conditiongroup">
            <h2>対象学生</h2>
            <input type="checkbox" name="target_student[]" value="23卒" id="2023Graduation">
            <label from="2023Graduation">23卒</label>
            <input type="checkbox" name="target_student[]" value="24卒" id="2024Graduation">
            <label from="2024Graduation">24卒</label>
            <input type="checkbox" name="target_student[]" value="25卒" id="2025Graduation">
            <label from="2025Graduation">25卒</label>
            <input type="checkbox" name="target_student[]" value="26卒" id="2026Graduation">
            <label from="2026Graduation">26卒</label>
  
          </div>
        </div>
        <input type="submit" name="search" value = "検索" class="searchbtn">
      </form>
    </div>
  </div>
  <?php endif; ?>
  <?php include (dirname(__FILE__) . "/student_footer.php");?>
  <script src="./student.js"></script>
</body>
</html>