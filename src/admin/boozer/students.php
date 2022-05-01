<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <section>
    <h2>学生一覧</h2>
    <?php 
      $months = [1,2,3,4,5,6,7,8,9,10,11,12];
      foreach ($months as $key => $month) : ?>
      <button><?= $month;?> </button>
    <?php endforeach;?>
    
    <?php
      foreach ($hoges as $hoge) : ?>
      学生のデータを問い合わせぶん回す
    <div>
      <span><?= $hoge ?></span>
      <span><?= $hoge ?></span>
      <span><?= $hoge ?></span>
      <span><?= $hoge ?></span>
      <dd>申込みエージェント</dd><dt><?= $hoge ?></dt>
    </div>
    <?php endforeach; ?>
  </section>

  <section>
    <button>☓</button>
    <dd>名前</dd><dt><?= $student_name ?></dt>
    <dd>カナ</dd><dt></dt>
    <dd>電話番号</dd><dt><?= $student_tel_number ?></dt>
    <dd>メールアドレス</dd><dt><?= $student_email ?></dt>
    <dd>出身大学</dd><dt><?= $college_name ?></dt>
    <dd>学部</dd><dt><?= $college_department ?></dt>
    <dd>学科</dd><dt><?= $college_ ?></dt>
    <dd>卒業年</dd><dt><?= $graduation_year ?></dt>
    <dd>お問い合わせ内容</dd><dt><?= $student_text ?></dt>
  </section>

</body>
</html>