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
<a href="../php/cart.php"><img src="../image/cart.png"  width="120" height="35"></a>
<a href="../html/goodshistory.html"><img src="../image/rireki.png"  width="120" height="35"></a>
</div>

</div>



<div id="anime">
<div id="animetitle">
<div id="animeitiran"><center><a href="../html/animelist.html">アニメ一覧</a></center></div>


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
//グローバル変数
$memberid = null;		//会員ID
$name = null;			//氏名
$kana = null;			//フリガナ
$address = null;		//住所
$postal_code = null;	//郵便番号
$email_address = null;	//メールアドレス
$phone_number = null;	//電話番号
$point = null;			//保有ポイント
$goodsname = array(); 	//商品名
$price = array();		//価格
$anime = array();		//アニメタイトル
$totalprice = 0;		//合計金額
$goodsid = null;		//商品ID
$gid = null;			//商品ID_DBfor用
$buyquantity = null;	//購入数量
$pointusetype = null;	//ポイントの利用方法
$use_point = null;		//使用ポイント
$earn_point = null;		//獲得ポイント
?>

<?php
//会員情報を取得
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
	$sql = "SELECT name, kana, address, postal_code, email_address, phone_number, point "
		 . "FROM member "
		 . "WHERE member_id = ?";
	if ($stmt = $mysqli->prepare($sql)) {
		// 条件値をSQLにバインドする
		$stmt->bind_param("i", $GLOBALS['memberid']);

		// 実行
		$stmt->execute();

		// 取得結果を変数にバインドする
		$stmt->bind_result($name, $kana, $address, $postal_code, $email_address, $phone_number, $point);
		while ($stmt->fetch()) {
			$GLOBALS['name'] = $name;
			$GLOBALS['kana'] = $kana;
			$GLOBALS['address'] = $address;
			$GLOBALS['postal_code'] = $postal_code;
			$GLOBALS['email_address'] = $email_address;
			$GLOBALS['phone_number'] = $phone_number;
			$GLOBALS['point'] = $point;
		}
		$stmt->close();
	}
	// DB接続を閉じる
	$mysqli->close();
}

//カートの商品情報を取得
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

//ポイント使用処理
/*
function usepoint(){
	$GLOBALS['pointusetype'] = $_POST['pointusetype'];

	switch ($GLOBALS['pointusetype']) {
		case "使用しない":
			$GLOBALS['use_point'] = 0;
			break;

		case "全て使用する":
			break;
	}
}
*/

//保有ポイント取得処理
function pointselect(){
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
	$sql = "SELECT point "
		 . "FROM member "
		 . "WHERE member_id = ?";
	if ($stmt = $mysqli->prepare($sql)) {
		// 条件値をSQLにバインドする
		$stmt->bind_param("i", $GLOBALS['memberid']);

		// 実行
		$stmt->execute();

		// 取得結果を変数にバインドする
		$stmt->bind_result($point);
		while ($stmt->fetch()) {
			$GLOBALS['point'] = $point;
		}
		$stmt->close();
	}
	// DB接続を閉じる
	$mysqli->close();
}

//獲得ポイント追加処理
function earnpointadd(){
	$GLOBALS['earn_point'] = floor($GLOBALS['totalprice'] / 100);
	$GLOBALS['point'] += $GLOBALS['earn_point'];

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
	$sql = "UPDATE member SET point = ? "
		 . "WHERE member_id = ?";
	if ($stmt = $mysqli->prepare($sql)) {
		// 条件値をSQLにバインドする
		$stmt->bind_param("ii", $GLOBALS['point'], $_SESSION['userid']);

		// 実行
		$stmt->execute();

		$stmt->close();
	}
	// DB接続を閉じる
	$mysqli->close();
}

//購入履歴に挿入
/*
function buyinsert(){
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
	$sql = "INSERT INTO history(member_id, date, time, settlement_total_price, payment_method, use_point, "
		 . "earn_point, delivery_method, delivery_time, name, postal_code, address, phone_number) "
		 . "VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
	if ($stmt = $mysqli->prepare($sql)) {
		// 条件値をSQLにバインドする
		$stmt->bind_param("issisiissssss", $_SESSION['userid'], date("Y-m-d"), date("H:i:s", time()),
							$totalprice, $_SESSION['cartpaymentmethod'], $use_point, $earn_point,
							$_SESSION['cartdeliverymethod'], $_SESSION['cartdeliverytime'], $name, $postal_code,
							$address, $phone_number);

		// 実行
		$stmt->execute();

		$stmt->close();
	}
	// DB接続を閉じる
	$mysqli->close();
}
*/


//会員情報を取得する
memberinfo();

//カートの商品情報を取得する
buygoodsselect();

//ポイント使用処理
//usepoint();

//保有ポイント取得処理
//pointselect();

//獲得ポイント追加処理
//earnpointadd();

//購入履歴にデータを挿入
//buyinsert();

//購入履歴明細にデータを挿入


//セッションを消す
unset($_SESSION['cartgoodsid']);
unset($_SESSION['cartquantity']);
unset($_SESSION['cartdeliverymethod']);
unset($_SESSION['cartdeliverytime']);
unset($_SESSION['cartpaymentmethod']);
?>
配送先住所→配送方法→支払方法→購入確認→<font color="#ff0000">購入完了</font><br><br>

<p>購入が完了しました</p>

<form action="../html/index.html" method="post">
<input type="submit" value="トップへ">
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
<li><a href="http://www.monster-strike.com/"><img src="/ushijimatown/image/random1.jpg" width="190" height="60" /></a></li>
<li><a href="http://www.monster-strike.com/"><img src="/ushijimatown/image/random2.jpg" width="190" height="60" /></a></li>
<li><a href="http://www.monster-strike.com/"><img src="/ushijimatown/image/random3.jpg" width="190" height="60" /></a></li>
<li><a href="http://www.monster-strike.com/"><img src="/ushijimatown/image/201501291305027188.jpeg" width="190" height="60" /></a></li>
<li><a href="http://www.monster-strike.com/"><img src="/ushijimatown/image/20141118_1a.png" width="190" height="60" /></a></li>
<li><a href="/ushijimatown/php/search.php?keywords=ジョジョの奇妙な冒険"><img src="/ushijimatown/image/jojo01.png" width="190" height="60" /></a></li>
<li><a href="/ushijimatown/php/search.php?keywords=魔法少女まどか☆マギカ"><img src="/ushijimatown/image/madomagi03.jpg" width="190" height="60" /></a></li>
<li><a href="/ushijimatown/php/search.php?keywords=BLACK LAGOON"><img src="/ushijimatown/image/blacklagoon01.jpg" width="190" height="60" /></a></li>
<li><a href="/ushijimatown/php/search.php?keywords=ドラゴンボール"><img src="/ushijimatown/image/doragonball01.gif" width="190" height="60" /></a></li>


</ul>
</div>


<div id="twitter">
<a class="twitter-timeline" href="https://twitter.com/ikedadaizo" data-widget-id="624386759351255040" width="190" height="50" >@ikedadaizoさんのツイート</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';
         if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
</div>
</div>
</div>
</div>

</body>
</html>
