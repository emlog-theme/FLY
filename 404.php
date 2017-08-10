<?php
/*
*404页面
*/
if(!defined('EMLOG_ROOT')) {exit('error!');}
require_once View::getView('module');
header("HTTP/1.0 404 Not Found");
include View::getView('header');?>
<style type="text/css">
.main4 {background-color: #FFFFFF;font-size: 14px;color: #666666;border-radius: 10px;padding: 10px 20px;list-style: none;border: #DFDFDF 1px solid;margin: 10px auto 30px;}
.image4 {margin:0 auto;text-align:center;}
.main4 p {line-height:25px;text-align:center;}
.main4 a {color:#fff;}
.time4 {color:#F60;font-weight:bold;}
@media (max-width:480px){.img4{width: 100%;}}
</style>
<section class="container">
<div class="main4">
<div class="image4"><img src="<?php echo TEMPLATE_URL; ?>img/404.png" class="img4"></div>
<p>抱歉，你所请求的页面不存在！</p>
<p>
<a class="btn btn-info" href="<?php echo BLOG_URL;?> ">返回首页</a>
</p>
</div>
</section>
<?php  include View::getView('footer');?>