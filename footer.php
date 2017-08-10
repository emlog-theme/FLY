<?php 
/**
 * 页面底部信息
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<?php include View::getView('inc/ajax_login');?>
</div>
<footer class="footer">
  <div class="container copy-right">
    <div class="footer-tag-list">
        Copyright © 2017 <a href="<?php echo BLOG_URL; ?>"><?php echo $blogname; ?></a>
        <a href="http://www.miibeian.gov.cn" target="_blank"><?php echo $icp; ?></a>
        <?php echo $footer_info; ?>
    </div>
    <span><p>Powered by <a href="http://www.emlog.net" target="_blank">Emlog</a> · Theme by <a href="http://pjax.cn" target="_blank">Fianlly</a> </p> </span>
  </div>
</footer>
<div class="loading"><div class="loading1"><div class="block"></div><div class="block"></div><div class="block"></div><div class="block"></div></div></div>
<div onclick="tops()" class="backtop" style="display:none"><i class="fa fa-chevron-up"></i></div>
<link rel='stylesheet' id='set-css'  href='<?php echo TEMPLATE_URL; ?>css/set.css' type='text/css' media='all' />
<link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE_URL; ?>style/highslide/highslide.css" />
<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>style/highslide/highslide.js"></script>
<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>js/masonry.min.js"></script>
<script src="<?php echo TEMPLATE_URL; ?>js/main.js"></script>
<?php doAction('index_footer');?>
<?php doAction('index_bodys');?>
</body>
</html>
<?php
if($compress_html== 1 ){
        $html=ob_get_contents();
        ob_get_clean();
        echo em_compress_html_main($html);
}
?>
