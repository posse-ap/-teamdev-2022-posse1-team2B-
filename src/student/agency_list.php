<?php
  $page_flag = 0;
  if(isset($_POST["finance"]) || isset($_POST["it"]) || isset($_POST["ad"]) || isset($_POST["tradingCompany"]) || isset($_POST["food"]) || isset($_POST["realEstate"])) {
    $page_flag = 1;
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
        if(isset($_POST["finance"])) {
          echo $_POST["finance"];
        } elseif(isset($_POST["it"])){
          echo $_POST["it"];
        } elseif(isset($_POST["ad"])){
          echo $_POST["ad"];
        } elseif(isset($_POST["tradingCompany"])){
          echo $_POST["tradingCompany"];
        } elseif(isset($_POST["food"])){
          echo $_POST["food"];
        } elseif(isset($_POST["rearEstate"])){
          echo $_POST["realEstate"];
        }
      ?>企業のエージェンシー企業一覧</h1>
      <a href="./index.php">✕</a>
      <!-- 画面の右端に表示。クリックするとキープ画面に飛ぶ -->
      <a href="./keep.php">キープ中の企業</a>
      <ol>
        <li>        
          <p>会社名</p>
          <p>得意な業種</p>
          <p>対応エリア</p>
          <form action="keep.php" method="POST">
            <input type="hidden" name="agent_id" value="<?php print_r($agent["agent_id"]);?>">
            <button type="submit" class="keepbtn">キープする</button>
          </form>
        </li>
        <li>        
          <p>会社名</p>
          <p>得意な業種</p>
          <p>対応エリア</p>
          <form action="keep.php" method="POST">
            <input type="hidden" name="agent_id" value="<?php print_r($agent["agent_id"]);?>">
            <button type="submit" class="keepbtn">キープする</button>
          </form>
        </li>
      </ol>
    </div>
    <!-- 対応エリア別ランキングをクリックしたとき -->
    <?php else: ?>
    <div id="areaRank">
      <h1>
      <?php 
        if(isset($_POST["kanto"])) {
          echo $_POST["kanto"];
        } elseif(isset($_POST["kansai"])){
          echo $_POST["kansai"];
        } elseif(isset($_POST["tokai"])){
          echo $_POST["tokai"];
        } elseif(isset($_POST["kyushu"])){
          echo $_POST["kyushu"];
        }
        ?>エリアのエージェンシー企業一覧</h1>
      <a href="./index.php" class="exitbtn">✕</a>
      <!-- 画面の右端に表示。クリックするとキープ画面に飛ぶ -->
      <a href="./keep.php">キープ中の企業</a>
      <ol>
      <li>        
          <p>会社名</p>
          <p>得意な業種</p>
          <p>対応エリア</p>
          <form action="keep.php" method="POST">
            <input type="hidden" name="agent_id" value="<?php print_r($agent["agent_id"])?>">
            <button type="submit" class="keepbtn">キープする</button>
          </form>
      </li>
      <li>        
          <p>会社名</p>
          <p>得意な業種</p>
          <p>対応エリア</p>
          <form action="keep.php" method="POST">
            <input type="hidden" name="agent_id" value="<?php print_r($agent["agent_id"])?>">
            <button type="submit" class="keepbtn">キープする</button>
          </form>
      </li>
      </ol>
    </div>
  </div>
  <? endif; ?>
  <?php include (dirname(__FILE__) . "/student_footer.php");?>
  <script src="./student.js"></script>
</body>
</html>