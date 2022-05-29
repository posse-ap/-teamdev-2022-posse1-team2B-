<?php
require('../dbconnect.php');
$keeps=array();
session_start();
if(isset($_SESSION['keep']) && $_SESSION['time'] + 60 * 60 * 24  > time()){
  $keeps=$_SESSION['keep'];
  $_SESSION['time'] = time();
} else {
  session_destroy();
}
// キープされていた企業を一括申し込み
// →学生の情報をstudentsテーブルに挿入するのは朝香ちゃんが実装済み
// →intermediateテーブルに学生と企業のIDの情報を追加できればいい
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

// $param = array(
//   ':post_number' => $post_number,
//   ':tel_number' => $tel_number,
//   ':email' => $email,
//   ':graduation_year' => $graduation_year
// );
$param = array(
  ':student_last_name' => $student_last_name,
  ':student_first_name' => $student_first_name,
  ':student_last_name_kana' => $student_last_name_kana,
  ':student_first_name_kana' => $student_first_name_kana,
  ':post_number' => $post_number,
  ':prefecture' => $prefecture,
  ':municipality' => $municipality,
  ':adress_number' => $adress_number,
  ':tel_number' => $tel_number,
  ':email' => $email,
  ':college_name' => $college_name,
  ':undergraduate' => $undergraduate,
  ':college_department' => $college_department,
  ':graduation_year' => $graduation_year
);
if(isset($_POST['final_contact'])){
    // echo '!111';
  foreach($keeps as $index => $keep){
    $stmt = $db->prepare('SELECT * FROM agents WHERE id = :id');
    $stmt->bindValue(':id', $keep);
    $stmt->execute();
    $agent = $stmt->fetch();
    $agent_id = $keep;
    $stmt = $db->prepare('SELECT id FROM students WHERE student_last_name = :student_last_name AND student_first_name = :student_first_name AND student_last_name_kana = :student_last_name_kana AND student_first_name_kana = :student_first_name_kana AND post_number = :post_number AND prefecture = :prefecture AND municipality = :municipality AND adress_number = :adress_number AND tel_number = :tel_number AND email = :email AND college_name = :college_name AND undergraduate = :undergraduate AND college_department = :college_department AND graduation_year = :graduation_year');
    // $stmt = $db->prepare('SELECT id FROM students WHERE post_number = :post_number AND tel_number = :tel_number AND email = :email AND graduation_year = :graduation_year');
    // その配列をexecute
    $stmt->execute($param);
    $student_id = $stmt->fetch();
    $studentId = $student_id[0];
    $stmt = $db->prepare('insert into intermediate (student_id, agent_id) values (:student_id, :agent_id)');
    $stmt->bindValue(':student_id', $studentId);
    $stmt->bindValue(':agent_id', $agent_id);
    $res = $stmt->execute();
      exit; 
    }
}




