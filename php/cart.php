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
<div id="mannaka">

<div id="animelist">
<?php
	//グローバル変数
	$goodsid = null;			//商品ID_セッション受け取り用
	$gid = null;				//商品ID_DBfor用
	$buyquantity = null;		//商品購入数量_セッション受け取り用
	$goodsname = array();		//商品名
	$explanation = array();		//商品説明
	$price = array();			//商品金額
	$size = array();			//商品サイズ
	$stock_quantity = array();	//商品在庫数量
	$anime = array();			//商品アニメタイトル
	$image_path = array();		//商品画像パス
	$totalprice = 0;			//商品合計金額

	//カートの商品情報を配列に入れる関数
	function cartview(){
		if (isset($_SESSION['cartgoodsid']) && isset($_SESSION['cartquantity'])) {
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
				$sql = "SELECT g.goods_name, g.goods_explanation, g.price, g.size, g.stock_quantity, a.anime_title, g.image_url
						FROM goods g JOIN anime a
						ON(g.anime_id = a.anime_id)
						WHERE goods_id = ?";
				if ($stmt = $mysqli->prepare($sql)) {
					// 条件値をSQLにバインドする
					$stmt->bind_param("i", $GLOBALS['gid']);

					// 実行
					$stmt->execute();

					// 取得結果を変数にバインドする
					$stmt->bind_result($name, $explanation, $price, $size, $stock_quantity, $anime, $image_path);
					while ($stmt->fetch()) {
						array_push($GLOBALS['goodsname'], $name);
						array_push($GLOBALS['explanation'], $explanation);
						array_push($GLOBALS['price'], $price."円");
						array_push($GLOBALS['size'], $size);
						array_push($GLOBALS['stock_quantity'], $stock_quantity."個");
						array_push($GLOBALS['anime'], $anime);
						array_push($GLOBALS['image_path'], $image_path);

						$GLOBALS['totalprice'] += ($GLOBALS['buyquantity'][$i] * $price);
					}
					$stmt->close();
				}
				// DB接続を閉じる
				$mysqli->close();
			}
		}
	}

	//セッションに商品IDと商品数量が存在しない場合
	if (!isset($_SESSION['cartgoodsid']) && !isset($_SESSION['cartquantity'])) {
		print "<br><br><br><div style=\"margin-left:250px\">カート内に商品が存在しません</div>";
	}

	//セッションに商品IDと商品数量が存在した場合
	elseif(isset($_SESSION['cartgoodsid']) && isset($_SESSION['cartquantity'])){
		cartview();
		print "<div id=\"kotei\">";
		print "<form action=\"./cartdelete.php\" method=\"post\"><br>
				<input type=\"submit\" value=\"カート内の商品をすべて削除する\">
				</form>";
		print "<form action=\"./buylogin.php\" method=\"post\">
				<input type=\"submit\" value=\"レジに進む\">
				</form>";
		print "合計".$GLOBALS['totalprice']."円";
		print "</div><div class=\"animebox\">";

		for ($i = 0; $i < count($GLOBALS['goodsname']); $i++) {
			print "<div id=\"animezentai\"><br><br>"
				. "<div id=\"animegazou\"><img src=\"$image_path[$i]\" alt=\"商品画像\" height=\"400px\" width=\"300px\"></div>"
				. "<div id=\"animebun\">"
				. "<br><br>"
				. "<table>"
				. "<tr><td>アニメタイトル</td><td>$anime[$i]</td></tr>"
				. "<tr><td>商品名</td><td>$goodsname[$i]</td></tr>"
				. "<tr><td>価格</td><td>$price[$i]</td></tr>"
				. "<tr><td>商品説明</td><td>$explanation[$i]</td></tr>"
				. "<tr><td>商品サイズ</td><td>$size[$i]</td></tr>"
				. "<tr><td>在庫数</td><td>$stock_quantity[$i]</td></tr>"
				. "<tr><td>購入数</td><td>$buyquantity[$i]個</td></tr>"
				. "</table>"
				. "</div>"
				. "</div>";
		}
	}
?>
</div>
</div>
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
</ul>
</div>
</div>


</div>

</body>
</html>
