<?php $page_flag = 0;
if(isset($_POST["search"])) {
  $page_flag = 1;
} ?>
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
            <input type="hidden" name="agent_id" value="<?php print_r($agent['agent_id']);?>">
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
            <input type="hidden" name="agent_id" value="<?php print_r($agent['agent_id']);?>">
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
            <input type="hidden" name="agent_id" value="<?php print_r($agent['agent_id']);?>">
            <button type="submit" class="keepbtn">キープする</button>
            <button type="submit" formaction="./contact.php" class="inquirybtn">エージェンシー企業に問い合わせる</button>
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