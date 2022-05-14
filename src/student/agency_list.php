<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <!-- 業種別ランキングをクリックした時に表示されるモーダル -->
  <div id="industryRank">
    <h1 id="industryRankTitle"></h1>
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
</body>
</html>