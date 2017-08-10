<?php 
/**
 * 文章归档
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<section class="container">
  <div class="content-wrap">
    <div class="content container-tw">
        <header class="article-header">
            <h1 class="title-tw"><i class="fa fa-list"></i> <?php echo $log_title; ?><span class="toggler">折叠归档</span></h1>
        </header>
		<section class="context">
			<?php echo unCompress(ishascomment($log_content,$logid)); ?>
<?php
			function displayRecord(){
				global $CACHE; 
				$record_cache = $CACHE->readCache('record');
				$output = '';
				foreach($record_cache as $value){
					$output .= '<h4>'.$value['record'].'</h4>'.displayRecordItem($value['date']);
				}
				$output = '<div class="archives">'.$output.'</div>';
				return $output;
			}
			function displayRecordItem($record){
				if (preg_match("/^([\d]{4})([\d]{2})$/", $record, $match)) {
					$days = getMonthDayNum($match[2], $match[1]);
					$record_stime = strtotime($record . '01');
					$record_etime = $record_stime + 3600 * 24 * $days;
				} else {
					$record_stime = strtotime($record);
					$record_etime = $record_stime + 3600 * 24;
				}
				$sql = "and date>=$record_stime and date<$record_etime order by top desc ,date desc";
				$result = archiver_db($sql);
				return $result;
			}
			function archiver_db($condition = ''){
				$DB = MySql::getInstance();
				$sql = "SELECT gid, title, date, views FROM " . DB_PREFIX . "blog WHERE type='blog' and hide='n' $condition";
				$result = $DB->query($sql);
				$output = '';
				while ($row = $DB->fetch_array($result)) {
					$log_url = Url::log($row['gid']);
					if($row['views']>1000){$output .= '<li class="goodwork"><a title="热门文章" href="'.$log_url.'"><span>'.date('m月d日',$row['date']).'</span><div class="atitle">'.$row['title'].'</div></a></li>';}
					else{$output .= '<li><a href="'.$log_url.'"><span>'.date('m月d日',$row['date']).'</span><div class="atitle">'.$row['title'].'</div></a></li>';}
				}
				$output = empty($output) ? '<li>暂无文章</li>' : $output;
				$output = '<ul>'.$output.'</ul>';
				return $output;
			}
			echo displayRecord();
			?>
		</section>
	<!-- 评论开始 -->
	<?php if($allow_remark == 'y'): ?>
	<article class="span12" id="comments">
	<div id="comments2" class="panel-comments">
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