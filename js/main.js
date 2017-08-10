$(document).pjax('a[target!=_blank]', pjax_id, {fragment:pjax_id, timeout:6000});
$(document).on('submit', 'form:not(#commentform,#input)', function (event) {$.pjax.submit(event, pjax_id, {fragment:pjax_id, timeout:6000});}); 
    $(document).on('pjax:send', function() {
          $(".loading,.loading1").css("display", "block");
          $(pjax_id).addClass("xg");
          });
    $(document).on('pjax:complete', function() {
          $(".loading,.loading1").css("display", "none");
          $(pjax_id).removeClass("xg");
          $("a[href$=jpg],a[href$=jpeg],a[href$=gif],a[href$=png]").addClass("highslide").each(function(){this.onclick=function(){return hs.expand(this)}});
          $(function () { $("[data-toggle='tooltip']").tooltip(); });
	      $('#mySlide').carousel({interval:2000,});
	      pjaxcn();
          });
$( document ).on( 'click', '#mobile-tab-menu > li:not(.disable)', function(){
	$( this ).parent( 'ul' ).children( 'li' ).removeClass( 'current' );
	$( this ).addClass( 'current' );
	var current = $( this ).data( 'tab' ),
		articles = {
			context: '.context',
			related: '.related-posts-box',
			comments: '#comments'
		};
	$.each( articles, function( article, selector ){
		article == current ? $( selector ).removeClass( 'mobile-hide' ) : $( selector ).addClass( 'mobile-hide' );
	} );
} );
$( document ).on( 'click', '.post-meta-li > .tags', function(){
	$( this ).children( '.tags-list' ).toggle();
} );
$( document ).on( 'click', '.post-meta-li > .tags .tags-list', function( e ){
	e.stopPropagation();
} );
$(document).ready(function(){
$(".navbar-nav li").click(function(){
   $("li").removeClass("active");
   $(this).addClass("active");
  });
});
$(".navbar-nav li.dropdown").mouseover(function(){$(this).addClass("open")});
$(".navbar-nav li.dropdown").mouseleave(function(){$(this).removeClass("open")});
$(function () { $("[data-toggle='tooltip']").tooltip(); });
$('#mySlide').carousel({interval:2000,});
$(window).scroll(function() {
	50 < $(this).scrollTop() ? $(".backtop").fadeIn() : $(".backtop").fadeOut();
});
$("#qqhao").blur(function() {
	$("#qqhao").attr("disabled", false);
	$("#ajaxloading").html('<img src="' + pjaxtheme + 'img/loading.gif"><a style="font-size:12px;margin-left:5px;">正在获取QQ信息..</a>');
	$.ajax({
		url: "https://api.pjax.cn/api/qq/nic.php?qq=" + $("#qqhao").val(),
		type: "GET",
		dataType: "jsonp",
		success: function(a) {
			if (a.name) {
				$("#ajaxloading").hide();
				$("#author").val(a.name);
				$("#email").val($("#qqhao").val() + "@qq.com");
				$("#url").val("http://user.qzone.qq.com/" + $("#qqhao").val());
				$("#qqhao").attr("disabled", true)
			} else {
				$("#ajaxloading").hide();
				$(".comment-form-qq").removeAttr("disabled");
				$("#error").html('<img src="' + pjaxtheme + 'img/error.png"> qq账号错误').show().fadeOut(4E3)
			}
		},
		error: function(a, b, c) {
			$("#ajaxloading").hide();
			$(".comment-form-qq").removeAttr("disabled");
			$("#error").html('<img src="' + pjaxtheme + 'img/error.png"> qq账号错误').show().fadeOut(4E3)
		}
	})
});
$("#submit").on("click",function(){
	$('.faceshow').hide();
	$("#ajaxloading1").html('<img style="margin-left:5px;" src="'+ pjaxtheme +'img/loading.gif"><a style="font-size:12px;margin-left:5px;">正在提交评论..</a>');
	$.ajax({
		url: $("#commentform").attr("action"),
		type: 'post',
		data: $("#commentform").serialize(),
		success:function(d){
			var reg = /<div class=\"main\">[\r\n]*<p>(.*?)<\/p>/i;
			if(reg.test(d)){
				$("#error1").html(d.match(reg)[1]).show().fadeOut(2500);
				$("#ajaxloading1").hide();
			}else{
				var pid = $('.comment').length ? $('.comment').attr('id').split('-') : 0;
				$("#comments2").html($(d).find("#comments2").html());
				$(".comment-info").hover(function(){$(this).find(".comment-reply").show();},function(){$(this).find(".comment-reply").hide();});
				$.pjax.reload(pjax_id, {fragment: pjax_id,timeout: 6000 });
				if (pid != 0){
					$("html,body").animate(function (){scrollTop:$("#comment-"+pid[1]).offset().top - 260},1000);
				}
			}
		}
	})	
	return false;
});
$('.navsearch').click(function(){$('.navbar-form .input-group>.form-control').animate({width: "100%"},500);})
$('.navsearch').blur(function(){$('.navbar-form .input-group>.form-control').animate({width: "20%"},500);})
$('img[src*="checkcode.php"]').attr('title', '单击刷新验证码').click(function(){this.src = this.src.replace(/\?.*$/, "") +'?'+ new Date().getTime();})
$(".toggler").click(function() {"展开归档" == jQuery(this).text() ? ($(".archives").find("ul").show(), jQuery(this).text("折叠归档")) : ($(".archives").find("ul").hide(), jQuery(this).text("展开归档"));return !1})
function qqhaoma(){
$("#qqhao").blur(function() {
	$("#qqhao").attr("disabled", false);
	$("#ajaxloading").html('<img src="' + pjaxtheme + 'img/loading.gif"><a style="font-size:12px;margin-left:5px;">正在获取QQ信息..</a>');
	$.ajax({
		url: "https://api.pjax.cn/api/qq/nic.php?qq=" + $("#qqhao").val(),
		type: "GET",
		dataType: "jsonp",
		success: function(a) {
			if (a.name) {
				$("#ajaxloading").hide();
				$("#author").val(a.name);
				$("#email").val($("#qqhao").val() + "@qq.com");
				$("#url").val("http://user.qzone.qq.com/" + $("#qqhao").val());
				$("#qqhao").attr("disabled", true)
			} else {
				$("#ajaxloading").hide();
				$(".comment-form-qq").removeAttr("disabled");
				$("#error").html('<img src="' + pjaxtheme + 'img/error.png"> qq账号错误').show().fadeOut(4E3)
			}
		},
		error: function(a, b, c) {
			$("#ajaxloading").hide();
			$(".comment-form-qq").removeAttr("disabled");
			$("#error").html('<img src="' + pjaxtheme + 'img/error.png"> qq账号错误').show().fadeOut(4E3)
		}
	})
});
}
function tops() {
	$('html,body').animate({scrollTop:0});
}
function embedSmiley() {
    "none" == $(".smiley-box").css("display") ? $(".smiley-box").slideDown(200) : $(".smiley-box").slideUp(200)
}
function grin(a) {
    var b;
    a = " " + a + " ";
    if (document.getElementById("comment") && "textarea" == document.getElementById("comment").type) b = document.getElementById("comment");
    else return !1;
    if (document.selection) b.focus(), sel = document.selection.createRange(), sel.text = a, b.focus();
    else if (b.selectionStart || "0" == b.selectionStart) {
        var c = b.selectionEnd,
            d = c;
        b.value = b.value.substring(0, b.selectionStart) + a + b.value.substring(c, b.value.length);
        d += a.length;
        b.focus();
        b.selectionStart = d;
        b.selectionEnd = d
    } else b.value += a, b.focus()
}
function commentReply(a, b) {
	var c = document.getElementById("comment-post");
	b.style.display = "none";
	document.getElementById("cancel-reply").style.display = "";
	document.getElementById("comment-pid").value = a;
	b.parentNode.parentNode.appendChild(c)
}
function cancelReply() {
	var a = document.getElementById("comment-place"),
		b = document.getElementById("comment-post");
	document.getElementById("comment-pid").value = 0;
	$(".reply i").css({
		display: ""
	});
	document.getElementById("cancel-reply").style.display = "none";
	a.appendChild(b)
}
function guidang() {
	$(".toggler").click(function() {
		"展开归档" == jQuery(this).text() ? ($(".archives").find("ul").show(), jQuery(this).text("折叠归档")) : ($(".archives").find("ul").hide(), jQuery(this).text("展开归档"));
		return !1
	})
}
function ajaxcomments(){
$("#submit").on("click",function(){
	$('.faceshow').hide();
	$("#ajaxloading1").html('<img style="margin-left:5px;" src="'+ pjaxtheme +'img/loading.gif"><a style="font-size:12px;margin-left:5px;">正在提交评论..</a>');
	$.ajax({
		url: $("#commentform").attr("action"),
		type: 'post',
		data: $("#commentform").serialize(),
		success:function(d){
			var reg = /<div class=\"main\">[\r\n]*<p>(.*?)<\/p>/i;
			if(reg.test(d)){
				$("#error1").html(d.match(reg)[1]).show().fadeOut(2500);
				$("#ajaxloading1").hide();
			}else{
				var pid = $('.comment').length ? $('.comment').attr('id').split('-') : 0;
				$("#comments2").html($(d).find("#comments2").html());
				$(".comment-info").hover(function(){$(this).find(".comment-reply").show();},function(){$(this).find(".comment-reply").hide();});
				$.pjax.reload(pjax_id, {fragment: pjax_id,timeout: 6000 });
				if (pid != 0){
					$("html,body").animate(function (){scrollTop:$("#comment-"+pid[1]).offset().top - 260},1000);
				}
			}
		}
	})	
	return false;
});}
function ajaxcheckcode(){
$('img[src*="checkcode.php"]').attr('title', '点击刷新验证码').click(function(){ this.src = this.src.replace(/\?.*$/, "") +'?'+ new Date().getTime();});
}
function pjaxcn() {
	try {
		ajaxcheckcode()
	} catch (a) {}
	try {
	    close_sidebar()
	} catch (a) {}
	try {
		ajaxcomments()
	} catch (a) {}
	try {
	    xueshengka()
	} catch (a) {}
	try {
	    guidang()
	} catch (a) {}
	try {
	    qqhaoma()
	} catch (a) {}
}
jQuery(document).ready(function(){
	var scrtime;
$(".bulletin").hover(function(){
	clearInterval(scrtime);
},function(){
scrtime = setInterval(function(){
	var $ul = $(".bulletin ul");
	var liHeight = $ul.find("li:last").height();
	$ul.animate({marginTop : 5 + "px"},300,function(){
	
	$ul.find("li:last").prependTo($ul)
	$ul.find("li:first").hide();
	$ul.css({marginTop:0});
	$ul.find("li:first").fadeIn(1000);
	});
},5000);
}).trigger("mouseleave");
});
jQuery(document).ready(function($){
$('.close-sidebar').click(function(){
    $('.close-sidebar,.sidebar').hide();
    $('.show-sidebar').show();
    $('.content').animate({
        width: "1170px"
    },
    1000);})
$('.show-sidebar').click(function(){
    $('.show-sidebar').hide();
    $('.close-sidebar').show();
    setTimeout(function () {$('.sidebar').show();}, 1000);
    $('.content').animate({
        width: "790px"
    },
    1000);})
});
function a(a, b, c) {
		if (document.selection) a.focus(), sel = document.selection.createRange(), c ? sel.text = b + sel.text + c : sel.text = b, a.focus();
		else if (a.selectionStart || "0" == a.selectionStart) {
			var l = a.selectionStart,
				m = a.selectionEnd,
				n = m;
			c ? a.value = a.value.substring(0, l) + b + a.value.substring(l, m) + c + a.value.substring(m, a.value.length) : a.value = a.value.substring(0, l) + b + a.value.substring(m, a.value.length);
			c ? n += b.length + c.length : n += b.length - m + l;
			l == m && c && (n -= c.length);
			a.focus();
			a.selectionStart = n;
			a.selectionEnd = n
		} else a.value += b + c, a.focus()
}
var b = (new Date).toLocaleTimeString(),
		c = document.getElementById("comment") || 0;
window.SIMPALED = {};
window.SIMPALED.Editor = {
	daka: function() {
		a(c, "[blockquote]滴！学生卡！打卡时间：" + b, "，请上车的乘客系好安全带~[/blockquote]")
	},
	zan: function() {
		a(c, "[blockquote][F9] 写得好好哟,我要给你生猴子！[/blockquote]")
	},
	cai: function() {
		a(c, "[blockquote][F14] 骚年,我怀疑你写了一篇假的文章！[/blockquote]")
	}
}
function close_sidebar(){
$('.close-sidebar').click(function(){
    $('.close-sidebar,.sidebar').hide();
    $('.show-sidebar').show();
    $('.content').animate({
        width: "1170px"
    },
    1000);})
$('.show-sidebar').click(function(){
    $('.show-sidebar').hide();
    $('.close-sidebar').show();
    setTimeout(function () {$('.sidebar').show();}, 1000);
    $('.content').animate({
        width: "760px"
    },
    1000);})
}
function xueshengka() {
	function a(a, b, c) {
		if (document.selection) a.focus(), sel = document.selection.createRange(), c ? sel.text = b + sel.text + c : sel.text = b, a.focus();
		else if (a.selectionStart || "0" == a.selectionStart) {
			var l = a.selectionStart,
				m = a.selectionEnd,
				n = m;
			c ? a.value = a.value.substring(0, l) + b + a.value.substring(l, m) + c + a.value.substring(m, a.value.length) : a.value = a.value.substring(0, l) + b + a.value.substring(m, a.value.length);
			c ? n += b.length + c.length : n += b.length - m + l;
			l == m && c && (n -= c.length);
			a.focus();
			a.selectionStart = n;
			a.selectionEnd = n
		} else a.value += b + c, a.focus()
	}
	var b = (new Date).toLocaleTimeString(),
		c = document.getElementById("comment") || 0;
	window.SIMPALED = {};
	window.SIMPALED.Editor = {
		daka: function() {
			a(c, "[blockquote]滴！学生卡！打卡时间：" + b, "，请上车的乘客系好安全带~[/blockquote]")
		},
		zan: function() {
			a(c, "[blockquote][F9] 写得好好哟,我要给你生猴子！[/blockquote]")
		},
		cai: function() {
			a(c, "[blockquote][F14] 骚年,我怀疑你写了一篇假的文章！[/blockquote]")
		}
	}
};