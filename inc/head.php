<?php 
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<script type="text/javascript">
var pjaxtheme = '<?php echo TEMPLATE_URL; ?>';
var pjax_id = '#<?php echo get_template_name(); ?>';
</script>
<style>@media (min-width:1200px){.container{width:<?php echo $index_width;?>px}}<?php if($bg_open== 1 ){?>body{background: url('<?php echo $bgimg ?  $bgimg : ''.TEMPLATE_URL."img/bg.jpg";?>') top center fixed;-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;}<?php }?></style>
