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
  <button>こだわり条件から探す</button>
      <!-- お問い合わせ数のランキング
    参考サイト https://qiita.com/mayu_schwarz/items/0ab9eb1ec5166c284bcd-->
  <div>
    <h1>月間ランキング</h1>
    <ol>
      <li>
        <p>会社名</p>
        <p>得意な業種</p>
        <p>対応エリア</p>
      </li>
      <li>
        <p>会社名</p>
        <p>得意な業種</p>
        <p>対応エリア</p>
      </li>
      <li>
        <p>会社名</p>
        <p>得意な業種</p>
        <p>対応エリア</p>
      </li>
    </ol>
  <div>
  <div>
    <div>
      <h1>業種別ランキング</h1>
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
          <input type="hidden" name="company_name" value="会社名">
          <input type="hidden" name="specialty_industries" value="得意な業種">
          <input type="hidden" name="supported_area" value="対応エリア">
          <input type="submit" value="">
        </form>
      </li>
      <li>        
        <p>会社名</p>
        <p>得意な業種</p>
        <p>対応エリア</p>
        <form action="" method="">
          <input type="hidden" name="company_name" value="会社名">
          <input type="hidden" name="specialty_industries" value="得意な業種">
          <input type="hidden" name="supported_area" value="対応エリア">
          <input type="submit" value="">
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
          <input type="hidden" name="company_name" value="会社名">
          <input type="hidden" name="specialty_industries" value="得意な業種">
          <input type="hidden" name="supported_area" value="対応エリア">
          <input type="submit" value="">
        </form>
      </li>
      <li>        
        <p>会社名</p>
        <p>得意な業種</p>
        <p>対応エリア</p>
        <form action="" method="">
          <input type="hidden" name="company_name" value="会社名">
          <input type="hidden" name="specialty_industries" value="得意な業種">
          <input type="hidden" name="supported_area" value="対応エリア">
          <input type="submit" value="">
        </form>
      </li>
    </ol>
  </div>
  <!-- こだわり条件から探すをクリックした場合に表示されるモーダル -->
  <div>
    <button>✕</button>
    <form action="" method="">
      <h1>エージェンシー企業をこだわり条件で絞り込みする</h1>
      <div>
        <div>
          <h2>会社の得意業界</h2>
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
        <div>
          <h2>登録企業の規模</h2>
          <input type="checkbox" name="smaller_businesses" id="smallerBusinesses">
          <label from="smallerBusinesses">中小企業</label>
          <input type="checkbox" name="big_businesses" id="bigBusinesses">
          <label from="bigBusinesses">大企業</label>
          <input type="checkbox" name="venture_corporation" id="ventureCorporation">
          <label from="ventureCorporation">ベンチャー企業</label>
        </div>
        <div>
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
        <div>
          <h2>対象学生</h2>
          <input type="checkbox" name="2024_graduation" id="2024_graduation">
          <label from="kantoRegion">24卒</label>
          <input type="checkbox" name="kansai_region" id="2025_graduation">
          <label from="kansaiRegion">25卒</label>
        </div>
      </div>
      <button type="submit">検索</button>
    </form>

  </div>
  <?php include (dirname(__FILE__) . "/student_footer.php");?>
</body>
</html>