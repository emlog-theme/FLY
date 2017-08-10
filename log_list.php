<?php 
/**
 * 站点首页模板
 */
if(!defined('EMLOG_ROOT')) {exit('error!');}
if(isset($_GET["setting"])){include View::getView('setting');exit();}
?>
<section class="container">
	<div class="content-wrap">
		<div class="content">
<?php if (blog_tool_ishome()) {?>
<!--轮播图开始-->
<!--  data-ride="carousel" 自动轮播 -->
<?php
if($Slide== 1 ){
?>
<div id="mySlide" class="carousel slide">
	<ol class="carousel-indicators">
		<li data-target="#mySlide" data-slide-to="0" class="active"></li>
		<li data-target="#mySlide" data-slide-to="1"></li>
		<li data-target="#mySlide" data-slide-to="2"></li>
	</ol>
	<div class="carousel-inner">
		<div class="item active">
			<a href="<?php echo $Surl1?>" target="_blank"><img src="<?php echo $Slide1 ?  $Slide1 : ''.TEMPLATE_URL."img/blue.jpg";?>" alt="图片1"></a>
		</div>
		<div class="item">
			<a href="<?php echo $Surl2?>" target="_blank"><img src="<?php echo $Slide2 ?  $Slide2 : ''.TEMPLATE_URL."img/red.jpg";?>" alt="图片2"></a>
		</div>
		<div class="item">
			<a href="<?php echo $Surl3?>" target="_blank"><img src="<?php echo $Slide3 ?  $Slide3 : ''.TEMPLATE_URL."img/blue.jpg";?>" alt="图片3"></a>
		</div>
	</div>
	<a href="#mySlide" data-slide="prev" class="carousel-control left">
		<i class="fa fa-chevron-left slide-left"></i>
	</a>
	<a href="#mySlide" data-slide="next" class="carousel-control right">
		<i class="fa fa-chevron-right slide-right"></i>
	</a>
</div>
<?php }?>
<!--轮播图结束-->
<!-- 公告 -->
	<article class="excerpt-minic excerpt-minic-index">
	    <div class="textgg"> <ul class="gglb"><i class="fa fa-bullhorn"></i>
            <div class="bulletin"> 
            	<ul>
            	<?php global $CACHE;$newtws_cache = $CACHE->readCache('newtw');
            		  foreach($newtws_cache as $value):
            		  $img = empty($value['img']) ? "" : '<a title="查看图片" href="'.BLOG_URL.str_replace('thum-', '', $value['img']).'" target="_blank"><i class="icon-image"></i></a>';?>
            	<li><?php echo preg_replace("/\[F(([1-4]?[0-9])|50)\]/",'<img alt="face" src="'.TEMPLATE_URL.'img/face/$1.gif"  />',$value['t']);echo $img;echo date('（Y年n月j日）',$value['date']);?></li>
            	<?php endforeach; ?>
            </div>
	    </div> 
	</article>
<!-- 首页6格 -->
<?php
if($Sorts== 1 ){
?>
<article class="row excerpt-list">
    <div class="col-sm-2 col-xs-4 col-list"><div class="indexebox indexebox-l">
        <i class="fa fa-picture-o"></i>
		<h4><?php echo $Sorth1;?></h4>
		<p><?php echo $Sortp1;?></p>
		<a class="btn btn-info btn-sm" href="<?php echo $Sorta1;?>">点击进入</a>
		</div></div>
    <div class="col-sm-2 col-xs-4 col-list"><div class="indexebox indexebox-2">
        <i class="fa fa-music"></i>
		<h4><?php echo $Sorth2;?></h4>
		<p><?php echo $Sortp2;?></p>
		<a class="btn btn-info btn-sm" href="<?php echo $Sorta2;?>">点击进入</a>
		</div></div>
    <div class="col-sm-2 col-xs-4 col-list"><div class="indexebox indexebox-3">
        <i class="fa fa-list"></i>
		<h4><?php echo $Sorth3;?></h4>
		<p><?php echo $Sortp3;?></p>
		<a class="btn btn-info btn-sm" href="<?php echo $Sorta3;?>">点击进入</a>
		</div></div>
    <div class="col-sm-2 col-xs-4 col-list"><div class="indexebox indexebox-4">
        <i class="fa fa-twitch"></i>
		<h4><?php echo $Sorth4;?></h4>
		<p><?php echo $Sortp4;?></p>
		<a class="btn btn-info btn-sm" href="<?php echo $Sorta4;?>">点击进入</a>
		</div></div>
    <div class="col-sm-2 col-xs-4 col-list"><div class="indexebox indexebox-5">
        <i class="fa fa-file-text-o"></i>
		<h4><?php echo $Sorth5;?></h4>
		<p><?php echo $Sortp5;?></p>
		<a class="btn btn-info btn-sm" href="<?php echo $Sorta5;?>">点击进入</a>
		</div></div>
    <div class="col-sm-2 col-xs-4 col-list"><div class="indexebox indexebox-6">
        <i class="fa fa-link"></i>
		<h4><?php echo $Sorth6;?></h4>
		<p><?php echo $Sortp6;?></p>
		<a class="btn btn-info btn-sm" href="<?php echo $Sorta6;?>">点击进入</a>
		</div></div>
</article>
<?php }?>
<?php if ($fous_open==1):echo index_fous($fous_id);endif;?>
<?php }?>
<?php
if($ads== 1 ){
?>
<!-- 广告位置：首页_列表_横幅_h760w80 | ID:1 -->
<article class="excerpt"><a href="<?php echo $adurl1;?>" target="_blank"><img src="<?php echo $adimg1;?>" style="width: 100%;"></a></article>
<!-- 广告结束 投放请联系站长 -->
<?php }?>
<!-- 列表 -->
<?php 
if (!empty($logs)):
foreach ($logs as $key => $value):$ii++;
$top = topflg($value['top'], $value['sortop'], isset($sortid)?$sortid:'');
$t=time() - 3*24*60*60;
$log_t=gmdate('Y-m-d',$value['date']);
$diy_t=date("Y-m-d",$t);
if($top){
	$show = '<i class="top-mark  article-mark"></i>';
}elseif($value['views'] >= 5000){
	$show = '<i class="hot-mark  article-mark"></i>';
}elseif($log_t > $diy_t){
	$show = '<i class="new-mark  article-mark"></i>';
}else{
	$show = '';
}
$logdes = blog_tool_purecontent(ishascomment($value['content'],$value['logid']), 92);
if(pic_thumb($value['content'])){
        $imgsrc = pic_thumb($value['content']);
	}elseif(getThumbnail($value['logid'])){
	    $imgsrc = getThumbnail($value['logid']);
	}else{
	    $imgsrc = TEMPLATE_URL.'img/random/'.rand(1,4).'.jpg';
	}
?>
			<article class="excerpt">
				<div class="media">
				<div class="media-left">
				<?php echo $show;?>
				<a class="lista" href="<?php echo $value['log_url']; ?>"><img class="listimg" src="<?php echo $imgsrc; ?>"></a>
				</div>
				<div class="media-body">
				<h3 class="listt"><a href="<?php echo $value['log_url']; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $value['log_title']; ?>"><?php echo $value['log_title']; ?></a></h3>
				<a href="<?php echo $value['log_url']; ?>">
				<p class="listp"><?php echo $logdes;?></p>
				</a>
				<p class="listtags"><?php blog_tag($value['logid']); ?></p>
				</div>
				<div class="media-right">
				<ul class="spanico">
				<li class="listico"><i class="fa fa-calendar"></i> <?php echo gmdate('Y-n-j', $value['date']); ?></li>
				<li class="listico"><i class="fa fa-list"></i> <?php blog_sort($value['logid']); ?></li>
				<li class="listico"><i class="fa fa-eye"></i> 热度:<?php echo $value['views'];?></li>
				<li class="listico"><i class="fa fa-comments-o"></i> 评论:<?php echo $value['comnum'];?></li>
				<li class="listico"><i class="fa fa-user"></i> <?php echo index_author($value['author']); ?></li>
				</ul>
				</div>
				</div>
			</article>
			<?php 
			$index_log1 = $index_num - 1;
			if($pageurl == Url::logPage() && $key == $index_log1){break;}
			endforeach;
			else:
			?>
			<article id="post-box">
				<div class="panel">
					<header class="panel-header">
								<h2 class="post-title"><i class="fa fa-info-circle"></i> 友情提示</h2>
						</header>
					<section class="context">
						<p class="tips">你找到的东西压根不存在呀,你可以尝试搜索一下其他关键词！</p>
        			<form action="<?php echo BLOG_URL; ?>" method="get" class="navbar-form navbar-left search-form">
        				<div class="input-group">
        					<input type="text" class="form-control search-texts" name="keyword" placeholder="输入关键词搜索..." >
        					<div class="input-group-btn">
        						<button class="btn btn-default">搜索</button>
        					</div>
        				</div>
        			</form>
					</section>
				</div>
			</article>
			<?php endif;?>
			<?php if($ads== 1 ){?>
			<article class="excerpt"><a href="<?php echo $adurl2;?>" target="_blank"><img src="<?php echo $adimg2;?>" style="width: 100%;"></a></article>
			<?php }?>
			<?php if (blog_tool_ishome()) {?>
			<!-- cms开始 -->
			<?php
				if ($pageurl == Url::logPage()) {
				$db = Database::getInstance();
				global $CACHE;
				global $arr_sortico1;
				$sort_cache = $CACHE->readCache('sort');
				$sort_id = array_unique(explode(',', trim($cms_id)));
				$out = "<div class='row index_cms'>";
				foreach ($sort_id as $key => $i) {
					$out .= "<div class='col-sm-6 {$key}'><div class='panel panel-default'><span class='icon'><i class='".$arr_sortico1[$i]."'></i></span> <div class='panel-heading'><h3 class='panel-title'>".$sort_cache[$i]['sortname']."<span class='more pull-right'><a title='更多' href='".Url::sort($i)."'><i class='fa fa-ellipsis-h'></i></a></span></h3></div><div class='panel-body  panel_cms'><ul>";
					$logss = $db->query('SELECT * FROM ' . DB_PREFIX . "blog WHERE sortid='{$i}' AND type='blog' AND hide='n' order by date DESC limit 0,5");
					while($trow = $db->fetch_array($logss)) {;
						$date = gmdate('Y年m月d日', $trow['date']);
						$trow['title'] = mb_substr($trow['title'], 0, 12, 'utf-8');
						$url = Url::log($trow['gid']);
						$out .= "<li><a href=\"{$url}\"><time>{$date}</time><i class=\"fa fa-chevron-right\"></i> {$trow['title']}</a></li>";
					}
					$out .= "</ul></div></div></div>";
				}
				$out .= "</div>";
				echo $out;
				};
			?>
			<!-- cms结束 -->
			<?php }?>
			<?php if (blog_tool_ishome()) {?>
			<?php }else{?>
			<!--分页开始-->
			<?php echo fly_page($lognum,$index_lognum,$page,$pageurl);?>
			<!--分页结束-->
			<?php }?>
		</div>
	</div>
<?php if (blog_tool_ishome()){include View::getView('side');}else{include View::getView('side1');}?>
</section>
<?php include View::getView('footer');?>