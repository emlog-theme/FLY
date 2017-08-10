<?php
/*
 * @des 主题控制中心
 * FLY.theme by Finally
 */
if(!defined('EMLOG_ROOT')) {exit('FLY Functions Requrire Emlog!');}
function d($str){
	$str = str_replace("'","\'",$str );
	return $str;
}
//检查文件类型和上传错误
function sc_files($type,$error){
	if ($error > 0) {
		switch ($error) {
			case '1':
				emMsg("上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值。");
				break;
			case '2':
				emMsg("上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值。 ");
				break;
			case '3':
				emMsg("文件只有部分被上传。 ");
				break;
			case '4':
				emMsg("没有文件被上传。 ");
				break;
			case '6':
				emMsg("找不到临时文件夹。");
				break;
			case '7':
				emMsg("文件写入失败!");
				break;
		}
		exit();
	}elseif (($type != 'image/png') && ($type != 'image/jpeg') && ($type != 'image/pjpeg') && ($type != 'images/x-png') && ($type != 'image/x-icon')) {
		emMsg("文件格式错误，请重新上传！");
		exit();
	}
}
function plugin_setting(){
	$do = isset($_GET['do']) ? $_GET['do'] : '';
    if($do == 'save') {
		if(empty($_POST)){
                emMsg("修改失败，请重试！");
			return ;
		}
		//处理上传的图片
		if ($_FILES['logo']['error'] != 4) {
			sc_files($_FILES['logo']['type'],$_FILES['logo']['error']);
			$logo = $_FILES['logo']['tmp_name'];
			$logopath = 'content/templates/FLY/img/logo.png';
			$a = move_uploaded_file($logo, EMLOG_ROOT .'/'.$logopath);
			$logo = BLOG_URL.$logopath;
		}else{
			$logo = isset($_POST['logo']) ? d(trim($_POST['logo'])) : '';
		}
		if ($_FILES['bgimg']['error'] != 4) {
			sc_files($_FILES['bgimg']['type'],$_FILES['bgimg']['error']);
			$bgimg = $_FILES['bgimg']['tmp_name'];
			$bgimgpath = 'content/templates/FLY/img/bg.jpg';
			$a = move_uploaded_file($bgimg, EMLOG_ROOT .'/'.$bgimgpath);
			$bgimg = BLOG_URL.$bgimgpath;
		}else{
			$bgimg = isset($_POST['bgimg']) ? d(trim($_POST['bgimg'])) : '';
		}
		 $bg_open = $_POST['bg_open'];
		 $arr_navico = $_POST['arr_navico'];
		 $arr_sortico = $_POST['arr_sortico'];
		 $index_width = isset($_POST['index_width']) ? d(trim($_POST['index_width'])) : '';
		 $index_num = isset($_POST['index_num']) ? d(trim($_POST['index_num'])) : '';
		 $fous_open = isset($_POST['fous_open']) ? d(trim($_POST['fous_open'])) : '';
		 $fous_id = isset($_POST['fous_id']) ? d(trim($_POST['fous_id'])) : '';
		 $dy_id = isset($_POST['dy_id']) ? d(trim($_POST['dy_id'])) : '';
		 $cms_id = isset($_POST['cms_id']) ? d(trim($_POST['cms_id'])) : '';
		 $side_qq = isset($_POST['side_qq']) ? d(trim($_POST['side_qq'])) : '';
		 $compress_html = isset($_POST['compress_html']) ? d(trim($_POST['compress_html'])) : '';
		 $more = isset($_POST['more']) ? d(trim($_POST['more'])) : '';
		 $more_html = isset($_POST['more_html']) ? d(trim($_POST['more_html'])) : '';
		 $Slide = isset($_POST['Slide']) ? d(trim($_POST['Slide'])) : '';
		 $Slide1 = isset($_POST['Slide1']) ? d(trim($_POST['Slide1'])) : '';
		 $Surl1 = isset($_POST['Surl1']) ? d(trim($_POST['Surl1'])) : '';
		 $Slide2 = isset($_POST['Slide2']) ? d(trim($_POST['Slide2'])) : '';
		 $Surl2 = isset($_POST['Surl2']) ? d(trim($_POST['Surl2'])) : '';
		 $Slide3 = isset($_POST['Slide3']) ? d(trim($_POST['Slide3'])) : '';
		 $Surl3 = isset($_POST['Surl3']) ? d(trim($_POST['Surl3'])) : '';
		 $Sorts = isset($_POST['Sorts']) ? d(trim($_POST['Sorts'])) : '';
		 $Sorth1 = isset($_POST['Sorth1']) ? d(trim($_POST['Sorth1'])) : '';
		 $Sortp1 = isset($_POST['Sortp1']) ? d(trim($_POST['Sortp1'])) : '';
		 $Sorta1 = isset($_POST['Sorta1']) ? d(trim($_POST['Sorta1'])) : '';
		 $Sorth2 = isset($_POST['Sorth2']) ? d(trim($_POST['Sorth2'])) : '';
		 $Sortp2 = isset($_POST['Sortp2']) ? d(trim($_POST['Sortp2'])) : '';
		 $Sorta2 = isset($_POST['Sorta2']) ? d(trim($_POST['Sorta2'])) : '';
		 $Sorth3 = isset($_POST['Sorth3']) ? d(trim($_POST['Sorth3'])) : '';
		 $Sortp3 = isset($_POST['Sortp3']) ? d(trim($_POST['Sortp3'])) : '';
		 $Sorta3 = isset($_POST['Sorta3']) ? d(trim($_POST['Sorta3'])) : '';
		 $Sorth4 = isset($_POST['Sorth4']) ? d(trim($_POST['Sorth4'])) : '';
		 $Sortp4 = isset($_POST['Sortp4']) ? d(trim($_POST['Sortp4'])) : '';
		 $Sorta4 = isset($_POST['Sorta4']) ? d(trim($_POST['Sorta4'])) : '';
		 $Sorth5 = isset($_POST['Sorth5']) ? d(trim($_POST['Sorth5'])) : '';
		 $Sortp5 = isset($_POST['Sortp5']) ? d(trim($_POST['Sortp5'])) : '';
		 $Sorta5 = isset($_POST['Sorta5']) ? d(trim($_POST['Sorta5'])) : '';
		 $Sorth6 = isset($_POST['Sorth6']) ? d(trim($_POST['Sorth6'])) : '';
		 $Sortp6 = isset($_POST['Sortp6']) ? d(trim($_POST['Sortp6'])) : '';
		 $Sorta6 = isset($_POST['Sorta6']) ? d(trim($_POST['Sorta6'])) : '';
		 $ads = isset($_POST['ads']) ? d(trim($_POST['ads'])) : '';
		 $adimg1 = isset($_POST['adimg1']) ? d(trim($_POST['adimg1'])) : '';
		 $adurl1 = isset($_POST['adurl1']) ? d(trim($_POST['adurl1'])) : '';
		 $adimg2 = isset($_POST['adimg2']) ? d(trim($_POST['adimg2'])) : '';
		 $adurl2 = isset($_POST['adurl2']) ? d(trim($_POST['adurl2'])) : '';
		 $cachedata = "<?php
	\$logo = '".$logo."';
	\$bg_open = '".$bg_open."';
	\$bgimg = '".$bgimg."';
	\$arr_navico = '".serialize($arr_navico)."';
	\$arr_sortico = '".serialize($arr_sortico)."';
	\$index_width = '".$index_width."';
	\$index_num = '".$index_num."';
	\$fous_open = '".$fous_open."';
	\$fous_id = '".$fous_id."';
	\$dy_id = '".$dy_id."';
	\$cms_id = '".$cms_id."';
	\$side_qq = '".$side_qq."';
	\$compress_html = '".$compress_html."';
	\$more = '".$more."';
	\$more_html = '".$more_html."';
	\$Slide = '".$Slide."';
	\$Slide1 = '".$Slide1."';
	\$Surl1 = '".$Surl1."';
	\$Slide2 = '".$Slide2."';
	\$Surl2 = '".$Surl2."';
	\$Slide3 = '".$Slide3."';
	\$Surl3 = '".$Surl3."';
	\$Sorts = '".$Sorts."';
	\$Sorth1 = '".$Sorth1."';
	\$Sortp1 = '".$Sortp1."';
	\$Sorta1 = '".$Sorta1."';
	\$Sorth2 = '".$Sorth2."';
	\$Sortp2 = '".$Sortp2."';
	\$Sorta2 = '".$Sorta2."';
	\$Sorth3 = '".$Sorth3."';
	\$Sortp3 = '".$Sortp3."';
	\$Sorta3 = '".$Sorta3."';
	\$Sorth4 = '".$Sorth4."';
	\$Sortp4 = '".$Sortp4."';
	\$Sorta4 = '".$Sorta4."';
	\$Sorth5 = '".$Sorth5."';
	\$Sortp5 = '".$Sortp5."';
	\$Sorta5 = '".$Sorta5."';
	\$Sorth6 = '".$Sorth6."';
	\$Sortp6 = '".$Sortp6."';
	\$Sorta6 = '".$Sorta6."';
	\$ads = '".$ads."';
	\$adimg1 = '".$adimg1."';
	\$adurl1 = '".$adurl1."';
	\$adimg2 = '".$adimg2."';
	\$adurl2 = '".$adurl2."';
?>";
		$cachefile = EMLOG_ROOT.'/content/templates/FLY/inc/config.php';
		@ $fp = fopen($cachefile, 'wb') OR emMsg('读取缓存失败。如果您使用的是Unix/Linux主机，请修改缓存目录 (content/cache) 下所有文件的权限为777。如果您使用的是Windows主机，请联系管理员，将该目录下所有文件设为可写');
		@ $fw =	fwrite($fp,$cachedata) OR emMsg('写入缓存失败，缓存目录 (content/cache) 不可写');
		fclose($fp);
		emMsg("修改配置成功！",BLOG_URL.'?setting');
		}
}