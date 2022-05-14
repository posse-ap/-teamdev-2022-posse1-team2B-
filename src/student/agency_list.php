<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="student.css">
</head>
<body>
<?php include (dirname(__FILE__) . "/student_header.php");?>
  <div>
  <!-- 業種別ランキングをクリックした時に表示されるモーダル -->
  <div id="industryRank">
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
    ?></h1>
    <!-- 閉じるボタン -->
    <button id="closeButton">✕</button>
    <!-- 画面の右端に表示。クリックするとキープ画面に飛ぶ -->
    <a href="./keep.php">キープ中の企業</a>
    <ol>
      <li>        
        <p>会社名</p>
        <p>得意な業種</p>
        <p>対応エリア</p>
        <form action="keep.php" method="POST">
          <input type="hidden" name="agent_id" value="<?php print_r($agent["agent_id"]);?>">
          <button type="submit">キープする</button>
        </form>
      </li>
      <li>        
        <p>会社名</p>
        <p>得意な業種</p>
        <p>対応エリア</p>
        <form action="keep.php" method="POST">
          <input type="hidden" name="agent_id" value="<?php print_r($agent["agent_id"]);?>">
          <button type="submit">キープする</button>
        </form>
      </li>
    </ol>
  </div>
  <!-- 対応エリア別ランキングをクリックしたときに表示されるモーダル -->
  <div id="areaRank">
    <h1>関東エリアのエージェンシー企業ランキング</h1>
    <!-- 閉じるボタン -->
    <button id="closeButton">✕</button>
    <!-- 画面の右端に表示。クリックするとキープ画面に飛ぶ -->
    <a href="./keep.php">キープ中の企業</a>
    <ol>
    <li>        
        <p>会社名</p>
        <p>得意な業種</p>
        <p>対応エリア</p>
        <form action="keep.php" method="POST">
          <input type="hidden" name="agent_id" value="<?php print_r($agent["agent_id"])?>">
          <button type="submit">キープする</button>
        </form>
    </li>
    <li>        
        <p>会社名</p>
        <p>得意な業種</p>
        <p>対応エリア</p>
        <form action="keep.php" method="POST">
          <input type="hidden" name="agent_id" value="<?php print_r($agent["agent_id"])?>">
          <button type="submit">キープする</button>
        </form>
    </li>
    </ol>
  </div>
  <?php include (dirname(__FILE__) . "/student_footer.php");?>
  <script src="./student.js"></script>
</body>
</html>