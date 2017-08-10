<?php 
/**
 * 音乐插件页面
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<section class="container">
  <div class="content-wrap">
    <div class="content container-tw">
        <header class="article-header">
            <h1 class="title-tw"><i class="fa fa-music"></i> 音乐</h1>
        </header>
		<section class="context">
			<?php echo unCompress(ishascomment($log_content,$logid)); ?>
		</section>
    </div>
  </div>
<?php include View::getView('side2');?>
</section>
<?php include View::getView('footer');?>