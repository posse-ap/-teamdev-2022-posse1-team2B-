<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>お問い合わせ入力</title>
</head>
<body>
  <?php include (dirname(__FILE__) . "/student_header.php");?>
  <h1>企業に問い合わせる</h1>
  <div>
    <div>申し込み先企業：<?php $agency?></div>
    <form>
      <div>
        <label for="familyName">氏</label>
        <input type="text" name="family_name" id="familyName" required>
      </div>
      <div>
        <label for="studentName">名</label>
        <input type="text" name="student_name" id="studentName" required>
      </div>
      <div>
        <label for="familyNameKana">氏(カナルビ)</label>
        <input type="text" name="family_name_kana" id="familyNameKana" pattern="(?=.*?[\u30A1-\u30FA])[\u30A1-\u30FC]*" required>
      </div>
      <div>
        <label for="studentNameKana">名(カナルビ)</label>
        <input type="text" name="student_name_kana" id="studentNameKana" pattern="(?=.*?[\u30A1-\u30FA])[\u30A1-\u30FC]*" required>
      </div>
      <div>
        <label for="telephoneNumber">電話番号</label>
        <input type="tel" name="telephone_number" id="telephoneNumber" pattern="\d{2,4}-?\d{2,4}-?\d{3,4}" maxlength="11" required>
      </div>
      <div>
        <label for="emailAddress">メールアドレス</label>
        <input type="email" name="email_address" id="emailAddress" required>
      </div>
      <div>
        <label for="almaMater">出身大学</label>
        <input type="text" name="alma_mater" id="almaMater" required>
      </div>
      <div>
        <label for="faculty">学部</label>
        <input type="text" name="faculty" id="faculty" required>
      </div>
      <div>
        <label for="department">学科</label>
        <input type="text" name="department" id="department" required>
      </div>
      <div>
        <p>卒業年を選択</p>
        <select>
          <option value="2024">2024年</option>
          <option value="2025">2025年</option>
        </select>
      </div>
      <div>
        <label for="inquiry">エージェンシー企業へのお問い合わせ内容</label>
        <span>※複数企業にお問い合わせする場合、全ての企業に同一の記入したお問い合わせ内容が送信されます</span>
        <input type="text" name="inquiry" id="inquiry" required>
      </div>
      <div>
        <button>戻る</button>
        <button>エージェンシー企業に問い合わせる</button>
      </div>
    </form>
  </div>

  <?php include (dirname(__FILE__) . "/student_footer.php");?>
</body>
</html>