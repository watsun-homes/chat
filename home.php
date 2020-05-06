<?php
/*
Template Name: チャット
*/
?>
<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="UTF-8">
    <title>WATSUNCHAT</title>
	<meta name="Author" content=""/>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    
    <header>
    <div class="chat-header">
        <div class="chat-clear">
            <div class="chat-header-title">
        <h1>WATSUNCHAT</h1>
            </div>
         <!--ヘッダーメニュー-->
        <div class="chat-float chat-header-menu">
        <div id="chat-nav-drawer">
      <input id="chat-nav-input" type="checkbox" class="chat-nav-unshown">
      <label id="chat-nav-open" for="chat-nav-input"><span></span></label>
      <label class="chat-nav-unshown" id="chat-nav-close" for="chat-nav-input"></label>
      <div id="chat-nav-content">
    <form action="" method="post">
        名前
        <div><input type="text" name="n"></div>
        メッセージ
        <div><textarea name="m"></textarea></div>
        
        <div class="chat-submit">
        <input type="submit" value="送信">
        </div>
    </form> 
            </div>
        </div>
        </div>
      <!--ヘッダーメニュー-->
        </div> 
    </div>
    </header>
    
    
    <div class="chat-contain">
        

    <!--DBに書き込み-->
    <?php
    if(isset($_POST['n'])) {
        
$my_nam=htmlspecialchars($_POST["n"], ENT_QUOTES);
$my_mes=htmlspecialchars($_POST["m"], ENT_QUOTES);
$dsn= "mysql:host=localhost;port=3306;dbname=db;charset=utf8";   
    
    try{
        
$db = new PDO($dsn,"root","");
$db->query("INSERT INTO tb (ban,nam,mes,dat)
            VALUES (NULL,'$my_nam','$my_mes',NOW())");
        
    }catch (Exception $e) {
  echo $e->getMessage() . PHP_EOL;
}
              
header("Location: {$_SERVER['PHP_SELF']}");
exit;
    
    }
?>
    
    
    
    
    
    <?php
    
    $dsn= "mysql:host=localhost;port=3306;dbname=db;charset=utf8"; 
    
    $db = new PDO($dsn,"root","");
    $ps = $db->query("SELECT * FROM tb ORDER BY ban DESC");
        

//定数======================================================
define("SECMINUITE", 60);					//1分（秒）
define("SECHOUR",    60 * 60);				//1時間（秒）
define("SECDAY",     60 * 60 * 24);			//1日（秒）
define("SECWEEK",    60 * 60 * 24 * 7);		//1週（秒）
define("SECMONTH",   60 * 60 * 24 * 30);	//1月（秒）
define("SECYEAR",    60 * 60 * 24 * 365);	//1年（秒）
//===========================================================
    function niceTime($dest,$sour) {      
        $sour = (func_num_args() == 1) ? time() : func_get_arg(1);
        
     $tt = $dest - $sour;
    
 
    if ($tt / SECYEAR  < -1) return abs(round($tt / SECYEAR))    . '年前';
    if ($tt / SECMONTH < -1) return abs(round($tt / SECMONTH))   . 'ヶ月前';
    if ($tt / SECWEEK  < -1) return abs(round($tt / SECWEEK))    . '週間前';
    if ($tt / SECDAY   < -1) return abs(round($tt / SECDAY))     . '日前';
    if ($tt / SECHOUR  < -1) return abs(round($tt / SECHOUR))    . '時間前';
    if ($tt / SECMINUITE < -1)   return abs(round($tt / SECMINUITE)) . '分前';
    if ($tt < 0)                return abs(round($tt)) . '秒前';
    if ($tt / SECYEAR  > +1) return abs(round($tt / SECYEAR))    . '年後';
    if ($tt / SECMONTH > +1) return abs(round($tt / SECMONTH))   . 'ヶ月後';
    if ($tt / SECWEEK  > +1) return abs(round($tt / SECWEEK))    . '週間後';
    if ($tt / SECDAY   > +1) return abs(round($tt / SECDAY))     . '日後';
    if ($tt / SECHOUR  > +1) return abs(round($tt / SECHOUR))    . '時間後';
    if ($tt / SECMINUITE > +1)   return abs(round($tt / SECMINUITE)) . '分後';
    if ($tt > 0)                return abs(round($tt)) . '秒後';
     return '現在';
 }
 //==========================================================         
    while($r = $ps->fetch()){ 
        
    $beforedest = $r['dat'];
    $dest = strtotime($beforedest);
    $sour = time(); //現在の時刻
        
    $outstr = nicetime($dest,$sour);?>
        
        
        <div class="chat-list">
        <div class="chat-name">
    <?php
    print "{$r['nam']}";?>
        </div>
        
        <div class="chat-date">
    <?php
        echo $outstr;?>
        </div>
        
        <div class="chat-message">
    <?php    
    print nl2br($r['mes']); ?> 
        </div> 
        
        </div><hr>
    <?php } ?>
       
        

    </div>
    
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
