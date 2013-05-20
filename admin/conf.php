<?php require 'head.php' ?>
<?php
$display_info = false;
if (isset($_POST['save'])) {
  $user_name_changed = $_POST['user_name'] != $mc_config['user_name'];
  $mc_config['site_name'] = $_POST['site_name'];
  $mc_config['site_desc'] = $_POST['site_desc'];
  $mc_config['site_link'] = $_POST['site_link'];
  $mc_config['user_nick'] = $_POST['user_nick'];
  $mc_config['user_name'] = $_POST['user_name'];
  $mc_config['comment_code'] = get_magic_quotes_gpc() ? stripslashes(trim($_POST['comment_code'])) : trim($_POST['comment_code']);
  if ($_POST['user_pass'] != '')
    $mc_config['user_pass'] = $_POST['user_pass'];
    $code = "<?php\n\$mc_config = ".var_export($mc_config, true)."\n?>";
  file_put_contents('../files/conf.php', $code);
  if ($_POST['user_pass'] != '' || $user_name_changed) {
    setcookie('mc_token', md5($mc_config['user_name'].'_'.$mc_config['user_pass']));
  }
  $display_info = true;
}
$site_name = $mc_config['site_name'];
$site_desc = $mc_config['site_desc'];
$site_link = $mc_config['site_link'];
$user_nick = $mc_config['user_nick'];
$user_name = $mc_config['user_name'];
$comment_code = isset($mc_config['comment_code']) ? $mc_config['comment_code'] : '';
?>
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
  <?php if ($display_info) { ?>
  <div class="updated">设置保存成功！</div>
  <?php } ?>
  <div class="admin_page_name">站点设置</div>
  <div class="small_form small_form2">
    <div class="field">
      <div class="label">网站标题</div>
      <input class="textbox" type="text" name="site_name" value="<?php echo htmlspecialchars($site_name); ?>" />
    </div>
    <div class="clear"></div>
    <div class="field">
      <div class="label">网站描述</div>
      <input class="textbox" type="text" name="site_desc" value="<?php echo htmlspecialchars($site_desc); ?>" />
      <div class="info">显示在网站title后面。部分主题也会显示出来。</div>
    </div>
    <div class="clear"></div>
    <div class="field">
      <div class="label">网站地址</div>
      <input class="textbox" type="text" name="site_link" value="<?php echo htmlspecialchars($site_link); ?>" />
      <div class="info">必须修改，否则文章路径出错。不需要带网址最后的“/”。</div>
    </div>
    <div class="clear"></div>
    <div class="field">
      <div class="label">站长昵称</div>
      <input class="textbox" type="text" name="user_nick" value="<?php echo htmlspecialchars($user_nick); ?>" />
      <div class="info">页面中不显示，显示为RSS订阅中的“作者”。</div>
    </div>
    <div class="clear"></div>
    <div class="field">
      <div class="label">后台帐号</div>
      <input class="textbox" type="text" name="user_name" value="<?php echo htmlspecialchars($user_name); ?>" />
      <div class="info"></div>
    </div>
    <div class="clear"></div>
    <div class="field">
      <div class="label">后台密码</div>
      <input class="textbox" type="password" name="user_pass" />
      <div class="info">默认为2046。</div>
    </div>
    <div class="clear"></div>
    <div class="field">
      <div class="label">确认密码</div>
      <input class="textbox" type="password" />
      <div class="info"></div>
    </div>
    <div class="clear"></div>
    <div class="field">
      <div class="label">评论代码</div>
      <textarea rows="5" class="textbox" name="comment_code"><?php echo htmlspecialchars($comment_code); ?></textarea>
      <div class="info">
        <p>第三方评论服务所提供的评论代码。设置后可拥有评论功能。每个页面、每篇文章可单独设置是否允许评论。</p>
        <p>例如：<a href="http://pinglun.la/" target="_blank">评论啦</a>、<a href="http://duoshuo.com/" target="_blank">多说</a>、<a href="http://disqus.com/" target="_blank">Disqus</a>等。</p>
      </div>
    </div>
    <div class="clear"></div>
    <div class="field">
      <div class="label"></div>
      <div class="field_body"><input class="button" type="submit" name="save" value="保存设置" /></div>
      <div class="info"></div>
    </div>
    <div class="clear"></div>
  </div>
</form>
<?php require 'foot.php' ?>