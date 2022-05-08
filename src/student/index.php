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
  <div> <!-- TOP画面 -->
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
            <button type="submit">キープする</button>
          </form>
        </li>
        <li>
          <p>会社名</p>
          <p>得意な業種</p>
          <p>対応エリア</p>
          <form action="index2.php" method="POST">
            <input type="hidden" name="agent_id" value="<?php print_r($agent["agent_id"]);?>">
            <button type="submit">キープする</button>
          </form>
        </li>
        <li>
          <p>会社名</p>
          <p>得意な業種</p>
          <p>対応エリア</p>
          <form action="index2.php" method="POST">
            <input type="hidden" name="agent_id" value="<?php print_r($agent["agent_id"]);?>">
            <button type="submit">キープする</button>
          </form>
        </li>
      </ol>
    </div>
    <div>
      <h2>業種別ランキング</h2>
      <ul>
        <li><a href="#industryRank" class="industry_rank" data-value="金融">金融</a></li>
        <!--選択したaタグによって、金融かITかとかどうやって分ける？
          data-valueでvalue値を設定しておいてJSで取得する？
        https://teratail.com/questions/111346
        -->
        <li><a href="#industryRank" class="industry_rank" data-value="IT">IT</a></li>
        <li><a href="#industryRank" class="industry_rank" data-value="広告">広告</a></li>
        <li><a href="#industryRank" class="industry_rank" data-value="商社">商社</a></li>
        <li><a href="#industryRank" class="industry_rank" data-value="食品">食品</a></li>
        <li><a href="#industryRank" class="industry_rank" data-value="不動産">不動産</a></li>
      </ul>
      <h2>求人エリア別ランキング</h2>
      <ul>
        <li><a href="#areaRank">関東</a></li>
        <li><a href="#areaRank">関西</a></li>
        <li><a href="#areaRank">東海</a></li>
        <li><a href="#areaRank">九州</a></li>
      </ul>
    </div>
  </div>
  <div>
  <!-- 業種別ランキングをクリックした時に表示されるモーダル -->
  <div id="industryRank">
    <h1>金融</h1>
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
</body>
</html>