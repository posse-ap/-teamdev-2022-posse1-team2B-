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
        <form action="" method="">
          <input type="hidden" name="agent_id" value="<?php ?>">
          <input type="submit" value="キープする">
        </form>
      </li>
      <li>
        <p>会社名</p>
        <p>得意な業種</p>
        <p>対応エリア</p>
        <form action="" method="">
          <input type="hidden" name="agent_id" value="<?php ?>">
          <input type="submit" value="キープする">
        </form>
      </li>
      <li>
        <p>会社名</p>
        <p>得意な業種</p>
        <p>対応エリア</p>
        <form action="" method="">
          <input type="hidden" name="agent_id" value="<?php ?>">
          <input type="submit" value="キープする">
        </form>
      </li>
    </ol>
  <div>
  <div>
    <div>
      <h1>業種別ランキング</h1>
      <!-- 何タグ使うべき？？ -->
      <div>金融</div>
      <div>IT</div>
      <div>広告</div>
      <div>商社</div>
      <div>食品</div>
      <div>不動産</div>
    </div>
    <div>
      <h1>求人エリア別ランキング</h1>
      <div>関東</div>
      <div>関西</div>
      <div>東海</div>
      <div>九州</div>
    </div>
  </div>
  <!-- 業種別ランキングをクリックした時に表示されるモーダル -->
  <div>
    <h1><?php echo $industry?></h1>
    <!-- 閉じるボタン -->
    <button>✕</button>
    <!-- 画面の右端に表示。クリックするとキープ画面に飛ぶ -->
    <a href="./keep.php">キープ中の企業</a>
    <ol>
      <li>        
        <p>会社名</p>
        <p>得意な業種</p>
        <p>対応エリア</p>
        <form action="" method="">
          <input type="hidden" name="agent_id" value="<?php ?>">
          <input type="submit" value="キープする">
        </form>
      </li>
      <li>        
        <p>会社名</p>
        <p>得意な業種</p>
        <p>対応エリア</p>
        <form action="" method="">
          <input type="hidden" name="agent_id" value="<?php ?>">
          <input type="submit" value="キープする">
        </form>
      </li>
    </ol>
  </div>
  <!-- 対応エリア別ランキングをクリックしたときに表示されるモーダル -->
  <div>
    <h1><?php echo $area?>エリアのエージェンシー企業ランキング</h1>
    <!-- 閉じるボタン -->
    <button>✕</button>
    <!-- 画面の右端に表示。クリックするとキープ画面に飛ぶ -->
    <a href="./keep.php">キープ中の企業</a>
    <ol>
    <li>        
        <p>会社名</p>
        <p>得意な業種</p>
        <p>対応エリア</p>
        <form action="" method="">
          <input type="hidden" name="agent_id" value="<?php ?>">
          <input type="submit" value="キープする">
        </form>
    </li>
    <li>        
        <p>会社名</p>
        <p>得意な業種</p>
        <p>対応エリア</p>
        <form action="" method="">
          <input type="hidden" name="agent_id" value="<?php ?>">
          <input type="submit" value="キープする">
        </form>
    </li>
    </ol>
  </div>
  <?php include (dirname(__FILE__) . "/student_footer.php");?>
</body>
</html>