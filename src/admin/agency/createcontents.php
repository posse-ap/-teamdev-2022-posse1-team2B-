<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>掲載内容新規作成</title>
  <link rel="stylesheet" href="./agency.css">
</head>
<body>
  <?php include (dirname(__FILE__) . "/agency_header.php");?>
  <h1>掲載内容新規作成</h1>
    <div>
      <form action="../../thanks.php" method="POST">
          <div>
              <label for="companyName">会社名<span>必須</span></label>
              <input type="text" name="company_name" id="companyName" required>
          </div>
          <div>
              <label for="companyAddress">会社住所<span>必須</span></label>
              <input type="text" name="company_address" id="companyAddress" required>
          </div>
          <div>
              <label for="companyRemarks">備考</label>
              <input type="text" name="company_remarks" id="companyRemarks">
          </div>
          <div>
              <label for="iconImage">アイコン画像</label>
              <input type="file" name="icon_image" id="iconImage"  accept="image/*">
          </div>
          <a href="./index.php">戻る</a>
          <!-- 入力した値を受け渡す -->
          <button type="submit">作成完了</button>
          <input type="hidden" name="company_name" value="<?php if(isset($_POST["company_name"])){ echo $_POST["company_name"];} ?>">
          <input type="hidden" name="company_address" value="<?php if(isset($_POST["company_address"])){ echo $_POST["company_address"];} ?>">
          <input type="hidden" name="company_remarks" value="<?php if(isset($_POST["company_remarks"])){ echo $_POST["company_remarks"];} ?>">
          <input type="hidden" name="icon_image" value="<?php if(isset($_POST["icon_image"])){ echo $_POST["icon_image"];} ?>">
      </form>
    </div>
    <?php include (dirname(__FILE__) . "/agency_footer.php");?>
</body>
<script src="./agency.js"></script>
</html>