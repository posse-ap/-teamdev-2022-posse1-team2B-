<!--絞り込み条件
・内定支援実績：・・
・登録者実績：・・
・タイプ(カテゴリー？)：総合　　・・・・・
・実績：入社後の定着率：92%　　・
・求人社数　　・・・
・

-->


<?php 
require("../dbconnect.php");
$page_flag = 0;
if(isset($_GET["search"])) {
  $page_flag = 1;
} 

session_start();
$stmt = $db->prepare('SELECT * FROM agents');
$stmt->execute();
$agents = $stmt->fetchAll();

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


  // 絞り込み検索
// $_REQUEST は現在の $_GET、$_POST、$_COOKIE などの内容をまとめた変数
if(isset($_POST['category'])){
  $category_array = array();
  foreach($_POST['category'] as $key => $category) {
      $category_array[] = "$category";
      $stmt = $db->prepare('SELECT * FROM agents WHERE category = :category');
      $stmt -> bindValue(':category', $category_array[$key]);
      $stmt->execute();
      $aaaa = $stmt->fetchAll();
  
    }
    print_r($aaaa);
}
// ベストではない
// →カテゴリーが日本語→よろしくない
// →カテゴリーの名前が変わった時に、エージェンシー企業のテーブル自体も変える
// →カテゴリーとエージェントのテーブルを分けるべき
// →中間テーブルを作ってつないであげる



  

// $where = ""
// foreach($_REQUEST['category'] as $key => $category) {
//   $where[] = "category = '$category'"
// }
// $print_r($where);
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
    <!-- 絞り込み結果 -->
  <div class="main">
    <h1>絞り込み結果</h1>
    <a href="./condition_selection.php">✕</a>
    <a href="./keep.php">キープ中の企業</a>
    <ul>
      <li>
        <a href="./agent_detail.php">
          <p><?php print_r($recommend_agent_name);?></p>
          <img src="../img/<?php print_r("agent_id");?>.png" alt="エージェンシー企業">
          <dl>
            <dt>得意な業種</dt>
            <dd><?php print_r($specialty_industry);?></dd>
            <dt>対応エリア</dt>
            <dd><?php print_r($supported_area);?></dd>
            <dt>対象学生</dt>
            <dd><?php print_r($target_student);?></dd>
            <dt>対応企業の規模</dt>
            <dd><?php print_r($supported_corporate_scale);?></dd>
          </dl>
          <form action="./keep.php" method="POST">
            <input type="hidden" name="agent_id" value="<?php print_r($agents[0]['id']);?>">
            <button type="submit" class="keepbtn">キープする</button>
            <button type="submit" formaction="./contact.php" class="inquirybtn">エージェンシー企業に問い合わせる</button>
          </form>
        </a>
      </li>
      <li>
        <a href="./agent_detail.php">
          <p><?php print_r($recommend_agent_name);?></p>
          <img src="../img/<?php print_r("agent_id");?>.png" alt="エージェンシー企業">
          <dl>
            <dt>得意な業種</dt>
            <dd><?php print_r($specialty_industry);?></dd>
            <dt>対応エリア</dt>
            <dd><?php print_r($supported_area);?></dd>
            <dt>対象学生</dt>
            <dd><?php print_r($target_student);?></dd>
            <dt>対応企業の規模</dt>
            <dd><?php print_r($supported_corporate_scale);?></dd>
          </dl>
          <form action="./keep.php" method="POST">
            <input type="hidden" name="agent_id" value="<?php print_r($agents[0]['id']);?>">
            <button type="submit" class="keepbtn">キープする</button>
            <button type="submit" formaction="./contact.php" class="inquirybtn">エージェンシー企業に問い合わせる</button>
          </form>
        </a>
      </li>
      <li>
        <a href="./agent_detail.php">
          <p><?php print_r($recommend_agent_name);?></p>
          <img src="../img/<?php print_r("agent_id");?>.png" alt="エージェンシー企業">
          <dl>
            <dt>得意な業種</dt>
            <dd><?php print_r($specialty_industry);?></dd>
            <dt>対応エリア</dt>
            <dd><?php print_r($supported_area);?></dd>
            <dt>対象学生</dt>
            <dd><?php print_r($target_student);?></dd>
            <dt>対応企業の規模</dt>
            <dd><?php print_r($supported_corporate_scale);?></dd>
          </dl>
          <form action="" method="POST">
            <input type="hidden" name="agent_id" value="<?php print_r($agents[0]['id']);?>">
            <button type="submit" name="keep" class="keepbtn">キープする</button>
          </form>
        </a>
      </li>
    </ul>
  </div>
  <!-- こだわり条件から探すをクリックした場合に表示 -->
  <?php else:?>
  <div class="main">
   <div class="conditionselectioninner">
    <a href="./index.php" class="exitbtn">✕</a>
    <form action="condition_selection.php" method="POST">
      <h1 class="pagetitle">条件で絞り込む</h1>
      <div>
        <div class="conditiongroup">
          <h2>得意業界</h2>
          <input type="checkbox" name="food" id="food">
          <label from="food">食品</label>
          <input type="checkbox" name="apparel" id="apparel">
          <label from="apparel">アパレル</label>
          <input type="checkbox" name="it" id="it">
          <label from="it">IT</label>
          <input type="checkbox" name="finance" id="finance">
          <label from="finance">金融</label>
          <input type="checkbox" name="real_estate" id="realEstate">
          <label from="realEstate">不動産</label>
          <input type="checkbox" name="ad" id="ad">
          <label from="ad">広告</label>
          <input type="checkbox" name="trading_company" id="tradingCompany">
          <label from="tradingCompany">商社</label>
        </div>
        <div class="conditiongroup">
          <h2>登録企業の規模</h2>
          <input type="checkbox" name="smaller_businesses" id="smallerBusinesses">
          <label from="smallerBusinesses">中小企業</label>
          <input type="checkbox" name="big_businesses" id="bigBusinesses">
          <label from="bigBusinesses">大企業</label>
          <input type="checkbox" name="venture_corporation" id="ventureCorporation">
          <label from="ventureCorporation">ベンチャー企業</label>
        </div>
        <div class="conditiongroup">
          <h2>求人エリア</h2>
          <input type="checkbox" name="kanto_region" id="kantoRegion">
          <label from="kantoRegion">関東地方</label>
          <input type="checkbox" name="kansai_region" id="kansaiRegion">
          <label from="kansaiRegion">関西地方</label>
          <input type="checkbox" name="tokai_region" id="tokaiRegion">
          <label from="tokaiRegion">東海地方</label>
          <input type="checkbox" name="kyushu_region" id="kyushuRegion">
          <label from="kyushuRegion">九州地方</label>
        </div>
        <div class="conditiongroup">
          <h2>対象学生</h2>
          <input type="checkbox" name="2024_graduation" id="2024Graduation">
          <label from="2024Graduation">24卒</label>
          <input type="checkbox" name="2025_graduation" id="2025Graduation">
          <label from="2025Graduation">25卒</label>
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