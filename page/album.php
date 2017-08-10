<?php
/**
 * 相册插件页面
 */

define('isalbum', true);
$album = isset($_GET['album']) ? intval($_GET['album']) : '';
global $CACHE;
$DB = MySql::getInstance();
$options_cache = $CACHE->readCache('options');
$kl_album_info = $options_cache['kl_album_info'];
$kl_album_info = unserialize($kl_album_info);
if(is_array($kl_album_info)) krsort($kl_album_info);
if(!empty($kl_album_config['key'])) $site_key = $kl_album_config['key'];
$log_content .=	'<style>.box{padding:15px 0 0 15px;float:left}
.pic{padding:10px;border:1px solid #ccc;border-radius:5px;box-shadow:0 0 5px #ccc}
.pic img{width:185px;height:auto;margin:0!important;}</style>';
if ($album === '') {
    if(empty($kl_album_info)){
			$log_content = "还没有创建相册！";
		}else{
			$query1 = $DB->query("select a.* from (select album, addtime, id from ".DB_PREFIX."kl_album order by album, addtime desc, id desc) a group by album");
			$new_str_arr = array();
			while($row1 = $DB->fetch_array($query1)){
				$new_str_arr[$row1['album']] = time() - $row1['addtime'] < 3600*24*15 ? ' background:url('.BLOG_URL.'/content/plugins/kl_album/images/new.gif) no-repeat;' : '';
			}
            $log_content .=	'<div id="album"><ul>';
			foreach ($kl_album_info as $val){
				if($val['name'] == '') continue;
				if(ROLE != 'admin'){
					if($val['restrict'] == 'private') continue;
				}
				if($val['restrict'] == 'private'){
					$coverPath = 'images/only_me.jpg';
					$photo_size = array('w'=>100, 'h'=>100);
				}else{
					if(isset($val['head']) && $val['head'] != 0){
						$iquery = $DB->query("SELECT * FROM ".DB_PREFIX."kl_album WHERE id={$val['head']}");
						if($DB->num_rows($iquery) > 0){
							$irow = $DB->fetch_row($iquery);
							$coverPath = substr($irow[2], strpos($irow[2], 'upload/'), strlen($irow[2])-strpos($irow[2], 'upload/'));
							$photo_size = empty($val['w']) ? (function_exists('kl_album_change_image_size') ? kl_album_change_image_size($val['head'], EMLOG_ROOT.'/content/plugins/kl_album/'.$coverPath) : chImageSize(EMLOG_ROOT.'/content/plugins/kl_album/'.$coverPath, 100, 100)) : array('w'=>$val['w'], 'h'=>$val['h']);
						}else{
							$coverPath = 'images/no_cover_s.jpg';
							$photo_size = array('w'=>100, 'h'=>100);
						}
					}else{
						$iquery = $DB->query("SELECT * FROM ".DB_PREFIX."kl_album WHERE album={$val['addtime']}");
						if($DB->num_rows($iquery) > 0){
							$irow = $DB->fetch_array($iquery);
							$coverPath = substr($irow['filename'], strpos($irow['filename'], 'upload/'), strlen($irow['filename'])-strpos($irow['filename'], 'upload/'));
							$photo_size = empty($val['w']) ? (function_exists('kl_album_change_image_size') ? kl_album_change_image_size($irow['id'], EMLOG_ROOT.'/content/plugins/kl_album/'.$coverPath) : chImageSize(EMLOG_ROOT.'/content/plugins/kl_album/'.$coverPath, 100, 100)) : array('w'=>$val['w'], 'h'=>$val['h']);
						}else{
							$coverPath = 'images/no_cover_s.jpg';
							$photo_size = array('w'=>100, 'h'=>100);
						}
					}
				}
				$log_content .=	'<li><p class="cover"><a href="'.BLOG_URL.'album/?album='.$val['addtime'].'" title="'.$val['description'].'" style="background:url('.BLOG_URL.'/content/plugins/kl_album/'.$coverPath.') 50% 50% no-repeat;-moz-background-size:100% 100%; background-size:100% 100%; "></a></p><p class="title"><a href="'.BLOG_URL.'album/?album='.$val['addtime'].'" title="创建日期：'.$val['addtime'].'">'.$val['name'].'</a></p><p class="new" style=""></p></li>
';
			}
			$log_content .=	'</ul></div>';
		}
}

if ($album !== '') {
    $exist_album = false;
    		if(is_array($kl_album_info)){
			foreach ($kl_album_info as $val){
				if($val['addtime'] == $album){
					$albumrestrict = $val['restrict'];
					$albumname = $val['name'];
					$log_title .= ' - '.$albumname;
					$albumpwd = isset($val['pwd']) ? $val['pwd'] : '';
					$exist_album = true;
				}
			}
			if($exist_album === false || ($albumrestrict == 'private' && ROLE != 'admin')){
				$log_content .= '不存在的相册';
			}else{
				if($albumrestrict == 'protect' && ROLE != 'admin'){
					$postpwd = isset($_POST['albumpwd']) ? addslashes(trim($_POST['albumpwd'])) : '';
					$cookiepwd = isset($_COOKIE['kl_albumpwd_'.$album]) ? addslashes(trim($_COOKIE['kl_albumpwd_'.$album])) : '';
					kl_album_AuthPassword($postpwd, $cookiepwd, $albumpwd, $album, BLOG_URL.'?plugin=kl_album', 'kl_albumpwd_');
				}
				$kl_album = Option::get('kl_album_'.$album);
				if(is_null($kl_album)){
					$condition = " and album={$album} order by id desc";
				}else{
					$idStr = empty($kl_album) ? 0 : $kl_album;
					$condition = " and id in({$idStr}) order by substring_index('{$idStr}', id, 1)";
				}
				$query = $DB->query("SELECT * FROM ".DB_PREFIX."kl_album WHERE 1 {$condition}");
				$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
				$page_all_no = $DB->num_rows($query);
				$page_num = 500;
				$pageurl =  pagination($page_all_no, $page_num, $page, './?album='.$album.'&page=');
				$start_num = !empty($page) ? ($page - 1) * $page_num : 0;
				$query = $DB->query("SELECT * FROM ".DB_PREFIX."kl_album WHERE 1 {$condition} LIMIT $start_num, $page_num");
				$photos = array();
				while($photo = $DB->fetch_array($query)){
					$photo_size = empty($photo['w']) ? (function_exists('kl_album_change_image_size') ? kl_album_change_image_size($photo['id'], EMLOG_ROOT.substr($photo['filename'],2)) : chImageSize(EMLOG_ROOT.substr($photo['filename'],2), 100, 100)) : array('w'=>$photo['w'], 'h'=>$photo['h']);
					$log_content .=	'
					<div class="box"><div class="pic"> <a target="_blank" class="swipebox" href="'.BLOG_URL.str_replace('thum-', '', substr($photo['filename'], 1, strlen($photo['filename']))).'" title="相片名称：'.$photo['truename'].'　相片描述：'.$photo['description'].'"><img src="'.BLOG_URL.str_replace('thum-', '', substr($photo['filename'], 1, strlen($photo['filename']))).'"></a> </div></div>';
				}
			}
			$log_content .='<script>var $container = $(".context-album");$container.imagesLoaded(function() {$container.masonry({itemSelector: ".box",gutter: 8,isAnimated: true});});</script>';
		}else{
			$log_content .= '参数错误。';
		}
}
?>
<section class="container">
  <div class="content-wrap">
    <div class="content container-tw">
        <header class="article-header">
            <h1 class="title-tw"><i class="fa fa-picture-o"></i> <?php echo $log_title; ?></h1>
        </header>
		<section class="context context-album">
			<?php echo unCompress(ishascomment($log_content,$logid)); ?>
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