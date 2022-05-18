<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/index.css">
  <title>お問い合わせ入力</title>
</head>
<body>
  <?php include (dirname(__FILE__) . "/student_header.php");?>
  <!-- 確認画面 -->
  <div>
    <h1>お問い合わせ内容を確認</h1>
    <form method="POST" action="../thanks.php">
      <div>
        <label>氏</label>
        <p><?php echo $_POST["family_name"];?></p>
      </div>
      <div>
        <label>名</label>
        <p><?php echo $_POST["student_name"];?></p>
      </div>
      <div>
        <label>氏(カナルビ)</label>
        <p><?php echo $_POST["family_name_kana"];?></p>
      </div>
      <div>
        <label>名(カナルビ)</label>
        <p><?php echo $_POST["student_name_kana"];?></p>
      </div>
      <div>
        <label>電話番号</label>
        <p><?php echo $_POST["telephone_number"];?></p>
      </div>
      <div>
        <label>メールアドレス</label>
        <p><?php echo $_POST["email_address"];?></p>
      </div>
      <div>
        <label>出身大学</label>
        <p><?php echo $_POST["alma_mater"];?></p>
      </div>
      <div>
        <label>学部</label>
        <p><?php echo $_POST["faculty"];?></p>
      </div>
      <div>
        <label>学科</label>
        <p><?php echo $_POST["department"];?></p>
      </div>
    <!-- 入力した値を受け渡す -->
      <button type="submit" name="btn_back" formaction="./contact.php" class="returnbtn">戻る</button>
      <button type="submit" name="contact" class="inquirybtn">登録完了</button>
      <input type="hidden" name="family_name" value="<?php echo $_POST['family_name']; ?>">
      <input type="hidden" name="student_name" value="<?php echo $_POST['student_name']; ?>">
      <input type="hidden" name="family_name_kana" value="<?php echo $_POST['family_name_kana']; ?>">
      <input type="hidden" name="student_name_kana" value="<?php echo $_POST['student_name']; ?>">
      <input type="hidden" name="telephone_number" value="<?php echo $_POST['telephone_number']; ?>">
      <input type="hidden" name="email_address" value="<?php echo $_POST['email_address']; ?>">
      <input type="hidden" name="alma_mater" value="<?php echo $_POST['alma_mater']; ?>">
      <input type="hidden" name="faculty" value="<?php echo $_POST['faculty']; ?>">
      <input type="hidden" name="department" value="<?php echo $_POST['department']; ?>">
    </form>
  </div>
  
  
  <!-- 問い合わせ入力画面 -->
  <div>
    <h1>企業に問い合わせる</h1>
    <div>申し込み先企業：<?php $agency?></div>
    <form action="./thanks.php" method="POST">

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
        <button class="returnbtn">戻る</button>
        <button type="submit" class="inquirybtn">エージェンシー企業に問い合わせる</button>
      </div>
    </form>
    <button type="button" class="returnbtn">戻る</button>
  </div>
  <?php include (dirname(__FILE__) . "/student_footer.php");?>
</body>
</html>