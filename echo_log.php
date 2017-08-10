<?php 
/**
 * 阅读文章页面
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<section class="container">
	<div class="content-wrap">
		<div class="content">
			<!-- 内容开始 -->
			<article id="post-box">
					<div class="panel panel-sort">
						<header class="panel-header">
								<div class="post-meta-box">
									<!--面包屑导航开始-->
									<?php mianbao_navi($logid,$log_title);?>
									<!--面包屑导航结束-->
									<div class="meta-top">
						<span class="date-top"><i class="fa fa-calendar-check-o"></i> <time class="pubdate"><?php echo gmdate('Y年n月j日', $date); ?></time></span>
						<span class="comments-top"><i class="fa fa-comments-o"></i> <?php echo $comnum;?>条评论</span>
						<span class="close-sidebar" title="显示侧边栏"><a href="javascript:;"><i class="fa fa-toggle-off"></i></a></span>
                        <span class="show-sidebar" title="关闭侧边栏" style="display:none;"><a href="javascript:;"><i class="fa fa-toggle-on"></i></a></span>
					                </div>
								</div>
								<h2 class="post-title"><span class="fa fa-code"></span> <?php echo $log_title; ?></h2>
								<ul id="mobile-tab-menu" class="no-js-hide">
								<li class="current" data-tab="context">内容</li>
								<li class="" data-tab="comments">评论</li>
								<li class="" data-tab="related">相关</li>
								</ul>
						</header>
					<section class="context">
					    <?php if($sortid==$dy_id){
								if($_GET['ply'] != null){
									$db=Database::getInstance();
									$row= $db->once_fetch_array("SELECT * FROM ".DB_PREFIX."blog WHERE gid =$logid");
									$strarr = explode("\n",$row['spdz']);
									$u=$_GET['ply']-1;
									$urls= explode("*",$strarr[$u]);?>
								<div class="mv4"><h4>正在播放:<?php echo $log_title.'-'.$urls[0]; ?></h4><div>
								<p style="max-width:100%;height:500px;">
								<iframe frameborder="no" border="0" marginwidth="0" marginheight="0" width="100%" height="100%" src="https://pjax.cn/api/video/video.php?url=<?php echo $urls[1];?>&amp;moshi=sd&amp;hd=3">
								</iframe>
								</p>
								<div class="fanhui"><a href="<?php echo $logid;?>.html">返回</a></div>
							<?php }else{
									dyyinfo($logid);
									}
								}else{?>
						<?php echo unCompress(ishascomment($log_content,$logid)); ?>
						<?php doAction('down_log',$logid); ?>
						<?php }?>
					<div class="post-copyright">				
		                <p><b>版权声明：</b>若无特殊注明，本文皆为《<?php blog_author($author); ?>》原创，转载请保留文章出处。</p>
		                <p><b>本文链接：</b><?php echo $log_title; ?> - <?php echo Url::log($logid); ?></p>
		                <p class="sidetags"><b>本文标签：</b><?php blog_tag($logid);?></p>
		                <p class="qrcode"><a href="https://pan.baidu.com/share/qrcode?w=150&h=150&url=<?php echo URL::log($logid); ?>.jpg" class="highslide "><img src="https://pan.baidu.com/share/qrcode?w=150&h=150&url=<?php echo URL::log($logid); ?>.jpg" alt="<?php echo $log_title; ?>" title="用手机扫描二维码访问本页" class="qrcodeimg"></a></p>
	                </div>
					</section>
				</div>
			</article>
<!-- 内容结束 -->
<!-- 相关开始 -->
<div class="span12 related-posts-box mobile-hide">
			<div class="panel log_list panel-sort">
				<header class="panel-header">
					<h3 class="log_h3">
						<span class="fa fa-clipboard"></span> 相关文章
					</h3>
				</header>
				<ul class="related-posts row">
				<?php
					$Log_Model = new Log_Model();
					$randlogs = $Log_Model->getLogsForHome("AND sortid = {$sortid} ORDER BY rand() DESC,date DESC", 1,3);
					foreach($randlogs as $value):
					if(pic_thumb($value['content'])){
                        $imgsrc = pic_thumb($value['content']);
	                }elseif(getThumbnail($value['logid'])){
	                    $imgsrc = getThumbnail($value['logid']);
	                }else{
	                    $imgsrc = TEMPLATE_URL.'img/random/'.rand(1,4).'.jpg';
	                }
				?>
					<li class="col-sm-4">
						<div class="panel transparent related-posts-panel">
							<a href="<?php echo $value['log_url']; ?>" class="thumbnail-link" rel="bookmark" title="<?php echo $value['log_title']; ?>">
								<img src="<?php echo $imgsrc; ?>" class="thumbnailimg" width="175" height="80" title="<?php echo $value['log_title']; ?>" alt="<?php echo $value['log_title']; ?>">
								<div class="excerpt"><?php echo blog_tool_purecontent($value['content'], 92); ?></div>
							</a>
						<div class="bottom-box">
							<h4 class="post-title"><a href="<?php echo $value['log_url']; ?>" title="<?php echo $value['log_title']; ?>" rel="bookmark"><?php echo $value['log_title']; ?></a></h4>
							<ul class="post-meta">
							<li class="author">
							<span class="fa fa-user-o"></span>
							<?php blog_author($author); ?>
							</li>
							<li class="date date-abb">
							<span class="fa fa-clock-o"></span>
							<a href="#" title="发布于<?php echo gmdate('Y年n月j日', $date); ?>">
								<time><?php echo gmdate('Y-n-j', $date); ?></time>
							</a>
							</li>
							</ul>
						</div>
						</div>
					</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
<!-- 相关结束 -->
<!-- 评论开始 -->
	<?php if($allow_remark == 'y'): ?>
	<article class="span12 mobile-hide" id="comments">
	<div id="comments2" class="panel-comments panel-sort">
			<div id="respond" class="comment-respond">
			<?php blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark); ?>
			</div>
			<?php blog_comments($comments); ?>	
			<!-- #respond -->
		</div>
	</article>
	<?php endif;?>
<!-- 评论结束 -->
		</div>
	</div>
<?php include View::getView('side2');?>
</section>
<?php include View::getView('footer');?>


