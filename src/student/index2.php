<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Top画面</title>
</head>
<body>
  <?php include (dirname(__FILE__) . "/student_header.php");?>
  <a href="condition_selection.php">こだわり条件から探す</a>
      <!-- お問い合わせ数のランキング
    参考サイト https://qiita.com/mayu_schwarz/items/0ab9eb1ec5166c284bcd-->
  <div>
    <h1>月間ランキング</h1>
    <ol>
      <li>
        <p>会社名</p>
        <p>得意な業種</p>
        <p>対応エリア</p>
        <form action="index2.php" method="POST">
          <input type="hidden" name="agent_id" value="<?php print_r($agent["agent_id"]);?>">
          <input type="submit" value="キープする">
        </form>
      </li>
      <li>
        <p>会社名</p>
        <p>得意な業種</p>
        <p>対応エリア</p>
        <form action="index2.php" method="POST">
          <input type="hidden" name="agent_id" value="<?php print_r($agent["agent_id"]);?>">
          <input type="submit" value="キープする">
        </form>
      </li>
      <li>
        <p>会社名</p>
        <p>得意な業種</p>
        <p>対応エリア</p>
        <form action="index2.php" method="POST">
          <input type="hidden" name="agent_id" value="<?php print_r($agent["agent_id"]);?>">
          <input type="submit" value="キープする">
        </form>
      </li>
    </ol>
  <div>
  <div>
    <!-- h1→就活エージェンと検索ページみたいな見出しが本来のh1タグ
    →その中に、同列の～ランキングがある→h2
    h1がないデザインは望ましくない。本の表紙がない状態
    -->
    <h2>業種別ランキング</h2>
    <ul>
      <li><a href="#industryRank">金融</a></li>
      <li><a href="#industryRank">IT</a></li>
      <li><a href="#industryRank">広告</a></li>
      <li><a href="#industryRank">商社</a></li>
      <li><a href="#industryRank">食品</a></li>
      <li><a href="#industryRank">不動産</a></li>
    </ul>
    <h2>求人エリア別ランキング</h2>
    <ul>
      <li><a href="#areaRank">関東</a></li>
      <li><a href="#areaRank">関西</a></li>
      <li><a href="#areaRank">東海</a></li>
      <li><a href="#areaRank">九州</a></li>
    </ul>
  </div>
  <?php include (dirname(__FILE__) . "/student_footer.php");?>
</body>
</html>