<!-- 学生一覧→詳細
一瞬だけ学生の詳細情報が表示されてすぐに消えてしまう
-->
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
<?php
    //変数の初期化
    // 学生の詳細情報画面や確認画面の表示をスイッチするフラグ
    // 0→詳細画面 1→確認画面
    $page_flag = 0;
    // もしいたずら報告ボタンがおされたら
    // ＝フォームデータの中に$_POST["mischief_report"]が含まれていたら
    // →page_flag変数の値を1にする＝確認画面に表示を変える
    if(isset($_POST["mischief_report"])) {
      $page_flag = 1;
    }
    if ($page_flag === 1):
    ?>
    <!-- 確認画面 -->
    <div>
        <p>本当に取り消し申請を行いますか？</p>
        <p>いたずら・迷惑行為とみなされたお問い合わせのみ取り消されます。</p>
      <!-- 入力した値を受け渡す -->
        <a href="./students.php">戻る</a>
        <a href="../../thanks.php">いたずらを申請する</a>
      </div>
    </div>
    <!-- 学生一覧画面 -->
<?php else: ?>
  <div>
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
      <!-- <a class="student_information" href="students.php?id=<?php //echo $hoge["student_id"] ?>"> -->
      <a  class="student_information" href="students.php?id=1">
        <form></form>
        <span>田中花子</span>
        <span>慶應</span>
        <span>経済学部</span>
        <span>3月12日12時</span>
        <dd>申込みエージェント</dd><dt><?php //echo $hoge ?></dt>
      </a>
      <a  class="student_information" href="students.php?id=2">
        <span>田中花子</span>
        <span>慶應</span>
        <span>経済学部</span>
        <span>3月12日12時</span>
        <dd>申込みエージェント</dd><dt><?php //echo $hoge ?></dt>
      </a>
    </div>
    <?php //endforeach; ?>
    <a href="./index.php">戻る</a> 
  </div>
  <!-- 学生詳細 -->
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
    <div id="studentDetail" class="student_detail">
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
      <form method="POST">
        <button type="submit" name="mischief_report">いたずらをboozerに報告</button>
      </form>
    </div>

  <?php include (dirname(__FILE__) . "/agency_footer.php");?>
  <?php endif; ?>

  <script src="./agency.js"></script>
</body>
</html>