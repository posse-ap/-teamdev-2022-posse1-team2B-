<!-- 
  ・ランキング詳細→学生一覧からの詳細への遷移を参考にする
-->

<?php
require("../dbconnect.php");


// お聞きしたいこと
// ・where = ? の?に変数を代入できない？
// ・カテゴリー中間テーブルのイメージ確認

//全エージェント会社の情報取得
$stmt = $db->prepare('SELECT * FROM agents');
$stmt->execute();
$agents = $stmt->fetchAll();

// 各エージェントへの申込数取得
// エージェント数ぶん回す
// foreach($agents as $index => $agent) {
//   $stmt = $db->prepare('SELECT count(*) FROM intermediate where agent_id = :agent_id');
//   $stmt->bindValue(':agent_id', $agent['id']);
//   // bindevalueの１が？の１個めってこと。これがあれば何個でもはてなつけられる！1,2とかだとわかりにくいから、「:agent_id」を設定する
//   $stmt->execute();
//   $offers = $stmt->fetchAll();
//   return $offers;
// }
  
  // エージェント名を回せるか実験
  // foreach($agents as $index => $agent) {
  //   print_r($agent['agent_name'] . PHP_EOL);
  // }

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
        <h1>月間ランキング</h1>
        <ul>
          <?php
          $counter = 0;
          foreach($agents as $index => $agent): ?>
          <li>
          <a href="./agent_detail.php?id=<?php echo$index; ?>">
            <p><?= $agent['agent_name']?></p>
            <p>得意な業種<?= $agent['category']?></p>
            <p>対応エリア<?= $agent['prefecture']?></p>
            <form action="keep.php" method="POST">
              <input type="hidden" name="agent_id" value="<?php print_r($agent["agent_id"]);?>">
              <button type="submit" class="keepbtn">キープする</button>
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
    <div>
    <!-- 業種別ランキングをクリックした時に表示されるモーダル -->
    <div id="industryRank">
      <h1>金融</h1>
      <!-- 閉じるボタン -->
      <button id="closeButton" class="exitbtn">✕</button>
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
            <button type="submit"  class="keepbtn">キープする</button>
          </form>
        </li>
      </ol>
    </div>
    <!-- 対応エリア別ランキングをクリックしたときに表示されるモーダル -->
    <div id="areaRank">
      <h1>関東エリアのエージェンシー企業ランキング</h1>
      <!-- 閉じるボタン -->
      <button id="closeButton" class="exitbtn">✕</button>
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
  <?php include (dirname(__FILE__) . "/student_footer.php");?>
  <script src="student.js"></script>
</body>
</html>