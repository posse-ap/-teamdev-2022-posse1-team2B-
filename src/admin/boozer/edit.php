<?php
require("../../dbconnect.php");
// if(isset($_GET['id'])) {
  if(isset($_POST['edit_completion'])){
    $id = $_POST['agent_id'];
    echo $id;
    // トランザクション開始
    $db->beginTransaction();
    try {
      $new_agent_name = $_POST["new_agent_name"];
      $stmt = $db->prepare('UPDATE agents SET agent_name = :new_agent_name WHERE id = :id');
      // $stmt = $db->prepare('UPDATE agents SET agent_name = :new_agent_name WHERE id = 1');
      $stmt->bindValue(':id', $id);
      $stmt->bindParam(':new_agent_name', $new_agent_name);
      $stmt->execute();
      $res = $db->commit();
      } catch(PDOException $e) {
    // 	// エラーが発生した時トランザクションが開始したところまで巻き戻せる
      $db->rollBack();
      echo "エラーが発生しました";
    }
      // 更新に成功したらサンクスページへ遷移する
    if( $res ) {
    ?>
        <script language="javascript" type="text/javascript">
          window.location = './thanks.php';
        </script>
        <?php
        exit;
    }
  }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>edit</title>
</head>
<body>
  <?php include (dirname(__FILE__) . "/boozer_header.php");?>
  <h2>掲載内容修正</h2>
  <form action="" method="POST">
    <dd>会社名</dd><dt><input type="text" name="new_agent_name"></dt>
    <dd>郵便番号</dd><dt><input type="text" name="new_post_number" pattern="\d{3}-?\d{4}"></dt>
    <dd>都道府県</dd><dt><input type="text" name="new_prefecture"></dt>
    <dd>市区町村</dd><dt><input type="text" name="new_municipalitie"></dt>
    <dd>町域・番地</dd><dt><input type="text" name="new_address_number"></dt>
    <!-- <dd>掲載期間</dd><dt><input type="number" name=""></dt>
          掲載期間、アイコン画像、備考→agentsテーブルに入ってないけど、どうする？-->
    <!-- <dd>アイコン画像</dd><dt><input type="file" name="new_image"></dt> -->
    <dd>備考</dd><dt><textarea name="new_remarks" id="" cols="30" rows="10"></textarea></dt>
    <input type="hidden" name="agent_id" value= "<?php echo $_POST['agent_id']; ?>">
    <input name="edit_completion" type="submit" value="修正完了">
  </form>
  <?php include (dirname(__FILE__) . "/boozer_footer.php");?>
</body>
</html>

