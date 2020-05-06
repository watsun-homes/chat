<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="UTF-8">
    <title>Untitled Document</title>
	<meta name="Author" content=""/>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    
    <?php 
    
    $my_sea=htmlspecialchars($_POST["s"], ENT_QUOTES);
    $dsn= "mysql:host=localhost;port=3306;dbname=db;charset=utf8"; 
    $db = new PDO($dsn,"root","");
    
    print "<p style='font-size:20pt'>「{$my_sea}」の検索結果</p>";
    $ps=$db->query("SELECt * FROM tb WHERE mes like '%$my_sea%'");
    while($r = $ps->fetch()){
        print "{$r['nam']} {$r['dat']}<br>".nl2br($r['mes'])."<hr>";
    }
    print "<p><a href='home.php'>一覧表示へ</a></p>";
    
    ?>
    
    <footer>
    <!--フッター固定ナビ-->
    <div id="footerFloatingMenu">
        <div class="ffm">
        <a href="home.php"><p>ホーム</p></a>
        <a href="search.php"><p>検索</p></a>
        <a href="home.php"><p>掲示板</p></a>
        <a href="https://watsunblog.com/"><p>ブログ</p></a>
        </div>
    </div>
    <!--フッター固定ナビ終わり-->
    </footer>



</body>
</html>
