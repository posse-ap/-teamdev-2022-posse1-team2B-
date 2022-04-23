<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>新規作成画面</title>
</head>
<body>
  <!-- <?php include (dirname(__FILE__) . "/agency_header.php");?> -->
  <h1>掲載内容新規作成</h1>
  <div>
    <form>
        <div>
            <label action="createcontents.php" method="GET" for="companyName">会社名<span>必須</span></label>
            <input type="text" name="company_name" id="companyName" required>
        </div>
      <button type="submit">作成完了</button>
    </form>
  </div>
  <!-- <?php include (dirname(__FILE__) . "/agency_footer.php");?> -->
</body>
</html>