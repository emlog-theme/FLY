<?php 
/**
 * FLY.Theme by Finally
 */
if(!defined('EMLOG_ROOT')) {exit('error!');}
date_default_timezone_set('Asia/Shanghai');
if (PHP_VERSION < '5.0'){emMsg('您的php版本过低，请选用支持PHP5的环境配置。');}
require_once View::getView('inc/config');
global $arr_navico1;
$arr_navico1 = unserialize($arr_navico);
global $arr_sortico1;
$arr_sortico1 = unserialize($arr_sortico);
?>
<?php
//widget：blogger
function widget_blogger($title){
	global $CACHE;
    define('TEMROOT', EMLOG_ROOT.'/content/templates/'.get_template_name().'/inc');
    $config_file = TEMROOT.'/config.php';
    if (is_file($config_file)) {include $config_file;}
	$user_cache = $CACHE->readCache('user');
	$name = $user_cache[1]['mail'] != '' ? "<a href=\"mailto:".$user_cache[1]['mail']."\">".$user_cache[1]['name']."</a>" : $user_cache[1]['name'];
	$db = Database::getInstance();
    $sta_cache = array();
	$data = $db->once_fetch_array('SELECT COUNT(*) AS total FROM ' . DB_PREFIX . 'blog WHERE type = \'blog\'');
    $log_total = $data['total'];
    $data = $db->once_fetch_array('SELECT COUNT(*) AS total FROM ' . DB_PREFIX . 'comment');
    $log_com = $data['total'];
    $data = $db->once_fetch_array("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "twitter");
    $wei_yu = $data['total'];
	?>
	<li class="widget widget_ui_blogger">
	    <article class="panel-side">
	        <div class="fly_weibo">
        	<ul class="blogger_side">
        	    <div id="weiboShow">
        	        <div class="grid-weibo-show shadow-hover">
        		        <header id="shead">&nbsp;</header>
        		        <div id="user-login" class="contentt">
        			        <div class="avatar">
        	                	  <img src="<?php if($user_cache[1]['photo']['src']){echo BLOG_URL.$user_cache[1]['photo']['src'];}else{echo TEMPLATE_URL.'img/avatar.jpg';}?>">
        	                	<div class="overlay">
                                    <a href="#" class="expand" data-target="#myLogin" data-toggle="modal" data-backdrop="static" target="_blank">Login</a>
                                </div>
        				        <span class="rank"></span>
        			        </div>
        			        <h4><?php echo $title; ?></h4>
        			        <p class="seta"><?php echo $user_cache[1]['des']; ?></p>
        			        <a class="u-btn-submit f-tdn" href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?php echo $side_qq;?>&amp;site=qq&amp;menu=yes" target="_blank">有&nbsp;事&nbsp;请&nbsp;直&nbsp;接&nbsp;Q&nbsp;我</a>
        		        </div>
        		        <div id="user-div" class="contentt" style="display:none;">
        			        <div class="avatar">
        	                	  <img src="<?php if($user_cache[1]['photo']['src']){echo BLOG_URL.$user_cache[1]['photo']['src'];}else{echo TEMPLATE_URL.'img/avatar.jpg';}?>">
        				        <span class="rank"></span>
        			        </div>
                            <div class="sidebar-user row">
            					<div class="col-sm-6 sideli"><a href="<?php echo BLOG_URL;?>?setting"><i class="fa fa-television"></i> 模板设置</a></div>
            					<div class="col-sm-6 sideli"><a href="<?php echo BLOG_URL; ?>admin/twitter.php" target="_blank"><i class="fa fa-bullhorn"></i> 微语发布</a></div>
            					<div class="col-sm-6 sideli"><a href="<?php echo BLOG_URL; ?>admin/write_log.php" target="_blank"><i class="fa fa-pencil-square-o"></i> 发表文章</a></div>
            					<div class="col-sm-6 sideli"><a href="<?php echo BLOG_URL; ?>admin/comment.php" target="_blank"><i class="fa fa-commenting"></i> 评论管理</a></div>
            					<div class="col-sm-6 sideli"><a href="<?php echo BLOG_URL; ?>admin" target="_blank"><i class="fa fa-cogs"></i> 后台管理</a></div>
            					<div id="ajax_logout" class="col-sm-6 sideli"><a href="javascript:void(0);"  target="_blank"><i class="fa fa-sign-out"></i> 退出登陆</a></div>
                            </div>
        		        </div>
        		        <footer>
        					<ul class="blogger_footer">
        						<li><strong><?php echo $log_total;?></strong><span>文章</span></li>
        						<li><strong><?php echo $log_com;?></strong><span>评论</span></li>
        						<li><strong><?php echo $wei_yu;?></strong><span>微语</span></li>
        					</ul>
        		        </footer>
        	        </div>
                </div>
            </ul>
            </div>
	    </article>
	</li>
<?php }?>
<?php
//widget：日历
function widget_calendar($title){?>
<li class="widget widget_calendar">
  <div id="calendar_wrap"><?php echo calendar(); ?></div>
</li>
<?php }?>
<?php
//widget：标签
function widget_tag($title){
    global $CACHE;
    $tag_cache = $CACHE->readCache('tags');?>
    <li class="widget widget_ui_tags">
  <div class="widget-title"><span class="icon"><i class="fa fa-tags"></i></span>
    <h3><?php echo $title; ?></h3>
  </div>
    <div class="items">
        <?php shuffle ($tag_cache);
		$tag_cache = array_slice($tag_cache,0,30);foreach($tag_cache as $value): ?>
            <a href="<?php echo Url::tag($value['tagurl']); ?>"><?php echo $value['tagname']; ?> (<?php echo $value['usenum']; ?>)</a>
        <?php endforeach; ?>
        </div>
    </li>
<?php }?>
<?php
//widget：最新文章
function widget_newlog($title){
	global $CACHE; 
	$newLogs_cache = $CACHE->readCache('newlog');
	?>
    <li class="widget widget_posts_list">
	<article class="panel-side">
	<header class="panel-header"><span class="icon"><i class="fa fa-line-chart"></i></span>
	<h3 class="widget-title"><?php echo $title; ?></h3></header>
	<ul class="sidebar-posts-list">
        <?php foreach($newLogs_cache as $value): 
            $thum_src = getThumbnail($value['gid']);
            $imgsrc = getimgforgid($value['gid']);
            if($thum_src) {
                $img = $thum_src;
            }elseif($imgsrc){
                $img = $imgsrc;
            }else{
                $img = TEMPLATE_URL.'img/random/'.rand(1,4).'.jpg';
            }?>
	<li>
	<a href="<?php echo Url::log($value['gid']); ?>"  class="thumbnail-link" rel="bookmark" ><img src="<?php echo $img;?>" class="thumbnailside" width="50" height="50" title="<?php echo $value['title']; ?>" alt="<?php echo $value['title']; ?>"></a>
	<div class="right-box"><h4 class="side-title"><a href="<?php echo Url::log($value['gid']); ?>" data-toggle="tooltip" data-placement="bottom"  title="<?php echo $value['title']; ?>" rel="bookmark"><?php echo $value['title']; ?></a></h4>
	<ul class="side-meta">
	<li class="date date-abb">
	<span class="fa fa-clock-o"></span>
	<a href="<?php echo Url::log($value['gid']); ?>" title="发布于<?php echo gettime($value['gid']);?>">
	<time pubdate="pubdate"><?php echo gettime($value['gid']);?></time>
	</a>
	</li>
	<li class="views">
	<span class="fa fa-eye"></span>
	<a href="javascript:;" title="浏览了<?php echo blog_content($value['gid'],'views');?>次"><?php echo blog_content($value['gid'],'views');?></a>
	</li>
	</ul>
	</div>
	</li>
	<?php endforeach; ?>
    </ul>
	</article>
    </li>
<?php }?>
<?php
//widget：热门文章
function widget_hotlog($title){
	$index_hotlognum = Option::get('index_hotlognum');
	$Log_Model = new Log_Model();
	$hotLogs = $Log_Model->getHotLog($index_hotlognum);?>
    <li class="widget widget_posts_list">
	<article class="panel-side">
	<header class="panel-header"><span class="icon"><i class="fa fa-thumbs-o-up"></i></span>
	<h3 class="widget-title"><?php echo $title; ?></h3></header>
	<ul class="sidebar-posts-list">
	<?php foreach($hotLogs as $value): ?>
	<li><a href="<?php echo Url::log($value['gid']); ?>"><?php echo $value['title']; ?></a></li>
	<?php endforeach; ?>
    </ul>
	</article>
    </li>
<?php }?>
<?php
//widget：随机文章
function widget_random_log($title){
	$index_randlognum = Option::get('index_randlognum');
	$Log_Model = new Log_Model();
	$randLogs = $Log_Model->getRandLog($index_randlognum);?>
    <li class="widget widget_posts_list">
	<article class="panel-side">
	<header class="panel-header"><span class="icon"><i class="fa fa-random"></i></span>
	<h3 class="widget-title"><?php echo $title; ?></h3></header>
	<ul class="sidebar-randlog-list">
        <?php foreach($randLogs as $value): 
            $thum_src = getThumbnail($value['gid']);
            $imgsrc = getimgforgid($value['gid']);
            if($thum_src) {
                $img = $thum_src;
            }elseif($imgsrc){
                $img = $imgsrc;
            }else{
                $img = TEMPLATE_URL.'img/random/'.rand(1,4).'.jpg';
            }?>
	<li><a href="<?php echo Url::log($value['gid']); ?>" title="发布于<?php echo gettime($value['gid']);?>">
	<span class="thumbnails"><span><img src="<?php echo $img;?>" class="thumbs" alt="<?php echo $value['title']; ?>"></span></span>
	<span class="text"><?php echo $value['title']; ?></span></a>
	</li>
	<?php endforeach; ?>
    </ul>
	</article>
    </li>
<?php }?>
<?php
//widget：最新评论
function widget_newcomm($title){
    global $CACHE; 
    $com_cache = $CACHE->readCache('comment');
    ?>
    <li class="widget span12 widget_recent_comments">
	<article class="panel-side">
	<header class="panel-header"><span class="icon"><i class="fa fa-comments-o"></i></span>
	<h3 class="widget-title"><?php echo $title; ?></h3></header>
	<ul class="sidebar-comments-list show-avatars side-ul">
        <?php
        foreach($com_cache as $value):
        $url = Url::comment($value['gid'], $value['page'], $value['cid']);
        ?>
        <li>
            <a href="<?php echo $url; ?>" data-toggle="tooltip" data-placement="bottom" title="来自《<?php echo $value['name'];?>dalao》的评论">
                <img alt="<?php echo $value['name'];?>" src="<?php echo getqqpic($value['mail']);?>" class="avatar avatar-36 photo" height="36" width="36" > 
            </a>
            <div class="right-box"><p class="comment-text"><?php echo sidecomcontent($value['content']); ?></p></div>
        </li>
        <?php endforeach; ?>
    </ul>
	</article>
    </li>
<?php }?>
<?php
//widget：搜索
function widget_search($title){ ?>
	<li class="widget">
  <div class="widget-title"><span class="icon"><i class="fa fa-search"></i></span>
    <h3><?php echo $title; ?></h3>
  </div>
    <ul class="list-unstyled souul">
        <form name="keyform" method="get" action="<?php echo BLOG_URL; ?>">
            <div class="input-group">
                <input name="keyword" value="请善用搜索功能" class="form-control search soutext" type="text" onfocus="if (value =='请善用搜索功能'){value =''}" onblur="if (value ==''){value='请善用搜索功能'}"/>
                <div class="input-group-btn"> <button class="btn btn-default soubtn">搜索</button> </div>
            </div>
        </form>
    </ul>
    </li>
<?php } ?>
<?php
//widget：归档
function widget_archive($title){
    global $CACHE; 
    $record_cache = $CACHE->readCache('record');
    ?>
    <li class="widget widget_archive">
  <div class="widget-title"><span class="icon"><i class="fa fa-th-list"></i></span>
    <h3><?php echo $title; ?></h3>
  </div>
    <ul class="row">
    <?php foreach($record_cache as $value): ?>
    <li class="col-sm-6 link-li"><a href="<?php echo Url::record($value['date']); ?>"><?php echo $value['record']; ?>(<?php echo $value['lognum']; ?>)</a></li>
    <?php endforeach; ?>
    </ul>
    </li>
<?php } ?>
<?php
//widget：自定义组件
function widget_custom_text($title, $content){ ?>
	<li class="widget widget_text">
	<div class="widget-title"><span class="icon"><i class="fa fa-th-large"></i></span>
        <h3><?php echo $title; ?></h3>
    </div>
		<div class="widget-zdy"><?php echo $content; ?></div>
	</li>
<?php } ?>
<?php
//widget：链接
function widget_link($title){
    global $CACHE; 
    $link_cache = $CACHE->readCache('link');
    //if (!blog_tool_ishome()) return;#只在首页显示友链去掉双斜杠注释即可
    ?>
    <div class="widget widget_links">
  <div class="widget-title"><span class="icon"><i class="fa fa-link"></i></span>
    <h3><?php echo $title; ?></h3>
  </div>
    <ul class="row">
        <?php foreach($link_cache as $value): ?>
        <li class="col-sm-4 link-li"><a href="<?php echo $value['url']; ?>" data-toggle="tooltip" title="<?php echo $value['des']; ?>" target="_blank"><i class="fa fa-angle-double-right"></i> <?php echo $value['link']; ?></a></li>
        <?php endforeach; ?>
    </ul>
    </div>
<?php }?>
<?php
//blog：导航
function blog_navi(){
    global $CACHE; 
    global $arr_navico1;
    global $arr_sortico1;
    define('TEMROOT', EMLOG_ROOT.'/content/templates/'.get_template_name().'/inc');
    $config_file = TEMROOT.'/config.php';
    if (is_file($config_file)) {include $config_file;}
    $navi_cache = $CACHE->readCache('navi');
            foreach($navi_cache as $value):
            $id=$value["id"];
            if ($value['pid'] != 0) {
                continue;
            }
            $newtab = $value['newtab'] == 'y' ? 'target="_blank"' : '';
            $value['url'] = $value['isdefault'] == 'y' ? BLOG_URL . $value['url'] : trim($value['url'], '/');
			$current_tab = BLOG_URL . trim(Dispatcher::setPath(), '/') == $value['url'].'?_pjax=%23'.get_template_name() ? 'active' : '';
            ?>
            <li class="<?php if (!empty($value['children']) || !empty($value['childnavi'])) :?>dropdown<?php endif;?><?php echo $current_tab;?>" >
                <a href="<?php echo $value['url']; ?>" <?php echo $newtab;?>  <?php if (!empty($value['children']) || !empty($value['childnavi'])) :?>class="dropdown-toggle" data-toggle="dropdown"<?php endif;?> >
				<?php if(empty($arr_navico1[$id])) {echo $value['naviname'];}else {echo "<i class='".$arr_navico1[$id]."'></i> ".$value['naviname']."";} ?>
				<?php if (!empty($value['children']) || !empty($value['childnavi'])) :?>
				<span class="caret"></span>
				<?php endif;?>                
				</a>
				<?php if (!empty($value['children'])) :?>
                <ul class="dropdown-menu">
                    <?php foreach ($value['children'] as $row){
                            echo '<li><a href="'.Url::sort($row['sid']).'"><i class="'.$arr_sortico1[$row['sid']].'"></i> '.$row['sortname'].'</a></li>';
                    }?>
                </ul>
                <?php endif;?>
                <?php if (!empty($value['childnavi'])) :?>
                <a href="<?php echo $value['url']; ?>" <?php echo $newtab;?>><?php echo $value['naviname']; ?> <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <?php foreach ($value['childnavi'] as $row){
                            $newtab = $row['newtab'] == 'y' ? 'target="_blank"' : '';
                            echo '<li><a href="' . $row['url'] . "\" $newtab >" . $row['naviname'].'</a></li>';
                    }?>
                </ul>
                <?php endif;?>
            </li>
            <?php endforeach; ?>
            <?php if($more== 1 ){?>
            <li class="dropdown">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-info-circle"></i> 更多 <span class="caret"></span> </a>
                <ul class="dropdown-menu">
                    <?php echo $more_html;?>
                </ul>
            </li>
            <?php }?>
<?php }?>
<?php
//blog-tool:判断是否是首页
function blog_tool_ishome(){
    if (BLOG_URL . trim(Dispatcher::setPath(), '/') == BLOG_URL.'?_pjax=%23'.get_template_name() || BLOG_URL . trim(Dispatcher::setPath(), '/') == BLOG_URL){
        return true;
    } else {
        return FALSE;
    }
}
//外链IP库 支持https
function get_ips($commentip){
	$ip = @file_get_contents("https://ipip.yy.com/get_ip_info.php?ip=".$commentip."");
	$gs=json_decode(ltrim(rtrim($ip, ";"), "var returnInfo = "),true);
	echo $gs['country'].' '.$gs['province'].' '.$gs['city'];
}
//本地IP库
function get_ip($ip) { $dat_path = EMLOG_ROOT.'/ip.dat'; //*数据库路径*//
if(!$fd = @fopen($dat_path, 'rb')){ return 'IP数据库文件不存在或者禁止访问或者已经被删除！';   
    } $ip = explode('.', $ip); $ipNum = $ip[0] * 16777216 + $ip[1] * 65536 + $ip[2] * 256 + $ip[3]; $DataBegin = fread($fd, 4); $DataEnd = fread($fd, 4); $ipbegin = implode('', unpack('L', $DataBegin)); if($ipbegin < 0) $ipbegin += pow(2, 32); $ipend = implode('', unpack('L', $DataEnd)); if($ipend < 0) $ipend += pow(2, 32); $ipAllNum = ($ipend - $ipbegin) / 7 + 1; $BeginNum = 0; $EndNum = $ipAllNum; while($ip1num>$ipNum || $ip2num<$ipNum) { $Middle= intval(($EndNum + $BeginNum) / 2); fseek($fd, $ipbegin + 7 * $Middle); $ipData1 = fread($fd, 4); if(strlen($ipData1) < 4) { fclose($fd); return '系统出错！';   
        } $ip1num = implode('', unpack('L', $ipData1)); if($ip1num < 0) $ip1num += pow(2, 32); if($ip1num > $ipNum) { $EndNum = $Middle; continue;   
        } $DataSeek = fread($fd, 3); if(strlen($DataSeek) < 3) { fclose($fd); return '系统出错！';   
        } $DataSeek = implode('', unpack('L', $DataSeek.chr(0))); fseek($fd, $DataSeek); $ipData2 = fread($fd, 4); if(strlen($ipData2) < 4) { fclose($fd); return '系统出错！';   
        } $ip2num = implode('', unpack('L', $ipData2)); if($ip2num < 0) $ip2num += pow(2, 32); if($ip2num < $ipNum) { if($Middle == $BeginNum) { fclose($fd); return '未知';   
            } $BeginNum = $Middle;   
        }   
    } $ipFlag = fread($fd, 1); if($ipFlag == chr(1)) { $ipSeek = fread($fd, 3); if(strlen($ipSeek) < 3) { fclose($fd); return '系统出错！';   
        } $ipSeek = implode('', unpack('L', $ipSeek.chr(0))); fseek($fd, $ipSeek); $ipFlag = fread($fd, 1);   
    } if($ipFlag == chr(2)) { $AddrSeek = fread($fd, 3); if(strlen($AddrSeek) < 3) { fclose($fd); return '系统出错！';   
        } $ipFlag = fread($fd, 1); if($ipFlag == chr(2)) { $AddrSeek2 = fread($fd, 3); if(strlen($AddrSeek2) < 3) { fclose($fd); return '系统出错！';   
            } $AddrSeek2 = implode('', unpack('L', $AddrSeek2.chr(0))); fseek($fd, $AddrSeek2);   
        } else { fseek($fd, -1, SEEK_CUR);   
        } while(($char = fread($fd, 1)) != chr(0)) $ipAddr2 .= $char; $AddrSeek = implode('', unpack('L', $AddrSeek.chr(0))); fseek($fd, $AddrSeek); while(($char = fread($fd, 1)) != chr(0)) $ipAddr1 .= $char;   
    } else { fseek($fd, -1, SEEK_CUR); while(($char = fread($fd, 1)) != chr(0)) $ipAddr1 .= $char; $ipFlag = fread($fd, 1); if($ipFlag == chr(2)) { $AddrSeek2 = fread($fd, 3); if(strlen($AddrSeek2) < 3) { fclose($fd); return '系统出错！';   
            } $AddrSeek2 = implode('', unpack('L', $AddrSeek2.chr(0))); fseek($fd, $AddrSeek2);   
        } else { fseek($fd, -1, SEEK_CUR);   
        } while(($char = fread($fd, 1)) != chr(0)){ $ipAddr2 .= $char;   
        }   
    } fclose($fd); if(preg_match('/http/i', $ipAddr2)) { $ipAddr2 = '';   
    } $ipaddr = "$ipAddr1 $ipAddr2"; $ipaddr = preg_replace('/CZ88.Net/is', '', $ipaddr); $ipaddr = preg_replace('/^s*/is', '', $ipaddr); $ipaddr = preg_replace('/s*$/is', '', $ipaddr); if(preg_match('/http/i', $ipaddr) || $ipaddr == '') { $ipaddr = '未知';   
    } $ipaddr = iconv('gbk', 'utf-8//IGNORE', $ipaddr); if( $ipaddr != '  ' ) return $ipaddr; else $ipaddr = '评论者来自火星，无法或者其所在地!'; return $ipaddr;   
}
//查看该用户是否评论
function ishascomment($content,$post_id){
	if(preg_match_all('|\[hide\]([\s\S]*?)\[\/hide\]|i', $content, $hide_words)){
		if($_COOKIE['postermail'] && $_COOKIE['postermail'] != ''){
			$r = MySql::getInstance();
			$row=$r->once_fetch_array("SELECT * FROM  `".DB_NAME."`.`".DB_PREFIX."comment` WHERE `mail` =  '".$_COOKIE['postermail']."' and `gid` = '".$post_id."' ORDER BY `date` DESC");
		}else if($_COOKIE['posterurl'] && $_COOKIE['posterurl'] != ''){
			$r = MySql::getInstance();
			$row=$r->once_fetch_array("SELECT * FROM  `".DB_NAME."`.`".DB_PREFIX."comment` WHERE `url` =  '".$_COOKIE['posterurl']."' and `gid` = '".$post_id."' ORDER BY `date` DESC");
		}
		if($row && (time()-$row['date']) <= 3600*24 && $row['hide'] == 'n' || ROLE == "admin"){ //通过的评论在24小时之内
			$content = str_replace($hide_words[0],$hide_words[1], $content);
		}else{
			$hide_notice = '<div style="text-align:center;border:1px dashed #5db8f8;padding:8px;margin:10px auto;color:#5db8f8;">管理员设置<a href="#comment">回复</a>可见隐藏内容</div>';
			$content = str_replace($hide_words[0], $hide_notice, $content); 
		}
	}
	return $content;
}
//图片链接
function pic_thumb($content){
    preg_match_all("|<img[^>]+src=\"([^>\"]+)\"?[^>]*>|is", $content, $img);
    $imgsrc = !empty($img[1]) ? $img[1][0] : '';
	if($imgsrc):
		return $imgsrc;
	endif;
}
//获取附件第一张图片
function getThumbnail($blogid){
    $db = MySql::getInstance();
    $sql = "SELECT * FROM ".DB_PREFIX."attachment WHERE blogid=".$blogid." AND (`filepath` LIKE '%jpg' OR `filepath` LIKE '%gif' OR `filepath` LIKE '%png') ORDER BY `aid` ASC LIMIT 0,1";
    //die($sql);
    $imgs = $db->query($sql);
    $img_path = "";
	if(mysql_num_rows($imgs)){
		while($row = $db->fetch_array($imgs)){
			 $img_path .= BLOG_URL.substr($row['filepath'],3,strlen($row['filepath']));
		}
	}else{
		$img_path = false;
	}
    return $img_path;
}
//格式化内容工具
function blog_tool_purecontent($content, $strlen = null){
        $content = str_replace('继续阅读&gt;&gt;', '', strip_tags($content));
        if ($strlen) {
            $content = subString($content, 0, $strlen);
        }
        return $content;
}
//分页函数
function fly_page($count,$perlogs,$page,$url,$anchor=''){
$pnums = @ceil($count / $perlogs);
$page = @min($pnums,$page);
$prepg=$page-1;
$nextpg=($page==$pnums ? 0 : $page+1);
$urlHome = preg_replace("|[\?&/][^\./\?&=]*page[=/\-]|","",$url);
$re = "<ul class=\"pagination\">";
if($pnums<=1) return false;		
if($page!=1) $re .=" <li><a href=\"$urlHome$anchor\">首页</a></li> "; 
if($prepg) $re .=" <li class=\"prev-page\"><a href=\"$url$prepg$anchor\" >上一页</a></li> ";
for ($i = $page-2;$i <= $page+2 && $i <= $pnums; $i++){
if ($i > 0){if ($i == $page){$re .= " <li class=\"active\"><span>$i</span></li>";
}elseif($i == 1){$re .= " <li><a href=\"$urlHome$anchor\">$i</a></li>";
}else{$re .= " <li><a href=\"$url$i$anchor\">$i</a></li> ";}
}}
if($nextpg) $re .=" <li class=\"next-page\"><a href=\"$url$nextpg$anchor\">下一页</a></li> "; 
if($page!=$pnums) $re.=" <li><a href=\"$url$pnums$anchor\" title=\"尾页\">尾页</a></li>";
$re .="<li><span>共 $pnums 页</span></li>";
$re .="</ul>";
return $re;}
//blog：文章作者
function index_author($uid){
	global $CACHE;
	$user_cache = $CACHE->readCache('user');
	$author = $user_cache[$uid]['name'];
	echo "<span class=\"authors\">作者: <a href=\"".Url::author($uid)."\" title=\"查看关于 {$author} 的文章\">$author</a></span>";
}
//blog：文章作者
function blog_author($uid){
	global $CACHE;
	$user_cache = $CACHE->readCache('user');
	$author = $user_cache[$uid]['name'];
	if($uid==1){
		$ri='管理员';
	}else{
		$ri='站内会员';
	}
	echo "<a href=\"".Url::author($uid)."\" title=\"$ri\">$author</a>";
}
//blog：文章标签
function blog_tag($blogid){
	global $CACHE;
	$log_cache_tags = $CACHE->readCache('logtags');
	if (!empty($log_cache_tags[$blogid])){
		$tag = '';
		foreach ($log_cache_tags[$blogid] as $value){
			$tag .= "<a rel=\"tag\" href=\"".Url::tag($value['tagurl'])."\">".$value['tagname'].'</a>';
		}
		echo $tag; }
	else {$tag = '这篇文章木有标签';
		echo $tag;}
}
//字符转换
function number($ssbb) {
	$patterns = array ("0","1","2","3","4","5","6","7","8","9"); 
	$replace = array ("零","一","二","三","四","五","六","七","八","九");
	$ssbb=str_replace($patterns, $replace, $ssbb);
	return $ssbb;
}
//侧边栏日历获取
 function calendar() {
	$DB = Database::getInstance();
	$timezone = Option::get('timezone');
	$timestamp = time() + $timezone * 3600;
	
	$query = $DB->query("SELECT date FROM ".DB_PREFIX."blog WHERE hide='n' and checked='y' and type='blog'");
	while ($date = $DB->fetch_array($query)) {
		$logdate[] = gmdate("Ymd", $date['date'] + $timezone * 3600);
	}
	$n_year  = gmdate("Y", $timestamp);
	$n_year2 = number(gmdate("Y", $timestamp));
	$n_month = gmdate("m", $timestamp);
	$n_day   = gmdate("d", $timestamp);
	$time    = gmdate("Ymd", $timestamp);
	$year_month = gmdate("Ym", $timestamp);
	
	if (isset($_GET['record'])) {
		$n_year = substr(intval($_GET['record']),0,4);
		$n_year2 = substr(intval($_GET['record']),0,4);
		$n_month = substr(intval($_GET['record']),4,2);
		$year_month = substr(intval($_GET['record']),0,6);
	}
	
	$m  = $n_month - 1;
	$mj = $n_month + 1;
	$m  = ($m < 10) ? '0' . $m : $m;
	$mj = ($mj < 10) ? '0' . $mj : $mj;
	$year_up = $n_year;
	$year_down = $n_year;
	if ($mj > 12) {
		$mj = '01';
		$year_up = $n_year + 1;
	}
	if ( $m < 1) {
		$m = '12';
		$year_down = $n_year - 1;
	}
	$url = DYNAMIC_BLOGURL.'?action=cal&record=' . ($n_year - 1) . $n_month;
	$url2 = DYNAMIC_BLOGURL.'?action=cal&record=' . ($n_year + 1) . $n_month;
	$url3 = DYNAMIC_BLOGURL.'?action=cal&record=' . $year_down . $m;
	$url4 = DYNAMIC_BLOGURL.'?action=cal&record=' . $year_up . $mj;

	$calendar ="<table id=\"calendar\"><caption>{$n_year2}年{$n_month}月</caption><thead><tr><th scope=\"col\" title=\"星期一\">一</th><th scope=\"col\" title=\"星期二\">二</th><th scope=\"col\" title=\"星期三\">三</th><th scope=\"col\" title=\"星期四\">四</th><th scope=\"col\" title=\"星期五\">五</th><th scope=\"col\" title=\"星期六\">六</th><th scope=\"col\" title=\"星期日\">日</th></tr></thead><tbody>";
		
	$week = @gmdate("w",gmmktime(0,0,0,$n_month,1,$n_year));
	$lastday = @gmdate("t",gmmktime(0,0,0,$n_month,1,$n_year));
	$lastweek = @gmdate("w",gmmktime(0,0,0,$n_month,$lastday,$n_year));
	if ($week == 0) {
		$week = 7;
	}
	$j = 1;
	$w = 7;
	$isend = false;
	for ($i = 1;$i <= 6;$i++) {
		if ($isend || ($i == 6 && $lastweek==0)) {
			break;
		}
		$calendar .= '<tr>';
		for ($j ; $j <= $w; $j++) {
			if ($j < $week) {
				$calendar.= '<td>&nbsp;</td>';
			} elseif ( $j <= 7 ) {
				$r = $j - $week + 1;
				$n_time = $n_year . $n_month . '0' . $r;
				if (@in_array($n_time,$logdate) && $n_time == $time) {
					$calendar .= '<td id="today">'. $r .'</td>';
				} elseif (@in_array($n_time,$logdate)) {
					$calendar .= '<td>'. $r .'</td>';
				} elseif ($n_time == $time) {
					$calendar .= '<td id="today">'. $r .'</td>';
				} else {
					$calendar.= '<td>'. $r .'</td>';
				}
			} else {
				$t = $j - ($week - 1);
				if ($t > $lastday) {
					$isend = true;
					$calendar .= '<td>&nbsp;</td>';
				} else {
					$t < 10 ? $n_time = $n_year . $n_month . '0' . $t : $n_time = $n_year . $n_month . $t;
					if (@in_array($n_time,$logdate) && $n_time == $time) {
						$calendar .= '<td id="today">'. $t .'</td>';
					} elseif(@in_array($n_time,$logdate)) {
						$calendar .= '<td>'. $t .'</td>';
					} elseif($n_time == $time) {
						$calendar .= '<td id="today">'. $t .'</td>';
					} else {
						$calendar .= '<td>'.$t.'</td>';
					}
				}
			}
		}
		$calendar .= '</tr>';
		$w += 7;
	}
	$calendar .= '</tbody></table>';
	echo $calendar;
}
//Custom：获取模板目录名称
function get_template_name(){
    $template_name = str_replace(BLOG_URL,"",TEMPLATE_URL);
    $template_name = str_replace("content/templates/","",$template_name);
    $template_name = str_replace("/","",$template_name);
    return $template_name;
}
//blog-tool:获取Gravatar头像并缓存到本地
function SB_getGravatar($email, $s=40, $d='monsterid', $r='g') {
    $f = md5($email);
    $a = TEMPLATE_URL.'img/avatar/'.$f.'.jpg';
    $e = EMLOG_ROOT.'/content/templates/'.get_template_name().'/img/avatar/'.$f.'.jpg';
    $t = 1296000; //15天，单位：秒
    if (empty($d)) $d = TEMPLATE_URL.'img/avatar/default.jpg';
    if (!is_file($e) || (time() - filemtime($e)) > $t ) {
        //当头像不存在或者超过15天才更新
        $g = sprintf("https://secure.gravatar.com",(hexdec($f{0})%2)).'/avatar/'.$f.'?s=48&d='.$d.'&r='.$r;
        copy($g,$e); $a=$g; //新头像copy时, 取gravatar显示
    }
    if (filesize($e) < 500) copy($d,$e);
    return $a;
}
//吐槽水军
function guest($num){
	global $CACHE;
	$user_cache = $CACHE->readCache('user');
	$name = $user_cache[1]['name'];
	$DB = Database::getInstance();
	$sql = "SELECT count(*) AS comment_nums,poster,mail,url FROM ".DB_PREFIX."comment where date >0 and poster !='". $name ."' and  poster !='' and hide ='n' group by poster order by comment_nums DESC limit 0,$num";
	$log_content = $content[1];
	if(strpos($log_content, '[READERWALL-WEEK]') > -1) {
		$cur_time_span = strtotime('last Year',strtotime('Sunday'));
	}
	$result = $DB -> query( $sql );
	while($row = $DB -> fetch_array($result)){
		$img = "<li><a rel=\"external nofollow\" target=\"_blank\" href=\"" . $row[ 'url' ] . "\" title=\"" . $row[ 'poster' ] ."(赐教" . $row[ 'comment_nums' ] . "次)\"><img  alt=\"avatar\"  src=\"" . getqqpic($row['mail']) . "\" class=\"avatar\"><em>" . $row[ 'poster' ] ."</em><strong>+" . $row[ 'comment_nums' ] . "</strong></a></li>";
		if( $row[ 'url' ] ){
			$tmp = "<li><a rel=\"external nofollow\" target=\"_blank\" href=\"" . $row[ 'url' ] . "\" title=\"" . $row[ 'poster' ] ."(吐槽" . $row[ 'comment_nums' ] . "次)<br>" . $row[ 'url' ] . "\" ><img  alt=\"avatar\"  src=\"" . getqqpic($row['mail']) . "\"><em>" . $row[ 'poster' ] ."</em><strong>+" . $row[ 'comment_nums' ] . "</strong></a></li>";
		}else{
			$tmp = $img;
		}
		$output .= $tmp;
	}
	$output = ''. $output .'';
	return $output ;
}
//获取头像
function getqqpic($email){
	$qq = explode('@',$email);
            $pic = 'https://q2.qlogo.cn/headimg_dl?dst_uin='.$qq[0].'&spec=100';
            $pic = $qq[1] =='qq.com' ? $pic : $pic = SB_getGravatar($email);
	return $pic;
}
//评论内容
function comcontent($pl) {
	$patterns = array ("/@/","/\[blockquote\](.*?)\[\/blockquote\]/","/\[F(([1-4]?[0-9])|50)\]/"); 
	$replace = array ('回复了','<blockquote>$1</blockquote>','<img alt="表情" src="'.TEMPLATE_URL.'img/face/$1.gif" />'); 
	$pl=preg_replace($patterns, $replace, $pl);
	return $pl;
}
//侧边栏评论
function sidecomcontent($pl) {
	$patterns = array ("/@/","/\[blockquote\](.*?)\[\/blockquote\]/","/\[F(([1-4]?[0-9])|50)\]/"); 
	$replace = array ('回复了','<small>$1</small>','<img alt="表情" src="'.TEMPLATE_URL.'img/face/$1.gif" />'); 
	$pl=preg_replace($patterns, $replace, $pl);
	return $pl;
}
//获取blog表的一条内容,$content填写表名
function blog_content($gid,$content){
    $db = Database::getInstance();
    $sql = 'SELECT * FROM ' . DB_PREFIX . "blog WHERE gid='".$gid."'";
    $sql = $db->query($sql);
    while ($row = $db->fetch_array($sql)) {
        $content = $row[$content];
	}
    return $content;
}
//内容页标签
function neirong_tag($blogid){
	global $CACHE;
	$log_cache_tags = $CACHE->readCache('logtags');
	if (!empty($log_cache_tags[$blogid])){
		foreach ($log_cache_tags[$blogid] as $value){
			$tag .= "<a class=\"label fcolor\" href=\"".Url::tag($value['tagurl'])."\"> ".$value['tagname'].'</a>';
		}
		return $tag;
	}
}
//正则去除HTML
function ClearHtml($content) {  
   $preg = "/<\/?[^>]+>/i";
   return preg_replace($preg,'',$content);
}
//数据库报错用
function getimgforgids($gid){
    $db = Database::getInstance();
    $sql = 'SELECT content FROM ' . DB_PREFIX . "blog WHERE gid='".$gid."'";
	$d = $db->once_fetch_array($sql);

	return isset($d['content']) && preg_match("|<img[^>]+src=\"([^>\"]+)\"?[^>]*>|is", $d['content'], $img) ? $img[1] : false;
}
function getimgforgid($gid){
    $db = Database::getInstance();
    $sql = 'SELECT * FROM ' . DB_PREFIX . "blog WHERE gid='".$gid."'";
    $img = $db->query($sql);
	$imgsrc = false;
	if($img){
		while ($row = $db->fetch_array($img)) {
			$content = $row['content'];
			$imgsrc = preg_match_all("|<img[^>]+src=\"([^>\"]+)\"?[^>]*>|is", $content, $img);
			$imgsrc = !empty($img[1]) ? $img[1][0] : '';
		}
	}
    return $imgsrc;
}
function gettime($id){
	$db = Database::getInstance();
	$sql = 'SELECT * FROM ' . DB_PREFIX . "blog WHERE gid='".$id."'";
	$date = $db->query($sql);
	while ($row = $db->fetch_array($date)) {
		$time = date('Y-m-d',$row['date']);
	}
	return $time;
}
?>
<?php
//blog：分类
function blog_sort($blogid){
	global $CACHE; 
	$log_cache_sort = $CACHE->readCache('logsort');
	?>
	<?php if(!empty($log_cache_sort[$blogid])): ?>
    <a href="<?php echo Url::sort($log_cache_sort[$blogid]['id']); ?>" pjax="<?php echo $log_cache_sort[$blogid]['name']; ?>" title="查看<?php echo $log_cache_sort[$blogid]['name']; ?>下的全部文章"><?php echo $log_cache_sort[$blogid]['name']; ?> </a>
	<?php else:?>
	未分类
	<?php endif;?>
<?php }?>
<?php
//blog：面包屑导航
function mianbao_navi($blogid,$log_title){
	global $CACHE; 
	$log_cache_navi = $CACHE->readCache('logsort');
	?>
	<ol class="breadcrumb">
	<li><a href="<?php echo BLOG_URL; ?>">首页</a></li> 
	<li>
	<?php if(!empty($log_cache_navi[$blogid])): ?>
    <a class="cat" href="<?php echo Url::sort($log_cache_navi[$blogid]['id']); ?>"><?php echo $log_cache_navi[$blogid]['name']; ?></a>
	</li>
	<?php else:?>
	未分类
	<?php endif;?>
	<li class="active"><?php echo $log_title; ?></li></ol>
<?php }?>
<?php
//首页热门幻灯片获取指定分类
function index_fous($sort){
	global $CACHE;
	$sort_cache = $CACHE->readCache('sort');
	$db = Database::getInstance();
	$show = '';
	$show .='<article class="focusmo"><ul>';
	$list_1 = $db->query("SELECT * FROM " . DB_PREFIX . "blog WHERE sortid='".$sort."' AND type='blog' AND hide='n' order by date DESC limit 0,1");
		while($first = $db->fetch_array($list_1)){
			if(pic_thumb($first['content'])){
				$imgsrc = pic_thumb($first['content']);
			}else{
				$imgsrc = TEMPLATE_URL.'img/random/'.rand(1,4).'.jpg';
			}
	$show .= '<li class="large"><a href="'.Url::log($first['gid']).'"><img src="'.$imgsrc.'" class="thumb"><h4>'.$first['title'].'</h4></a></li>';
		}
	$list_2 = $db->query("SELECT * FROM " . DB_PREFIX . "blog WHERE sortid='".$sort."' AND type='blog' AND hide='n' order by date DESC limit 1,4");
		while($second = $db->fetch_array($list_2)){
			if(pic_thumb($second['content'])){
				$imgsrc = pic_thumb($second['content']);
			}else{
				$imgsrc = TEMPLATE_URL.'img/random/'.rand(1,4).'.jpg';
			}
	$show .= '<li><a href="'.Url::log($second['gid']).'"><img src="'.$imgsrc.'" class="thumb"><h4>'.$second['title'].'</h4></a></li>';
		}
	$show .='</ul></article>';
	return $show;
}
//blog：置顶
function topflg($top, $sortop='n', $sortid=null){
    if(blog_tool_ishome()) {
       return $top == 'y' ? true : false;
    } elseif($sortid){
       return $sortop == 'y' ? true : false;
    }
}
//代码压缩
function em_compress_html_main($buffer){
    $initial=strlen($buffer);
    $buffer=explode("<!--em-compress-html-->", $buffer);
    $count=count ($buffer);
    for ($i = 0; $i <= $count; $i++){
        if (stristr($buffer[$i], '<!--em-compress-html no compression-->')){
            $buffer[$i]=(str_replace("<!--em-compress-html no compression-->", " ", $buffer[$i]));
        }else{
            $buffer[$i]=(str_replace("\t", " ", $buffer[$i]));
            $buffer[$i]=(str_replace("\n\n", "\n", $buffer[$i]));
            $buffer[$i]=(str_replace("\n", "", $buffer[$i]));
            $buffer[$i]=(str_replace("\r", "", $buffer[$i]));
            while (stristr($buffer[$i], '  '))
            {
            $buffer[$i]=(str_replace("  ", " ", $buffer[$i]));
            }
        }
        $buffer_out.=$buffer[$i];
    }
    $final=strlen($buffer_out);
    $savings=($initial-$final)/$initial*100;
    $savings=round($savings, 2);
    $buffer_out.="\n<!--压缩前的大小: $initial bytes; 压缩后的大小: $final bytes; 节约：$savings% -->";
    return $buffer_out;
}

//pre不被压缩
function unCompress($content){
    if(preg_match_all('/(crayon-|<\/pre>)/i', $content, $matches)) {
        $content = '<!--em-compress-html--><!--em-compress-html no compression-->'.$content;
        $content.= '<!--em-compress-html no compression--><!--em-compress-html-->';
    }
    return $content;
}
//comment：输出评论人等级
function echo_levels($comment_author_email,$comment_author_url){
	$DB = Database::getInstance();
	global $CACHE;
	$user_cache = $CACHE->readCache('user'); 
	$adminEmail = '"'.$user_cache[1]['mail'].'"';
	if($comment_author_email==$adminEmail){
		echo '<a class="admin" title="这货就是管理员"><img src="'.TEMPLATE_URL.'img/admin.png"></a>';
	}
	$sql = "SELECT cid as author_count,mail FROM ".DB_PREFIX."comment WHERE mail != '' and mail = $comment_author_email and hide ='n'";
	$res = $DB->query($sql);
	$author_count = mysql_num_rows($res);
	if($author_count>=0 && $author_count<5 && $comment_author_email!=$adminEmail)
		echo '<a class="vip1" title="VIP等级：初入联盟 LV.1"><i class="pro"></i><i class="level">Lv.1</i></a>';
	else if($author_count>=5 && $author_count<10 && $comment_author_email!=$adminEmail)
		echo '<a class="vip2" title="VIP等级：英勇黄铜 LV.2"><i class="pro"></i><i class="level">Lv.2</i></a>';
	else if($author_count>=10 && $author_count<20 && $comment_author_email!=$adminEmail)
		echo '<a class="vip3" title="VIP等级：不屈白银 LV.3"><i class="pro"></i><i class="level">Lv.3</i></a>';
	else if($author_count>=20 && $author_count<30 && $comment_author_email!=$adminEmail)
		echo '<a class="vip4" title="VIP等级：华贵铂金 LV.4"><i class="pro"></i><i class="level">Lv.4</i></a>';
	else if($author_count>=30 &&$author_count<40 && $comment_author_email!=$adminEmail)
		echo '<a class="vip5" title="VIP等级：璀璨钻石 LV.5"><i class="pro"></i><i class="level">Lv.5</i></a>';
	else if($author_count>=40 && $author_coun<50 && $comment_author_email!=$adminEmail)
		echo '<a class="vip6" title="VIP等级：超凡大师 LV.6"><i class="pro"></i><i class="level">Lv.6</i></a>';
	else if($author_count>=50 && $author_coun<60 && $comment_author_email!=$adminEmail)
		echo '<a class="vip7" title="VIP等级：最强王者 LV.7"><i class="pro"></i><i class="level">Lv.7</i></a>';
	else if($author_count>=60 && $author_coun<70 && $comment_author_email!=$adminEmail)
		echo '<a class="vip8" title="VIP等级：职业选手 LV.8"><i class="pro"></i><i class="level">Lv.8</i></a>';
}
?>
<?php
//blog：评论列表
function blog_comments($comments){
    extract($comments);$comnum = count($comments);
	if($commentStacks):?>
	<header class="panel-header">
		<h3 class="log_h3">
			<span class="fa fa-angellist"></span> 评论</h3>
			<span class="right"><span class="comments-number"><?php echo $comnum; ?></span>条评论</span>
	</header>
	<ol class="comments-list show-avatars">
	<?php endif; ?>
	<?php
    $count_comments = count($comments);
    $count_floors = $count_comments;
    foreach($comments as $value){
        if($value['pid'] != 0){ $count_floors--; }
    }
    $page = isset($params[5])?intval($params[5]):1;
    $i= $count_floors - ($page - 1)*Option::get('comment_pnum');
	$isGravatar = Option::get('isgravatar');
	foreach($commentStacks as $cid):
    $comment = $comments[$cid];
	global $CACHE;$user_cache = $CACHE->readCache('user');$name = $user_cache[1]['name'];
	$comment['poster'] = $comment['url'] ? '<a href="'.$comment['url'].'" target="_blank" rel="external nofollow" class="url">'.$comment['poster'].'</a>' : $comment['poster'];
	?>
	<li class="comment even thread-odd thread-alt depth-1 show-avatars" id="comment-<?php echo $comment['cid']; ?>">
	    <article id="comment-box-<?php echo $comment['cid']; ?>" class="comment-box">
			<?php if($isGravatar == 'y'): ?>
			<img srcset="<?php echo getqqpic($comment['mail']);?>" alt="avatar" class="avatar avatar-42 photo" height="42" width="42"/><?php endif; ?>
			<div class="right-box">
			    <p class="comment-meta"> <span class="author"><?php echo $comment['poster']; ?> <?php echo echo_levels("\"".strip_tags($comment['mail'])."\"","\"".$comment['url']."\"");?></span> <span class="useragent"><?php if(function_exists('display_useragent')){display_useragent($comment['cid']);} ?></span> <span class="reply"><i rel="nofollow" class="comment-reply-link" href="#comment-<?php echo $comment['cid']; ?>" onclick="commentReply(<?php echo $comment['cid']; ?>,this)" aria-label="回复"><span class="fa fa-reply-all"></span> 回复</i></span></p>
			    <p><?php echo comcontent($comment['content']); ?></p>
			    <p class="time"><span class="sign"><span class='fa fa-desktop'></span> <?php echo get_ip($comment['ip']);?></span> <time pubdate="pubdate"><span class="fa fa-clock-o"></span> <?php echo $comment['date']; ?></time></p>
			</div>
		</article>
		<ol class="children"><?php blog_comments_children($comments, $comment['children']); $ii=0;?></ol>
	</li>
	<?php $i--;endforeach; ?>
	</ol>
    <nav class="comments-list-nav page-navi">
		<?php echo $commentPageUrl;?>
		<?php if($commentPageUrl): ?>
		<?php endif; ?>
    </nav>
<?php }?>
<?php
//blog：子评论列表
function blog_comments_children($comments, $children){
	$isGravatar = Option::get('isgravatar');
	foreach($children as $child):
	$comment = $comments[$child];
	global $CACHE;$user_cache = $CACHE->readCache('user');$name = $user_cache[1]['name'];
	$comment['poster'] = $comment['url'] ? '<a href="'.$comment['url'].'" target="_blank" rel="external nofollow" class="url">'.$comment['poster'].'</a>' : $comment['poster'];
	?>
	<li class="comment byuser comment-author-bing bypostauthor odd alt depth-2 show-avatars" id="comment-<?php echo $comment['cid']; ?>">
			<?php if($isGravatar == 'y'): ?>
			<article id="comment-box-492" class="comment-box">
			    <img alt="头像" srcset="<?php echo getqqpic($comment['mail']);?>" class="avatar avatar-42 photo" height="42" width="42">
			    <div class="right-box">
			        <p class="comment-meta"> <span class="author"><?php echo $comment['poster']; ?> <?php echo echo_levels("\"".strip_tags($comment['mail'])."\"","\"".$comment['url']."\"");?></span> <span class="useragent"><?php if(function_exists('display_useragent')){display_useragent($comment['cid']);} ?></span> <span class="reply"><i rel="nofollow" class="comment-reply-link" href="#comment-<?php echo $comment['cid']; ?>" onclick="commentReply(<?php echo $comment['cid']; ?>,this)" aria-label="回复"><span class="fa fa-reply-all"></span> 回复</i></span></p>
			        <p><?php echo comcontent($comment['content']); ?></p></div>
			        <p class="time"><span class="sign1"><span class='fa fa-desktop'></span> <?php echo get_ip($comment['ip']);?></span> <time pubdate="pubdate"><span class="fa fa-clock-o"></span> <?php echo $comment['date']; ?></time></p>
            </article>
			<?php endif; ?>
		<?php blog_comments_children($comments, $comment['children']); $ii++;?>
	</li>
	<?php endforeach; ?>
<?php }?>
<?php
//blog：发表评论表单
function blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark){
	if($allow_remark == 'y'): ?>
	<div id="comment-place">
	<div class="comment-post" id="comment-post">
		<h3 id="reply-title" class="comment-reply-title"><span class="fa fa-commenting"></span> 发表评论 <div class="cancel-reply" id="cancel-reply" style="display:none"><a href="javascript:void(0);" onclick="cancelReply()"><span class="fa fa-share"></span> 取消回复</a></div></h3>
		<form method="post" name="commentform" action="<?php echo BLOG_URL; ?>index.php?action=addcom" id="commentform">
			<input type="hidden" name="gid" id="comment-gid" value="<?php echo $logid; ?>" />
			<input type="hidden" name="pid" id="comment-pid" value="0"/>
			<p class="comment-notes"><span id="email-notes">电子邮件地址不会被公开。</span> 必填项已用<span class="required">*</span>标注</p>
			<textarea id="comment" class="form-control comment-form-comment textarea" placeholder="来都来了,不随便说两句吗?" name="comment" tabindex="4" cols="45" rows="10"></textarea>
			<?php if(ROLE == ROLE_VISITOR): ?>
        <input class="form-control comment-form-qq" placeholder="QQ" id="qqhao" name="qq" maxlength="10" type="text" value="" tabindex="0" size="10">
		<input class="form-control comment-form-author" placeholder="昵称" id="author" name="comname" maxlength="20" type="text" value="" tabindex="1" size="22">
        <input class="form-control comment-form-email" placeholder="邮箱" id="email" name="commail" maxlength="30" type="email" value="" tabindex="2" size="22">
		<input class="form-control comment-form-url" placeholder="网站" id="url" name="comurl" maxlength="30" type="url" value="" tabindex="3" size="22">
			<?php endif; ?>
			<p class="form-submit"><?php if(Option::get('comment_code') == 'y'){?><span class="ajaximgcode"><?php echo $verifyCode; ?></span><?php };?><button type="submit" id="submit" class="btn btn-default" tabindex="6">发表评论</button>
            <div id="error"></div><div id="ajaxloading"></div>
			<div id="error1"></div><div id="ajaxloading1"></div>
			</p>
			<div class="comment-form-smiley no-js-hide" onclick="embedSmiley()"><div class="opensmile" title="插入表情" class="button">
			<span class="fa fa-smile-o" style="top:2px"></span></div><div class="smiley-box" style="display:none"><?php include View::getView('inc/smile');?></div></div>
			<div title="打卡" onclick="javascript:SIMPALED.Editor.daka();this.style.display='none'" class="daka"><i class="fa fa-pencil"></i></div>
			<div title="赞" onclick="javascript:SIMPALED.Editor.zan();this.style.display='none'" class="zan"><i class="fa fa-thumbs-o-up"></i></div>
			<div title="踩" onclick="javascript:SIMPALED.Editor.cai();this.style.display='none'" class="cai"><i class="fa fa-thumbs-o-down"></i></div>
		</form>
	</div>
	</div>
	<?php endif; ?>
<?php }?>
<?php //内容页
function dyyinfo($logid){
	$db=Database::getInstance();
	$row= $db->once_fetch_array("SELECT * FROM ".DB_PREFIX."blog WHERE gid =$logid");
	if(img_zw($row['content'])){$imgurl = img_zw($row['content']);}elseif(img_fj($row['gid'])){$imgurl = img_fj($row['gid']);}else{$imgurl = TEMPLATE_URL.'img/random/'.rand(1,4).'.jpeg';}?>
<div class="logtop">
					<dt>
						<img src="<?php echo $imgurl;?>">
					</dt>
					<dd>
						<h3><?php echo $row['title'];?></h3>
						<p>标签：<?php echo neirong_tag($logid);?></p>
						<p>分类：<?php echo dy_sort($logid);?></p>
						<p>评论：<?php echo $row['comnum'];?>条</p>
						<p>更新日期：<?php echo gmdate('Y-n-j',$row['date']);?></p>
						<p>观看次数：<?php echo $row['views'];?>次</p>
					</dd>
					<dl>
						<h4>剧情介绍</h4>
						<p><?php echo ClearHtml($row['content']);?></p>
					</dl>
					<dl>
						<h4 class="dz">播放地址</h4>
						<p>
						<?php 
						$strarr = explode("\n",$row['spdz']);
						$i=1;
						foreach ($strarr as $u){
							$jishu=explode("*",$u);?>
							<a class="spbut" href="<?php echo '?ply='.$i++;?>"><?php echo $jishu[0];?></a>
						<?php }?>
						</p>
					</dl>
				</div>
<?php } ?>
<?php //分类
function dy_sort($blogid){
	global $CACHE; 
	$log_cache_sort = $CACHE->readCache('logsort');
	?>
<?php if(!empty($log_cache_sort[$blogid])): ?>
<a href="<?php echo Url::sort($log_cache_sort[$blogid]['id']); ?>" title="<?php echo $log_cache_sort[$blogid]['name']; ?>"><?php echo $log_cache_sort[$blogid]['name']; ?></a>
<?php endif;?>
<?php }?>
<?php
function img_zw($content){preg_match_all("/<img.*src\s*=\s*[\"|\']?\s*([^>\"\'\s]*)/i",str_ireplace("\\","",$content),$imgsrc);return $imgsrc[1][0];}
function img_fj($logid){$db = Database::getInstance();$sql = "SELECT * FROM ".DB_PREFIX."attachment WHERE blogid=".$logid." AND (`filepath` LIKE '%jpg' OR `filepath` LIKE '%gif' OR `filepath` LIKE '%png') ORDER BY `aid` ASC LIMIT 0,1";$imgs = $db->query($sql);$img_path = "";while($row = $db->fetch_array($imgs)){$img_path .= BLOG_URL.substr($row['filepath'],3,strlen($row['filepath']));}
return $img_path;}?>