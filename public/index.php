<html>
<head><title>postgresql_view.php</title></head>
<body>
<?php

  // PostgreSQL 接続をオープンする
  $dbconn = pg_connect("port=5432 user=bqdhlbwcsjgonq password=b8465044fc303f8a7c8ce93bf0098307705354a25653f10fa105e6f6292fab0f dbname=dcvn917vl095i4");
  // SQL文の作成
  $sql = "SELECT product_no, product_name, price FROM products WHERE product_name = $1";
  // SQLとパラメータを分割して実行
  $result = pg_query_params($dbconn, $sql, array($_POST['product_name']));
  
  // SQL実行結果の行数を返す
  $cnt = pg_numrows($result);
  print("$cnt 件ヒットしました。<br />");
  
  for ($i = 0; $i < $cnt; $i++) {
    // 実行結果のi行目の行情報を取り出す
    $row = pg_fetch_row($result, $i);
    print("product_no：$row[0] product_name：$row[1] price：$row[2]");
  }

  // PostgreSQL 接続をクローズする
  pg_close($dbconn);

?>
</body>
</html>
