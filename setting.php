<?php 
/*
 * LLY控制台
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
require_once('inc/config.php');
if (ROLE == ROLE_ADMIN):
require_once('inc/functions.php');
plugin_setting();
?>
<div id="<?php echo get_template_name();?>">
<section class="container">
<div class="content-wrap">
<div class="content">	
<div class="left-column">
<div id="setting" class="panel-sort">
<main id="main" class="site-main" role="main">
<form enctype="multipart/form-data" action="?setting&do=save" method="post" id="input" class="da-form">
  <div class="set_nav">
	<ul>
		<li class="active"><a href="#blog">基本设置</a></li>
        <li><a href="#plus">图标设置</a></li>
        <li><a href="#Slide">图片轮播</a></li>
        <li><a href="#Sortx">分类信息</a></li>
        <li><a href="#ADs">广告时间</a></li>
        <li><a href="#read">关于模板</a></li>
		<li class="last"><input type="submit" value="保 存" class="save" /></li>
	</ul>
</div>
<div class="set_cnt">
<div class="set_box" id="blog" style="display:block">
<div class="da-form-row">
<td class="right_td">站点LOGO：</td>
<td class="left_td"><input type="file" name="logo" style="display: inline-flex;" class="text-width"/></td>
<td class="right_td"><img src="<?php echo $logo ?  $logo : ''.TEMPLATE_URL."img/logo.png";?>" width="135px" height="32px" style="margin-left:5px;margin-top:-3px;border-radius: 3px;border:1px solid #eee;padding:2px"></td>
</div>
<div class="da-form-row">
<td class="right_td">是否开启自定义背景：</td>
<td class="left_td"><input name="bg_open" type="radio" value="1" <?php if ($bg_open == "1") echo 'checked'?> ></input></td>
<td class="right_td">开启</td>
<td class="left_td"><input name="bg_open" type="radio" value="2" <?php if ($bg_open == "2") echo 'checked'?> ></input></td>
<td class="right_td">关闭</td>
</div>
<div class="da-form-row">
<td class="right_td">自定义背景图片：</td>
<td class="left_td"><input type="file" name="bgimg" style="display: inline-flex;" class="text-width"/></td>
<td class="right_td"><img src="<?php echo $bgimg ?  $bgimg : ''.TEMPLATE_URL."img/bg.jpg";?>" width="135px" height="32px" style="margin-left:5px;margin-top:-3px;border-radius: 3px;border:1px solid #eee;padding:2px"></td>
</div>
<div class="da-form-row">
<td class="right_td">主体宽度：</td>
<td class="left_td"><input size="4" name="index_width" type="text" value="<?php echo $index_width; ?>"/></td>
<td class="right_td">单位为<span style="color:red">px</span>,不需要自己写</td>
</div>
<div class="da-form-row">
<td class="right_td">是否开启首页推荐4幅图：</td>
<td class="left_td"><input name="fous_open" type="radio" value="1" <?php if ($fous_open == "1") echo 'checked'?> ></input></td>
<td class="right_td">开启</td>
<td class="left_td"><input name="fous_open" type="radio" value="2" <?php if ($fous_open == "2") echo 'checked'?> ></input></td>
<td class="right_td">关闭</td>
</div>
<div class="da-form-row">
<td class="right_td">推荐4幅图分类ID：</td>
<td class="left_td"><input size="2" name="fous_id" type="text" value="<?php echo $fous_id; ?>"/></td>
</div>
<div class="da-form-row">
<td class="right_td">电影分类ID：</td>
<td class="left_td"><input size="2" name="dy_id" type="text" value="<?php echo $dy_id; ?>"/></td>
<td class="right_td">需要配合视频插件,否则设置一个没有的分类ID！</td>
</div>
<div class="da-form-row">
<td class="right_td">首页列表文章篇数：</td>
<td class="left_td"><input size="2" name="index_num" type="text" value="<?php echo $index_num; ?>"/></td>
</div>
<div class="da-form-row">
<td class="right_td">首页CMS风格分类ID：</td>
<td class="left_td"><input size="20" name="cms_id" type="text" value="<?php echo $cms_id; ?>" class="text-width"/></td>
<td class="right_td">多个模块之间用英文<span style="color:red">逗号</span>隔开即可！</td>
</div>
<div class="da-form-row">
<td class="right_td">源码压缩：</td>
<td class="left_td"><input name="compress_html" type="radio" value="1" <?php if ($compress_html == "1") echo 'checked'?> ></input></td>
<td class="right_td">开启</td>
<td class="left_td"><input name="compress_html" type="radio" value="2" <?php if ($compress_html == "2") echo 'checked'?> ></input></td>
<td class="right_td">关闭</td>
</div>
<div class="da-form-row">
<td class="right_td">侧边栏联系QQ：</td>
<td class="left_td"><input size="12" name="side_qq" type="text" value="<?php echo $side_qq; ?>"/></td>
<td class="right_td">需要打开侧边栏<span style="color:red">个人资料</span></td>
</div>
<div class="da-form-row">
<td class="right_td">开启菜单栏更多：</td>
<td class="left_td"><input name="more" type="radio" value="1" <?php if ($more == "1") echo 'checked'?> ></input></td>
<td class="right_td">开启</td>
<td class="left_td"><input name="more" type="radio" value="2" <?php if ($more == "2") echo 'checked'?> ></input></td>
<td class="right_td">关闭</td>
</div>
<div class="da-form-row">
<td class="right_td">菜单栏更多功能 (<span style="color:red; font-weight:bold">支持html代码</span>)</td><br/>
<p><textarea name="more_html" cols="125" rows="8" id="home_text" ><?php echo $more_html; ?></textarea></p>
</div>
</div>
<div class="set_box" id="plus">
<div class="da-form-row">
<td class="right_td"><span style="color:red; font-weight:bold">导航设置: <a href="http://www.fontawesome.com.cn/faicons/" target="_black">Awesome 字体图标</a></span></td>
</div>
<div class="da-form-row">
<td class="right_td"> 导航图标设置(<span style="color:red; font-weight:bold">注意更改导航后需重新设置</span>)</td></br>
<?php
global $CACHE; 
global $arr_navico1; 
$navi_cache = $CACHE->readCache('navi');
foreach($navi_cache as $num=>$value):

        if ($value['pid'] != 0) {
            continue;
        }
		$id=$value["id"];
		
		echo '<td class="right_td">'.$value['naviname'].' &nbsp; =></td>
<td class="left_td"><input class="input"  value="'.$arr_navico1[$id].'" name="arr_navico['.$id.']"></td></br>';
endforeach;
?>
</div>
<div class="da-form-row">
<td class="right_td">分类和二级导航图标(<span style="color:red; font-weight:bold">注意更改分类后需重新设置</span>)</td></br>
<?php
global $CACHE;
$sort_cache = $CACHE->readCache('sort'); 
global $arr_navico1; 
foreach($sort_cache as $num=>$value):
		$sid=$value["sid"];
		
		echo '<td class="right_td">'.$value['sortname'].' &nbsp; =></td>
<td class="left_td"><input class="input"  value="'.$arr_sortico1[$sid].'" name="arr_sortico['.$sid.']"></td></br>';
endforeach;
?>
</div>
</div>
<div class="set_box" id="Slide">
<div class="da-form-row">
<td class="right_td">开启轮播图：</td>
<td class="left_td"><input name="Slide" type="radio" value="1" <?php if ($Slide == "1") echo 'checked'?> ></input></td>
<td class="right_td">开启</td>
<td class="left_td"><input name="Slide" type="radio" value="2" <?php if ($Slide == "2") echo 'checked'?> ></input></td>
<td class="right_td">关闭</td>
</div>
<div class="da-form-row">
<td class="right_td">幻灯片图片1：</td>
<td class="left_td"><input size="30" name="Slide1" type="text" value="<?php echo $Slide1; ?>" class="text-width"/></td>
</div>
<div class="da-form-row">
<td class="right_td">幻灯片链接1：</td>
<td class="left_td"><input size="30" name="Surl1" type="text" value="<?php echo $Surl1; ?>" class="text-width"/></td>
</div>
<div class="da-form-row">
<td class="right_td">幻灯片图片2：</td>
<td class="left_td"><input size="30" name="Slide2" type="text" value="<?php echo $Slide2; ?>" class="text-width"/></td>
</div>
<div class="da-form-row">
<td class="right_td">幻灯片链接2：</td>
<td class="left_td"><input size="30" name="Surl2" type="text" value="<?php echo $Surl2; ?>" class="text-width"/></td>
</div>
<div class="da-form-row">
<td class="right_td">幻灯片图片3：</td>
<td class="left_td"><input size="30" name="Slide3" type="text" value="<?php echo $Slide3; ?>" class="text-width"/></td>
</div>
<div class="da-form-row">
<td class="right_td">幻灯片链接3：</td>
<td class="left_td"><input size="30" name="Surl3" type="text" value="<?php echo $Surl3; ?>" class="text-width"/></td>
</div>
</div> 
<div class="set_box" id="Sortx">
<div class="da-form-row">
<td class="right_td">开启分类信息：</td>
<td class="left_td"><input name="Sorts" type="radio" value="1" <?php if ($Sorts == "1") echo 'checked'?> ></input></td>
<td class="right_td">开启</td>
<td class="left_td"><input name="Sorts" type="radio" value="2" <?php if ($Sorts == "2") echo 'checked'?> ></input></td>
<td class="right_td">关闭</td>
</div>
<div class="da-form-row">
<td class="right_td">分类一标题：</td>
<td class="left_td"><input size="30" name="Sorth1" type="text" value="<?php echo $Sorth1; ?>" class="text-width"/></td>
</div>
<div class="da-form-row">
<td class="right_td">分类一文字：</td>
<td class="left_td"><input size="30" name="Sortp1" type="text" value="<?php echo $Sortp1; ?>" class="text-width"/></td>
</div>
<div class="da-form-row">
<td class="right_td">分类一链接：</td>
<td class="left_td"><input size="30" name="Sorta1" type="text" value="<?php echo $Sorta1; ?>" class="text-width"/></td>
</div>
<div class="da-form-row">
<td class="right_td">分类二标题：</td>
<td class="left_td"><input size="30" name="Sorth2" type="text" value="<?php echo $Sorth2; ?>" class="text-width"/></td>
</div>
<div class="da-form-row">
<td class="right_td">分类二文字：</td>
<td class="left_td"><input size="30" name="Sortp2" type="text" value="<?php echo $Sortp2; ?>" class="text-width"/></td>
</div>
<div class="da-form-row">
<td class="right_td">分类二链接：</td>
<td class="left_td"><input size="30" name="Sorta2" type="text" value="<?php echo $Sorta2; ?>" class="text-width"/></td>
</div>
<div class="da-form-row">
<td class="right_td">分类三标题：</td>
<td class="left_td"><input size="30" name="Sorth3" type="text" value="<?php echo $Sorth3; ?>" class="text-width"/></td>
</div>
<div class="da-form-row">
<td class="right_td">分类三文字：</td>
<td class="left_td"><input size="30" name="Sortp3" type="text" value="<?php echo $Sortp3; ?>" class="text-width"/></td>
</div>
<div class="da-form-row">
<td class="right_td">分类三链接：</td>
<td class="left_td"><input size="30" name="Sorta3" type="text" value="<?php echo $Sorta3; ?>" class="text-width"/></td>
</div>
<div class="da-form-row">
<td class="right_td">分类四标题：</td>
<td class="left_td"><input size="30" name="Sorth4" type="text" value="<?php echo $Sorth4; ?>" class="text-width"/></td>
</div>
<div class="da-form-row">
<td class="right_td">分类四文字：</td>
<td class="left_td"><input size="30" name="Sortp4" type="text" value="<?php echo $Sortp4; ?>" class="text-width"/></td>
</div>
<div class="da-form-row">
<td class="right_td">分类四链接：</td>
<td class="left_td"><input size="30" name="Sorta4" type="text" value="<?php echo $Sorta4; ?>" class="text-width"/></td>
</div>
<div class="da-form-row">
<td class="right_td">分类五标题：</td>
<td class="left_td"><input size="30" name="Sorth5" type="text" value="<?php echo $Sorth5; ?>" class="text-width"/></td>
</div>
<div class="da-form-row">
<td class="right_td">分类五文字：</td>
<td class="left_td"><input size="30" name="Sortp5" type="text" value="<?php echo $Sortp5; ?>" class="text-width"/></td>
</div>
<div class="da-form-row">
<td class="right_td">分类五链接：</td>
<td class="left_td"><input size="30" name="Sorta5" type="text" value="<?php echo $Sorta5; ?>" class="text-width"/></td>
</div>
<div class="da-form-row">
<td class="right_td">分类六标题：</td>
<td class="left_td"><input size="30" name="Sorth6" type="text" value="<?php echo $Sorth6; ?>" class="text-width"/></td>
</div>
<div class="da-form-row">
<td class="right_td">分类六文字：</td>
<td class="left_td"><input size="30" name="Sortp6" type="text" value="<?php echo $Sortp6; ?>" class="text-width"/></td>
</div>
<div class="da-form-row">
<td class="right_td">分类六链接：</td>
<td class="left_td"><input size="30" name="Sorta6" type="text" value="<?php echo $Sorta6; ?>" class="text-width"/></td>
</div>
</div>
<div class="set_box" id="ADs">
<div class="da-form-row">
<td class="right_td">开启广告：</td>
<td class="left_td"><input name="ads" type="radio" value="1" <?php if ($ads == "1") echo 'checked'?> ></input></td>
<td class="right_td">开启</td>
<td class="left_td"><input name="ads" type="radio" value="2" <?php if ($ads == "2") echo 'checked'?> ></input></td>
<td class="right_td">关闭</td>
</div>
<div class="da-form-row">
<td class="right_td">广告图片1：</td>
<td class="left_td"><input size="30" name="adimg1" type="text" value="<?php echo $adimg1; ?>" class="text-width"/></td>
</div>
<div class="da-form-row">
<td class="right_td">广告链接1：</td>
<td class="left_td"><input size="30" name="adurl1" type="text" value="<?php echo $adurl1; ?>" class="text-width"/></td>
</div>
<div class="da-form-row">
<td class="right_td">广告图片2：</td>
<td class="left_td"><input size="30" name="adimg2" type="text" value="<?php echo $adimg2; ?>" class="text-width"/></td>
</div>
<div class="da-form-row">
<td class="right_td">广告链接2：</td>
<td class="left_td"><input size="30" name="adurl2" type="text" value="<?php echo $adurl2; ?>" class="text-width"/></td>
</div>
</div>
<div class="set_box" id="read">
<div class="da-form-row">
<?php
$nonce_templet = Option::get('nonce_templet');
$nonceTplData = @implode('', @file(TPLS_PATH.$nonce_templet.'/header.php'));
preg_match("/Version:(.*)/i", $nonceTplData, $tplVersion);
define('Theme_Version' , !empty($tplVersion[1]) ? $tplVersion[1] : '' );
?>
<p>本主题请为Finally原创</p>
<p>[FLY]全站Pjax,响应式布局！</p>
<p>版本：<?php echo Theme_Version;?> <a herf="javascript:;" id="version">检查更新</a><span id="password" style="margin-left:5px;color:#666"></span></p>
<p>作者：<a href="https://pjax.cn/" target="_blank">Finally</a></p>
<script>
var ThemeVersion = <?php echo Theme_Version;?>;
$("#version").click(function(){
	$.getJSON('https://api.pjax.cn/update/FLY-FREE/ver.php?callback=?', function(a){
	if(a.version > ThemeVersion){
		$("#version").html("有版本更新:"+ '<a href="'+ a.download_url +'" target="_blank" style="color:red">点击下载</a>');
		$("#password").html("下载密码:"+ ''+ a.password +'');
	}else{
	    $("#version").html("暂无新版本");
	}
})
});
</script>
</div>
</div>  
</div>
</form>
</main>
</div>
</div>
<script>
$(function(){
	$(".set_nav li").not(".set_nav .last").click(function(e) {
		e.preventDefault();
		$(this).addClass("active").siblings().removeClass("active");
		$($(this).children("a").attr("href")).show().siblings().hide();
	});
	
  })
</script>
<div id="secondary" class="right-column">
<?php else:?>
<?php 
header("Location:".BLOG_URL.""); 
exit;
?> 
<?php endif; ?>
</div>
</div>
</div>
<?php include View::getView('side3');?>
</section>
<?php include View::getView('inc/ajax_login');?>
</div>
<?php include View::getView('footer');?>