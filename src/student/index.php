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
  <link rel="stylesheet" href="student.css">
</head>
<body>
  <?php include (dirname(__FILE__) . "/student_header.php");?>
  <div> <!-- TOP画面 -->
    <a href="condition_selection.php">こだわり条件から探す</a>
        <!-- お問い合わせ数のランキング
      参考サイト https://qiita.com/mayu_schwarz/items/0ab9eb1ec5166c284bcd-->
    <div>
      <h1>月間ランキング</h1>
      <ul>
        <?php
        $counter = 0;
        foreach($agents as $index => $agent): ?>
        <li>
          <p><?= $agent['agent_name']?></p>
          <p>得意な業種<?= $agent['category']?></p>
          <p>対応エリア<?= $agent['prefecture']?></p>
          <form action="index2.php" method="POST">
            <input type="hidden" name="agent_id" value="<?php print_r($agent["agent_id"]);?>">
            <button type="submit">キープする</button>
          </form>
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
                  <!--選択したaタグによって、金融かITかとかどうやって分ける？
            data-valueでvalue値を設定しておいてJSで取得する？
          https://teratail.com/questions/111346
          -->
          <li><input type="submit" name="finance" value="金融"></li>
          <li><input type="submit" name="it" value="IT"></li>
          <li><input type="submit" name="ad" value="広告"></li>
          <li><input type="submit" name="tradingCompany" value="商社"></li>
          <li><input type="submit" name="food" value="食品"></li>
          <li><input type="submit" name="realEstate" value="不動産"></li>
          <!-- <li><a href="agency_list.php#industryRank" id="finance" data-value="金融">金融</a></li>
          <li><a href="agency_list.php#industryRank" id="it" data-value="IT">IT</a></li>
          <li><a href="agency_list.php#industryRank" id="ad" data-value="広告">広告</a></li>
          <li><a href="agency_list.php#industryRank" id="tradingCompany" data-value="商社">商社</a></li>
          <li><a href="agency_list.php#industryRank" id="food" data-value="食品">食品</a></li>
          <li><a href="agency_list.php#industryRank" id="realEstate" data-value="不動産">不動産</a></li> -->
        </ul>
        <h2>求人エリア別ランキング</h2>
        <ul>
          <li><a href="agency_list.php#areaRank" class="area_rank" data-value="関東">関東</a></li>
          <li><a href="agency_list.php#areaRank" class="area_rank" data-value="関西">関西</a></li>
          <li><a href="agency_list.php#areaRank" class="area_rank" data-value="東海">東海</a></li>
          <li><a href="agency_list.php#areaRank" class="area_rank" data-value="九州">九州</a></li>
        </ul>
      </form>
    </div>
  </div>
  <?php include (dirname(__FILE__) . "/student_footer.php");?>
  <script src="student.js"></script>
</body>
</html>