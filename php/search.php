<!DOCTYPE html>
<html>
<head>
<?php
//セッションを開始する
session_start();
?>
<meta charset="UTF-8">
<link rel="stylesheet" href="../css/reset.css" type="text/css" />
<link rel="stylesheet" href="../css/css.css" type="text/css" />
<title>フィギュア専門店うしぢまタウン</title>
<script type="text/javascript" src="../plugin/jquery.js"></script>
<script type="text/javascript" src="../plugin/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="../plugin/sliders.js"></script>
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
<a href="../html/index.html"><img src="../image/rogo.png" alt="rogo" width="350" height="200">
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
<form name="searchform" id="searchform4" method="POST" action="#" >
<input name="keywords" id="keywords4" value="" type="text" />
<input type="image" src="../image/btn4.gif" alt="検索" name="searchBtn4" id="searchBtn4" />
</form>
</div>
<div class="sab" id="sab" >
<a href="../html/cart.html"><img src="../image/cart.png"  width="120" height="35"></a>
<a href="../html/goodshistory.html"><img src="../image/rireki.png"  width="120" height="35"></a>
</div>

</div>



<div id="anime">
<div id="animetitle">
<table width="200" style="margin-left:10px;" >
<tr valign="middle">
<td colspan="3" height="20">アニメ一覧</td>
</tr>
<tr valign="middle">
<td align="left" height="20"><a href="#">ジョジョの奇妙な冒険</a></td>
</tr>
<tr valign="middle">
<td align="left" height="20"><a href="#">ドラゴンボール</a></td>
</tr>
<tr valign="middle">
<td align="left" height="20"><a href="#">BLACK LAGOON</a></td>
</tr>
<tr valign="middle">
<td align="left" height="20"><a href="#">魔法少女まどか☆マギカ</a></td>
</tr>
</table>
</div>
<div id="mannaka">
<?php

















?>
</div>
<div id="animekoukoku">
<?php
//セッションのユーザ名とユーザIDが存在しなかった場合
if (!isset($_SESSION['username']) && !isset($_SESSION['userid'])){
	print "<center>
			<form action=\"../php/login.php\" method=\"post\">
			<br><table class=\"loginform\">
			<tr><td>メールアドレス：</td></tr>
			<tr><td><input type=\"text\" name=\"useremail\" style=\"width: 170px\"></td></tr>
			<tr><td>パスワード：</td></tr>
			<tr><td><input type=\"password\" name=\"userpassword\" style=\"width: 170px\"></td></tr>
			</table><br>
			<input type=\"submit\" class=\"classname\" value=\"ログイン\">
			</form><br>
			<a href=\"newmember.html\" class=\"classname\">新規登録</a>
			</center>";
}
//セッションのユーザ名とユーザIDが存在した場合
elseif (isset($_SESSION['username']) && isset($_SESSION['userid'])){
	print "<center>ようこそ";
	print $_SESSION['username'];
	print "さん";
	print "<form action=\"../php/logout.php\" method=\"post\">
			<input type=\"submit\" class=\"classname\" value=\"ログアウト\">
			</form></center>";
}
//エラーメッセージが存在した場合
if (isset($_SESSION['errormessage'])){
	print $_SESSION['errormessage'];
	//セッション"errormessage"を削除する
	unset($_SESSION['errormessage']);
}
?>
<br>
<ul randomdisplay="3" class="sample-list">
<li><img src="../image/izanagi001.jpg" width="190" height="60" /></li>
<li><img src="../image/images.jpg" width="190" height="60" /></li>
<li><img src="../image/imagesragieri.jpg" width="190" height="60" /></li>
<li><img src="../image/201501291305027188.jpeg" width="190" height="60" /></li>
<li><img src="../image/20141118_1a.png" width="190" height="60" /></li>

</ul>
</div>
</div>


</div>

</body>
</html>
