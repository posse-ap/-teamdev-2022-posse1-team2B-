<?php
  require('../../dbconnect.php');
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="./agency.css">
</head>
<body>
<?php include (dirname(__FILE__) . "/agency_header.php");?>
  <section>
    <h2>学生一覧</h2>
    <?php
      // 指定したエージェンシー企業の学生の情報をDBから取得
      // →中間テーブルからデータを持ってくるやり方が分からない、、、
      // select * from agentsテーブル名 inner join 中間テーブル名 on agentテーブル名.id = 中間テーブル名.agent_id inner join studentsテーブル名 on 中間テーブル名_id = studentsテーブル名.id;
      // select * from agents inner join intermediate on agents.id = intermediate. agent_id inner join students on intermediate.student_id = students.id;
      // →これじゃないの？？？？？？？？？？？？

      // 日本語文字化けする、、、、、、どうすれば良いか分かる？調べて出てきたのは、dbconnect.phpでutfを設定しろ。もうやってるよね

      // foreach ($hoges as $index => $hoge) : ?>
    <div>
      <!-- <a class="student_detail" href="students.php?id=<?php //echo $hoge["student_id"] ?>"> -->
        <!-- こんなやり方で良いの、、？？？  -->
      <a class="student_detail" href="students.php?id=1">
        <span>田中花子</span>
        <span>慶應</span>
        <span>経済学部</span>
        <span>3月12日12時</span>
        <dd>申込みエージェント</dd><dt><?php //echo $hoge ?></dt>
      </a>
    </div>
    <?php //endforeach; ?>
    <a href="./index.php">戻る</a>
  </section>

  <section id="studentInformation" class="student_information">

  <?php 
    $id=$_GET["id"];
    $stmt =$db->prepare("SELECT * FROM students WHERE id= :id");
    $stmt->bindValue(":id", $id);
    $stmt->execute();
    $student = $stmt->fetch();
    $college_id = $student["coledge_id"];
    $stmt = $db->prepare("SELECT * FROM colleges WHERE id =:college_id");
    $stmt->bindValue(":college_id", $id);
    $stmt->execute();
    $college = $stmt->fetch();
  ?>
    <button id="studentInformationCloseButton">☓</button>
    <dd>名前</dd><dt><?= $student["student_name"]; ?></dt>
    <dd>カナ</dd><dt></dt>
    <dd>電話番号</dd><dt><?= $student["tel_number"]; ?></dt>
    <dd>メールアドレス</dd><dt><?= $student["email"]; ?></dt>
    <dd>出身大学</dd><dt><?= $college["college_name"]; ?></dt>
    <dd>学部</dd><dt><?= $student["undergraduate"]; ?></dt>
    <dd>学科</dd><dt><?= $student["college_department"]; ?></dt>
    <dd>卒業年</dd><dt><?= $student["graduation_year"]; ?></dt>
    <dd>お問い合わせ内容</dd><dt><?php //お問い合わせ内容ってテーブルになくない？？？？？？？？？？？？？？ ?></dt>
    <a href="./students.php">戻る</a>
    <button>いたずらをboozerに報告</button>
  </section>
  <?php include (dirname(__FILE__) . "/agency_footer.php");?>
  <script src="./agency.js"></script>
</body>
</html>