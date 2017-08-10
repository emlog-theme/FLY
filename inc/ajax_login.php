<?php 
/**
 * 登录页面
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<div class="modal fade" id="myLogin" tabindex="-1">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">登陆</h4>
			</div>
			<div class="modal-body">
				<div class="container-fluid">
				    <form id="formtest" action="" method="post">
    					<div class="row">
                            <div class="input-group input-login">
                                <span class="input-group-addon"><i class="fa fa-user faw"></i></span>
            				    <input class="form-control" placeholder="账号" id="input1" name="user" type="text" value="" class="ipt" />
            				</div>
                            <input style="display: none;" type="checkbox" name="ispersis" id="ispersis" value="1" />
                            <div class="input-group input-login">
                                <span class="input-group-addon"><i class="fa fa-lock faw"></i></span>
                                <input class="form-control" placeholder="密码" id="input2"name="pw" type="password" value="" class="ipt" />
                            </div>
                            <?php if(Option::get('login_code') == 'y'){ ?>
                            <div class="input-group ajax_code">
                                <span class="input-group-addon"><i class="fa fa-check faw"></i></span>
                                <input class="form-control" placeholder="验证" id="imgcode" name="imgcode" type="text" value="" class="ipt" />
                                <span class="ajax_imgcode imgcode"><img src="/include/lib/checkcode.php" id="code"/></span>
                            </div>
                            <?php };?>
    					</div>
					</form>
				</div>
			</div>
			<div class="modal-footer">
			    <div id="contentdiv_a" style="text-align: center;"></div>
			    <input type="submit" name="send_ajax" id="send_ajax" value="登陆" class="btn btn-info form-control" />
			</div>
		</div>
	</div>	
</div>
<script>
$(document).ready(function(){
	$.ajax({
		url:pjaxtheme + 'inc/ajax.php?a=ajax',
		type:'post', 
		dataType:'json', 
		success:update_page
	});
	$("#ajax_logout").click(function(){
		$.get(pjaxtheme + "inc/ajax.php?a=ajax_logout");
		$('#user-login').show();
		$('#user-div').hide();
	});
    $('#send_ajax').click(function (){
		var username = $('#input1').val();
		var age = $('#input2').val();
		if (username == '') {
			$('#contentdiv_a').html('<font color="red">帐号不能为空</font>');  
			return false;
		}
		if (age == '') {
			$('#contentdiv_a').html('<font color="red">密码不能为空</font>');  
			return false;
		}
		var params = $('#formtest').serialize();
		$.ajax({
			url:pjaxtheme + 'inc/ajax.php',
			type:'post', 
			dataType:'json', 
			data:params, 
			success:update_page
		});
	});
});
function update_page(json) {
   if(json.code=='200'){
		$('.modal').modal('hide');
		$('#user-login').hide();
		$('#user-name').html('<span class="fa fa-user"></span> ' + json.username + '</span>');
		$('#user-div').show();
		$('#myLogin').hide();
	}else if(json.code=='201'){
		$('#code').attr('src','/include/lib/checkcode.php');
		$('#contentdiv_a').html('<font color="red">' + json.info + '</font>');
	}else if(json.code=='202' || json.code=='203'){
		$('#code').attr('src','/include/lib/checkcode.php');
		$('#contentdiv_a').html('<font color="red">' + json.info + '</font>');
	}
}
</script>