<!DOCTYPE html>
<html>
<head>
<?php
//セッションを開始する
session_start();
?>
<meta charset="UTF-8">
<link rel="stylesheet" href="/ushijimatown/css/reset.css" type="text/css" />
<link rel="stylesheet" href="/ushijimatown/css/css.css" type="text/css" />
<title>フィギュア専門店うしぢまタウン</title>
<script type="text/javascript" src="/ushijimatown/plugin/jquery.js"></script>
<script type="text/javascript" src="/ushijimatown/plugin/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="/ushijimatown/plugin/sliders.js"></script>
<script type="text/javascript">
jQuery(function($) {
	$.fn.extend({
	    randomdisplay : function(num) {
	        return this.each(function() {
	            var chn = $(this).children().hide().length;
	            for(var i = 0; i < num && i < chn; i++) {
	                var r = parseInt(Math.random() * (chn - i)) + i;
	            $(this).children().eq(r).show().prependTo($(this));
	            }
	        });
	    }
	});
	$(function(){
	    $("[randomdisplay]").each(function() {
	    $(this).randomdisplay($(this).attr("randomdisplay"));
	    });
	});
	});
</script>
<script>
$(function(){
	$("#slide01").sliders({
		slideType:'leftSlideLoop',
		changeTime: 1500,
		showTime: 3000,
		allTime: 15000,
		animeType: 'swing'
	});


    ////////////////////////////////////////////////////

    //  leftSlideLoop

    ////////////////////////////////////////////////////
    function leftSlideLoop(){
        slideContent.wrapAll('<div class="loop"></div>');

        slideWrapInner.css({
            'margin-right': 'auto',
            'margin-left': 'auto',
            'overflow' : 'hidden',
            'width' : slideWidth,
            'height' : slideHeight
        });
        slideContent.css({
            'float' : 'left',
            'overflow' : 'hidden',
            'width' : (slideWidth * slideNum)
        });
        slideList.css({
            'float' : 'left'
        });

        slideWrapInner.children('.loop').css({
            'width' : (slideWidth * slideNum) * 2,
            'position' : 'relative',
            'left' : 0
        });
        slideContent.clone().appendTo(slideWrapInner.children('.loop'));

        var currentIndex = 1;
        var index = 1;

        function goSlide(index){

            //ループまで行かない場合
            if(index > currentIndex){
                slideWrapInner.children('.loop').stop().animate({
                    'left' : parseInt(slideWidth * (index - 1) * (-1))+ 'px'
                },slideChangeTime,animationType,function(){
                    clickFlg = true;
                });
                currentIndex = index;
            }
            //ループする場合
            if(index < currentIndex){
                slideWrapInner.children('.loop').stop().animate({
                    'left' : parseInt(slideWidth * (index - 1 + slideNum) * (-1))+ 'px'
                },slideChangeTime,animationType).animate({
                    'left' : parseInt(slideWidth * (index - 1) * (-1))+ 'px'
                },0,function() {
                    clickFlg = true;
                });
                currentIndex = index;
            }

            //ページャーの処理
            pagerList.removeClass('current');
            pagerList.eq(index - 1).addClass('current')
        };

        var clickFlg = true;
        //ページャーをクリックした時
        pagerList.click(function() {
            if(clickFlg){
                clickFlg = false;
                index = $(this).index() + 1;
                goSlide(index);
                stop();
                start();
            }
            return false;
        });

        function start(){
            own = setInterval(function() {
                    if(index >= slideNum){
                        index = 0;
                    }
                    index++;
                    goSlide(index);

                }, slideShowTime);
        }

        function stop () {
           clearInterval(own);
        }

        start();
    }

});
</script>

</head>
<body>
<div class="main">
<!--ヘッダーここから-->
<a name="top" id="top"></a>

<div id="header">
<!--タイトルロゴここから-->
<div class="header" id="header_left">
<a href="/ushijimatown/html/index.html"><img src="../image/rogo.png" alt="rogo" width="350" height="200">
</a></div>
<!--タイトルロゴここまで-->
</div>



<div id="kennsaku">
<div id="menuber">
<div id="menu" >
<ul>
<li><a href="../html/annai.html">ご利用案内</a></li>
<li><a href="../html/toiawase.html">お問い合わせ</a></li>
</ul>
</div>
</div>
<div id="kensakuform">
<form name="searchform" id="searchform4" method="GET" action="/ushijimatown/php/search.php" >
<input name="keywords" id="keywords4" type="text" />
<input type="image" src="../image/btn4.gif" alt="検索" name="searchBtn4" id="searchBtn4" />
</form>
</div>
<div class="sab" id="sab" >
<a href="/ushijimatown/php/cart.php"><img src="../image/cart.png"  width="120" height="35"></a>
<a href="../html/goodshistory.html"><img src="../image/rireki.png"  width="120" height="35"></a>
</div>

</div>



<div id="anime">
<div id="animetitle">
<div id="animeitiran"><center><a href="animelist.html">アニメ一覧</a></center></div>


<table width="200" style="margin-left:10px;" >
<tr valign="middle">
<td align="left" height="20"><a href="/ushijimatown/php/search.php?keywords=ジョジョの奇妙な冒険">ジョジョの奇妙な冒険</a></td>
</tr>
<tr valign="middle">
<td align="left" height="20"><a href="/ushijimatown/php/search.php?keywords=ドラゴンボール">ドラゴンボール</a></td>
</tr>
<tr valign="middle">
<td align="left" height="20"><a href="/ushijimatown/php/search.php?keywords=BLACK LAGOON">BLACK LAGOON</a></td>
</tr>
<tr valign="middle">
<td align="left" height="20"><a href="/ushijimatown/php/search.php?keywords=魔法少女まどか☆マギカ">魔法少女まどか☆マギカ</a></td>
</tr>
</table>
</div>

<div id="mannaka" align="center">
<?php
$_SESSION['cartpaymentmethod'] = $_POST['paymentmethod'];
?>

<?php
//グローバル変数
$memberid = null;		//会員ID
$name = null;			//会員名
$address = null;		//住所
$postal_code = null;	//郵便番号
$email_address = null;	//メールアドレス
$phone_number = null;	//電話番号
$goodsname = array(); 	//商品名
$price = array();		//価格
$anime = array();		//アニメタイトル
$totalprice = 0;		//合計金額
$goodsid = null;		//商品ID
$gid = null;			//商品ID_DBfor用
$buyquantity = null;	//購入数量

//会員情報を取得する
function memberinfo(){
	$GLOBALS['memberid'] = $_SESSION['userid'];

	// mysqliクラスのオブジェクトを作成
	$mysqli = new mysqli('localhost', 'root', 'root', 'ushijimatown');
	if ($mysqli->connect_error) {
		echo $mysqli->connect_error;
		exit();
	}
	else {
		$mysqli->set_charset("utf8");
	}

	// ここにDB処理いろいろ書く
	$sql = "SELECT name, address, postal_code, email_address, phone_number "
			. "FROM member "
			. "WHERE member_id = ?";
	if ($stmt = $mysqli->prepare($sql)) {
		// 条件値をSQLにバインドする
		$stmt->bind_param("i", $GLOBALS['memberid']);

		// 実行
		$stmt->execute();

		// 取得結果を変数にバインドする
		$stmt->bind_result($name, $address, $postal_code, $email_address, $phone_number);
		while ($stmt->fetch()) {
			$GLOBALS['name'] = $name;
			$GLOBALS['address'] = $address;
			$GLOBALS['postal_code'] = $postal_code;
			$GLOBALS['email_address'] = $email_address;
			$GLOBALS['phone_number'] = $phone_number;
		}
		$stmt->close();
	}
	// DB接続を閉じる
	$mysqli->close();
}

//カートの商品情報を取得する
function buygoodsselect(){
	$GLOBALS['goodsid'] = $_SESSION['cartgoodsid'];
	$GLOBALS['buyquantity'] = $_SESSION['cartquantity'];

	for ($i = 0; $i < count($GLOBALS['goodsid']); $i++){
		$GLOBALS['gid'] = $GLOBALS['goodsid'][$i];

		// mysqliクラスのオブジェクトを作成
		$mysqli = new mysqli('localhost', 'root', 'root', 'ushijimatown');
		if ($mysqli->connect_error) {
			echo $mysqli->connect_error;
			exit();
		}
		else {
			$mysqli->set_charset("utf8");
		}

		// ここにDB処理いろいろ書く
		$sql = "SELECT g.goods_name, g.price, a.anime_title "
				. "FROM goods g JOIN anime a "
				. "ON(g.anime_id = a.anime_id) "
				. "WHERE goods_id = ?";
		if ($stmt = $mysqli->prepare($sql)) {
			// 条件値をSQLにバインドする
			$stmt->bind_param("i", $GLOBALS['gid']);

			// 実行
			$stmt->execute();

			// 取得結果を変数にバインドする
			$stmt->bind_result($name, $price, $anime);
			while ($stmt->fetch()) {
				array_push($GLOBALS['goodsname'], $name);
				array_push($GLOBALS['price'], $price."円");
				array_push($GLOBALS['anime'], $anime);

				$GLOBALS['totalprice'] += ($GLOBALS['buyquantity'][$i] * $price);
			}
			$stmt->close();
		}
		// DB接続を閉じる
		$mysqli->close();
	}
}
?>
配送先住所→配送方法→支払方法→<font color="#ff0000">購入確認</font>→購入完了<br><br>

<?php
if (isset($_SESSION['userid']) && isset($_SESSION['username'])) {
	memberinfo();
}

if (isset($_SESSION['cartgoodsid']) && isset($_SESSION['cartquantity'])){
	buygoodsselect();
}
?>

<form action="./buystep5.php" method="post">
<?php
for ($i = 0; $i < count($goodsname); $i++){
	print "<table>"
			. "<tr><td>アニメタイトル</td><td>$anime[$i]</td></tr>"
			. "<tr><td>商品名</td><td>$goodsname[$i]</td></tr>"
			. "<tr><td>価格</td><td>$price[$i]</td></tr>"
			. "<tr><td>数量</td><td>$buyquantity[$i]個</td></tr>"
			. "</table><br>";
}
print "合計" . $totalprice . "円";
?>
<br><br>
<table>
<tr><td colspan="2" align="center">配送先</td></tr>
<tr><td>氏名</td><td><?php print $name; ?></td></tr>
<tr><td>郵便番号</td><td><?php print $postal_code; ?></td></tr>
<tr><td>住所</td><td><?php print $address; ?></td></tr>
<tr><td>メールアドレス</td><td><?php print $email_address; ?></td></tr>
<tr><td>電話番号</td><td><?php print $phone_number; ?></td></tr>
</table>
<br>

<table>
<tr><td colspan="2" align="center">配送情報</td></tr>
<tr><td>配送方法：</td><td><?php print $_SESSION['cartdeliverymethod']; ?></td></tr>
<tr><td>配送時間：</td><td><?php print $_SESSION['cartdeliverytime']; ?></td></tr>
</table>
<br>

<table>
<tr><td>支払方法：</td><td><?php print $_SESSION['cartpaymentmethod']; ?></td></tr>
</table>
<input type="submit" value="購入確定">
</form>
</div>

<div id="animekoukoku">
<?php
//セッションのユーザ名とユーザIDが存在しなかった場合
if (!isset($_SESSION['username']) && !isset($_SESSION['userid'])){
	print "<center>
			<form action=\"/ushijimatown/php/login.php\" method=\"post\">
			<br><table class=\"loginform\">
			<tr><td>メールアドレス：</td></tr>
			<tr><td><input type=\"text\" name=\"useremail\" style=\"width: 170px\"></td></tr>
			<tr><td>パスワード：</td></tr>
			<tr><td><input type=\"password\" name=\"userpassword\" style=\"width: 170px\"></td></tr>
			</table><br>
			<input type=\"submit\" class=\"classname\" value=\"ログイン\">
			</form><br>
			<a href=\"/ushijimatown/html/newmember.html\" class=\"classname\">新規登録</a>
			</center>";
}
//セッションのユーザ名とユーザIDが存在した場合
elseif (isset($_SESSION['username']) && isset($_SESSION['userid'])){
	print "<br><center>ようこそ";
	print $_SESSION['username'];
	print "さん<br><br>";
	print $_SESSION['point'];
	print "pt<br>";
	print "<br><form action=\"/ushijimatown/php/logout.php\" method=\"post\">
			<input type=\"submit\" class=\"classname\" value=\"ログアウト\">
			</form><br>";
	print "<a href=\"/ushijimatown/html/menberinfochange.html\" class=\"classname\">会員設定</a></center><br><br><br>";
}
//エラーメッセージが存在した場合
if (isset($_SESSION['errormessage'])){
	print $_SESSION['errormessage'];
	//セッション"errormessage"を削除する
	unset($_SESSION['errormessage']);
}
?>
<br>
<div id="monsto">
<ul randomdisplay="3" class="sample-list">
<li><a href="http://www.monster-strike.com/"><img src="/ushijimatown/image/izanagi001.jpg" width="190" height="60" /></a></li>
<li><a href="http://www.monster-strike.com/"><img src="/ushijimatown/image/images.jpg" width="190" height="60" /></a></li>
<li><a href="http://www.monster-strike.com/"><img src="/ushijimatown/image/imagesragieri.jpg" width="190" height="60" /></a></li>
<li><a href="http://www.monster-strike.com/"><img src="/ushijimatown/image/201501291305027188.jpeg" width="190" height="60" /></a></li>
<li><a href="http://www.monster-strike.com/"><img src="/ushijimatown/image/20141118_1a.png" width="190" height="60" /></a></li>
<li><a href="/ushijimatown/php/search.php?keywords=ジョジョの奇妙な冒険"><img src="/ushijimatown/image/jojo01.png" width="190" height="60" /></a></li>
<li><a href="/ushijimatown/php/search.php?keywords=魔法少女まどか☆マギカ"><img src="/ushijimatown/image/madomagi03.jpg" width="190" height="60" /></a></li>
<li><a href="/ushijimatown/php/search.php?keywords=BLACK LAGOON"><img src="/ushijimatown/image/blacklagoon01.jpg" width="190" height="60" /></a></li>
<li><a href="/ushijimatown/php/search.php?keywords=ドラゴンボール"><img src="/ushijimatown/image/doragonball01.gif" width="190" height="60" /></a></li>
</ul>
</div>
</div>


</div>

</body>
</html>
