<?php 
/**
 * 微语部分
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<section class="container">
  <div class="content-wrap">
    <div class="content container-tw">
      <header class="article-header">
        <h1 class="title-tw"><i class="fa fa-twitch"></i> 微语</h1>
      </header>
      <div class="tw-lie"></div>
      <article class="article-content">
        <div class="tw">
          <div class="plus"></div>
          <div class="plus2"></div>
          <ul class="archives-monthlisting">
            <?php 
    foreach($tws as $val):
    $author = $user_cache[$val['author']]['name'];
    $avatar = empty($user_cache[$val['author']]['avatar']) ? 
                BLOG_URL . 'admin/views/images/avatar.jpg' : 
                BLOG_URL . $user_cache[$val['author']]['avatar'];
    $tid = (int)$val['id'];
    $img = empty($val['img']) ? "" : '<a title="查看图片" href="'.BLOG_URL.str_replace('thum-', '', $val['img']).'" target="_blank"><img style="border: 1px solid #EFEFEF;" src="'.BLOG_URL.$val['img'].'"/></a>';
    ?>
            <li>
              <em1></em1>
              <div class="time1" ><?php echo $val['date'];?></div>
              <div class="tw-content"><em></em><?php echo $val['t'].'<br/>'.$img;?>
                <div class="status-wall-meta"><span><?php echo $val['date'];?></span></div>
              </div>
            </li>
            <?php endforeach;?>
          </ul>
        </div>
      </article>
      <div class="page-tw"><?php echo $pageurl;?></div>
    </div>
  </div>
<?php include View::getView('side2');?>
</section>
<?php include View::getView('footer');?>
