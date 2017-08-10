<?php
/*
Template Name:FLY-free
Description:<font color=red>＊</font>该主题为Finally原创主题<br><font color=red>＊</font>采用Bootstrap框架<br><font color=red>＊</font>响应式设计,全站Pjax<br><font color=red>＊</font>该版本为免费开源版，不提供任何售后服务<br><a href="../?setting" target="_blank">设置</a>
Version:1.4
Author:Finally
Author Url:http://pjax.cn
Sidebar Amount:4
ForEmlog:5.3.1
*/
if(!defined('EMLOG_ROOT')) {exit('error!');}
require_once View::getView('inc/functions');
require_once View::getView('module');
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
	<meta charset="UTF-8">
	<meta name="generator" content="emlog" />
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="keywords" content="<?php echo $site_key; ?>">
	<meta name="description" content="<?php echo $site_description; ?>">
	<meta name="apple-mobile-web-app-title" content="<?php echo $blogname; ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <?php if(isset($sortName)): ?>
    <link rel="canonical" href="<?php echo Url::sort($sortid);?>" />
    <?php elseif(isset($logid)):?>
    <link rel="canonical" href="<?php echo Url::log($logid);?>" />
    <?php else:?><?php endif;?>
	<link rel="EditURI" type="application/rsd+xml" title="RSD" href="<?php echo BLOG_URL; ?>xmlrpc.php?rsd" />
	<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="<?php echo BLOG_URL; ?>wlwmanifest.xml" />
	<link rel="alternate" type="application/rss+xml" title="RSS"  href="<?php echo BLOG_URL; ?>rss.php" />
	<link rel="apple-touch-icon-precomposed" href="<?php echo TEMPLATE_URL; ?>favicon.ico">
	<title><?php echo $site_title; ?></title>
	<link rel="stylesheet" href="<?php echo TEMPLATE_URL; ?>css/font-awesome.min.css" type='text/css' media='all' />
	<link rel="stylesheet" href="<?php echo TEMPLATE_URL; ?>css/bootstrap.min.css" type='text/css' media='all' />
	<link rel="stylesheet" href="<?php echo TEMPLATE_URL; ?>css/style.css" type='text/css' media='all' />
	<script src="<?php echo TEMPLATE_URL; ?>js/jquery.min.js"></script>
    <script src="<?php echo TEMPLATE_URL; ?>js/jquery.pjax.js"></script>	
    <script src="<?php echo TEMPLATE_URL; ?>js/bootstrap.min.js"></script>	
	<?php doAction('index_head'); ?>
    <?php include View::getView('inc/head');?>
</head>
<body class="nav-fixed">
<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<a href="<?php echo BLOG_URL; ?>" class="navbar-brand logo"><img src="<?php echo $logo ?  $logo : ''.TEMPLATE_URL."img/logo.png";?>" alt="<?php echo $site_title; ?>"></a>
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
				<span class="fa fa-th-large"></span>
			</button>
		</div>
		<div class="collapse navbar-collapse" id="navbar-collapse">
			<!-- navbar-right -->
			<ul class="nav navbar-nav nav-top">
			<?php blog_navi();?>
			</ul>
			<div class="nav-hide">
			<!--搜索框开始-->
			<form action="<?php echo BLOG_URL; ?>" method="get" class="navbar-form navbar-right search-form">
				<div class="input-group">
					<input type="text" class="form-control search-text navsearch" name="keyword" placeholder="输入关键词搜索..." >
					<div class="input-group-btn">
						<button class="btn btn-default">搜索</button>
					</div>
				</div>
			</form>
			<!--搜索框结束-->
			</div>
		</div>

	</div>
</nav>
<div id="<?php echo get_template_name();?>">