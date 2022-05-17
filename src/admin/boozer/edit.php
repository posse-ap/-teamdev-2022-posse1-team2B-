<?php
require("../../dbconnect.php");
//   if(isset($_GET['agent_name'])){
//   $agent_name = $_GET['agent_name'];
//   $stmt = $db->prepare('SELECT id FROM agents WHERE agent_name = :agent_name');
//   $stmt->bindValue(':agent_name', "$agent_name", PDO::PARAM_STR);
//   $stmt->execute();
//   $agent_id = $stmt->fetch();
//   echo $agent_id["id"];
// }
//   if(isset($_POST["edit"])) {
//     // トランザクション開始
// 		$db->beginTransaction();
//     try{
//       $new_agent_name = $_POST["new_agent_name"];
//       $new_post_number = $_POST["new_post_number"];
//       $new_prefecture = $_POST["new_prefecture"];
//       $new_municipalitie = $_POST["new_municipalitie"];
//       $new_address_number = $_POST["new_address_number"];
//       // echo $new_agent_name;
//       // echo $new_post_number;
//       // echo $new_prefecture;
//       // echo $new_municipalitie;
//       // echo $new_address_number;
//       // $new_remarks = $_POST["new_image"];
//       // $new_remarks = $_POST["new_remarks"];
//       // echo $agent_name; クエリ文字取得
//       // 表示されているエージェンシー企業名と同じエージェンシ企業を取得

//       // $stmt = $db->prepare('UPDATE agents SET agent_name = :new_agent_name, post_number = :new_post_number, prefecture = :new_prefecture, municipalitie = :new_municipalitie, adress_number = :new_address_number WHERE id = :id');
//       // // $stmt = $db->prepare('UPDATE agents SET agent_name = :new_agent_name, post_number = :new_post_number, prefecture = :new_prefecture, municipalitie = :new_municipalitie, adress_number = :new_address_number WHERE id =:id');
//       // $stmt = $db->prepare('UPDATE agents SET agent_name = :new_agent_name WHERE id = :id');
//       $stmt = $db->prepare('UPDATE agents SET agent_name = :new_agent_name WHERE id = :id');
//       $stmt->bindValue(':id', $agent_id['id'], PDO::PARAM_INT);
//       $stmt->bindParam(':new_agent_name', $new_agent_name, PDO::PARAM_STR);
//       // // $stmt->bindValue(':agent_name', "0120123456");
//       // // $stmt->bindParam(':rikunabi', $agent_name);
//       // // // $stmt->bindValue(':agent_name', $agent_name);
//       // $stmt->bindParam(':new_agent_name', $new_agent_name);
//       // // $stmt->bindParam(':new_post_number', $new_post_number);
//       // // $stmt->bindParam(':new_prefecture', $new_prefecture);
//       // // $stmt->bindParam(':new_municipalitie', $new_municipalitie);
//       // // $stmt->bindParam(':new_address_number', $new_address_number);
//       $stmt->execute();
//       // コミット
// 			$res = $db->commit();
//       // // $agency_information = $stmt->fetchAll();
//       // print_r($agency_information[0]["agent_name"]);
//       // var_dump($agency_information[0]);
//       // exit();
//     }
//   catch(PDOException $e){
//     //トランザクション取り消し（ロールバック）
//     $dbh->rollBack();
//     print('Error:'.$e->getMessage());
//     echo "<p>登録失敗</p>";
//     die();
//   }
// }
$id = $_GET['id'];
if(isset($_POST['edit'])){
// トランザクション開始
$db->beginTransaction();
try {
  $new_agent_name = $_POST["new_agent_name"];
  $new_post_number = $_POST["new_post_number"];
  $new_prefecture = $_POST["new_prefecture"];
  $new_municipalitie = $_POST["new_municipalitie"];
  $new_address_number = $_POST["new_address_number"];
  $stmt = $db->prepare('UPDATE agents SET agent_name = :new_agent_name, post_number = :new_post_number, prefecture = :new_prefecture, municipalitie = :new_municipalitie, adress_number = :new_address_number WHERE id = :id');
  $stmt->bindValue(':id', $id);
  $stmt->bindParam(':new_agent_name', $new_agent_name);
  $stmt->bindParam(':new_agent_name', $new_agent_name);
  $stmt->bindParam(':new_post_number', $new_post_number);
  $stmt->bindParam(':new_prefecture', $new_prefecture);
  $stmt->bindParam(':new_municipalitie', $new_municipalitie);
  $stmt->bindParam(':new_address_number', $new_address_number);
  $stmt->execute();
  // コミット
  $res = $db->commit();
  } catch(Exception $e) {
	// エラーが発生した時はロールバック
	$pdo->rollBack();
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
  <h2>掲載内容修正</h2>
  <form action="./edit.php" method="POST">
    <dd>会社名</dd><dt><input type="text" name="new_agent_name"></dt>
    <dd>郵便番号</dd><dt><input type="text" name="new_post_number" pattern="\d{3}-?\d{4}"></dt>
    <dd>都道府県</dd><dt><input type="text" name="new_prefecture"></dt>
    <dd>市区町村</dd><dt><input type="text" name="new_municipalitie"></dt>
    <dd>町域・番地</dd><dt><input type="text" name="new_address_number"></dt>
    <!-- <dd>掲載期間</dd><dt><input type="number" name=""></dt>
          掲載期間、アイコン画像、備考→agentsテーブルに入ってないけど、どうする？-->
    <!-- <dd>アイコン画像</dd><dt><input type="file" name="new_image"></dt> -->
    <dd>備考</dd><dt><textarea name="new_remarks" id="" cols="30" rows="10"></textarea></dt>
    <input name="edit" type="submit">修正完了</input>
  </form>
</body>
</html>

