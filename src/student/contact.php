<?php 

require('../dbconnect.php');

if(isset(
  // これらが入力されていたら
  $_POST['student_last_name'], 
  $_POST['student_first_name'], 
  $_POST['student_last_name_kana'], 
  $_POST['student_first_name_kana'], 
  $_POST['post_number'], 
  $_POST['prefecture'], 
  $_POST['municipality'], 
  $_POST['adress_number'],
  $_POST['tel_number'], 
  $_POST['email'], 
  $_POST['college_name'], 
  $_POST['undergraduate'], 
  $_POST['college_department'],
  $_POST['graduation_year']
  )){
  // $student_last_name = $db->exec('INSERT INTO students SET student_last_name = '. $_POST['student_last_name']);

  // データの保存
  // sql文書きます
  $stmt = $db->prepare('insert into students 
  (
    student_last_name, 
    student_first_name, 
    student_last_name_kana, 
    student_first_name_kana, 
    post_number,
    prefecture,
    municipality,
    adress_number,
    tel_number,
    email,
    college_name,
    undergraduate,
    college_department,
    graduation_year
  ) 
  values
  (
    :student_last_name,
    :student_first_name,
    :student_last_name_kana,
    :student_first_name_kana,
    :post_number,
    :prefecture,
    :municipality,
    :adress_number,
    :tel_number,
    :email,
    :college_name,
    :undergraduate,
    :college_department,
    :graduation_year
  )');
  
// ポストを定数に置いて
  $student_last_name = $_POST['student_last_name']; 
  $student_first_name = $_POST['student_first_name'];
  $student_last_name_kana = $_POST['student_last_name_kana'];
  $student_first_name_kana = $_POST['student_first_name_kana']; 
  $post_number = $_POST['post_number']; 
  $prefecture = $_POST['prefecture']; 
  $municipality = $_POST['municipality']; 
  $adress_number = $_POST['adress_number']; 
  $tel_number = $_POST['tel_number']; 
  $email = $_POST['email']; 
  $college_name = $_POST['college_name']; 
  $undergraduate = $_POST['undergraduate']; 
  $college_department = $_POST['college_department']; 
  $graduation_year = $_POST['graduation_year'];

// ：〇〇と上の変数をつなげる＄param = array()で配列を作る
  $param = array(
    ':student_last_name'=>$student_last_name,
    ':student_first_name'=>$student_first_name,
    ':student_last_name_kana'=>$student_last_name_kana,
    ':student_first_name_kana'=>$student_first_name_kana,
    ':post_number'=>$post_number,
    ':prefecture'=>$prefecture,
    ':municipality'=>$municipality,
    ':adress_number'=>$adress_number,
    ':tel_number'=>$tel_number,
    ':email'=>$email,
    ':college_name'=>$college_name,
    ':undergraduate'=>$undergraduate,
    ':college_department'=>$college_department,
    ':graduation_year'=>$graduation_year
  );

  // その配列をexecute
  $stmt->execute($param);

  }





?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>お問い合わせ入力</title>
</head>
<body>
  <!-- <?php include (dirname(__FILE__) . "/student_header.php");?> -->
  
  <!-- 問い合わせ入力画面 -->
  <div>
    <h1>企業に問い合わせる</h1>
    <div>申し込み先企業：<?php $agency?></div>
    <form action="contact.php" method="POST">

      <div>
        <label for="familyName">氏</label>
        <input type="text" name="student_last_name" id="familyName" required>
      </div>
      <div>
        <label for="studentName">名</label>
        <input type="text" name="student_first_name" id="studentName" required>
      </div>
      <div>
        <label for="familyNameKana">氏(カナルビ)</label>
        <input type="text" name="student_first_name_kana" id="familyNameKana" pattern="(?=.*?[\u30A1-\u30FA])[\u30A1-\u30FC]*" required>
      </div>
      <div>
        <label for="studentNameKana">名(カナルビ)</label>
        <input type="text" name="student_last_name_kana" id="studentNameKana" pattern="(?=.*?[\u30A1-\u30FA])[\u30A1-\u30FC]*" required>
      </div>
      <div>
        <label for="postNumber">郵便番号</label>
        <input type="text" name="post_number" id="postNumber" maxlength="7" required>
      </div>
      <div>
        <label for="prefecture">都道府県</label>
        <input type="text" name="prefecture" id="prefecture" required>
      </div>
      <div>
        <label for="prefecture">市区町村</label>
        <input type="text" name="municipality" id="municipality" required>
      </div>
      <div>
        <label for="adressNumber">番地</label>
        <input type="text" name="adress_number" id="adress_number" required>
      </div>
      <div>
        <label for="telephoneNumber">電話番号</label>
        <input type="tel" name="tel_number" id="telephoneNumber" pattern="\d{2,4}-?\d{2,4}-?\d{3,4}" maxlength="11" required>
      </div>
      <div>
        <label for="emailAddress">メールアドレス</label>
        <input type="email" name="email" id="emailAddress" required>
      </div>
      <div>
        <label for="almaMater">出身大学</label>
        <input type="text" name="college_name" id="almaMater" required>
      </div>
      <div>
        <label for="faculty">学部</label>
        <input type="text" name="undergraduate" id="faculty" required>
      </div>
      <div>
        <label for="department">学科</label>
        <input type="text" name="college_department" id="department" required>
      </div>
      <div>
        <p>卒業年を選択</p>
        <input type="text" name="graduation_year" id="graduationYear" maxlength="4"required>
        <!-- <select>
          <option value="2024">2024年</option>
          <option value="2025">2025年</option>
        </select> -->
      </div>
      <!-- <div>
        <label for="inquiry">エージェンシー企業へのお問い合わせ内容</label>
        <span>※複数企業にお問い合わせする場合、全ての企業に同一の記入したお問い合わせ内容が送信されます</span>
        <input type="text" name="inquiry" id="inquiry" required>
      </div> -->
      <div>
        <button>戻る</button>
        <input type="submit" value="エージェントに問い合わせる">
      </div>
    </form>
  </div>
  <!-- <?php include (dirname(__FILE__) . "/student_footer.php");?> -->
</body>
</html>