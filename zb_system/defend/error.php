<?php
if (!isset($GLOBALS['zbp'])) {
	exit;
}
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Language" content="<?php echo $GLOBALS['lang']['lang'];?>" />
	<meta name="robots" content="noindex,nofollow"/>
	<meta name="generator" content="<?php echo $GLOBALS['option']['ZC_BLOG_PRODUCT_FULL'];?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=EDGE" />
	<title><?php echo $GLOBALS['blogname'] . '-' . $GLOBALS['lang']['msg']['error'];?></title>
	<link rel="stylesheet" href="<?php echo $GLOBALS['bloghost'];?>zb_system/css/admin.css" type="text/css" media="screen" />
	<script type="text/javascript" src="<?php echo $GLOBALS['bloghost'];?>zb_system/script/common.js"></script>
<?php
foreach ($GLOBALS['hooks']['Filter_Plugin_Other_Header'] as $fpname => &$fpsignal) {$fpname();}

?>
</head>
<body class="short">

<div class="bg">
<div id="wrapper">
  <div class="logo"><img src="<?php echo $GLOBALS['bloghost'];?>zb_system/image/admin/none.gif" title="Z-BlogPHP" alt="Z-BlogPHP"/></div>
  <div class="login loginw">
	<form id="frmLogin" method="post" action="#">
	  <div class="divHeader"><?php echo $GLOBALS['lang']['msg']['error_tips'];?></div>
  	  <div class="content">
	 	<div><p><?php echo $GLOBALS['lang']['msg']['error_info'];?></p><div>
		<?php echo '(' . $this->type . ')' . $this->typeName . ' :     ' . strip_tags($this->message);?>
		<?php echo ' (' . $GLOBALS['blogversion'] . ') ';
if (!in_array('Status: 404 Not Found', headers_list())) {
	echo '(' . GetEnvironment() . ') ';
}
?>
		</div></div>
	 	<?php if ($GLOBALS['option']['ZC_DEBUG_MODE']) {
	?>
	 	<div><p><?php echo $GLOBALS['lang']['msg']['file_line'];?></p><div>
	 	<p><i><?php echo $this->file?></i><br/></p>
	 	<table style='width:100%'>
	 	<tbody>
<?php
$aFile = $this->get_code($this->file, $this->line);
	foreach ($aFile as $iInt => $sData) {
		?>
		 		<tr<?php echo ($iInt + 1 == $this->line ? ' style="background:#75BAFF"' : '')?>>
		 			<td style='width:50px'><?php echo $iInt + 1?></td>
		 			<td><?php echo $sData?></td>
		 		</tr>
<?php }
	?>
		</tbody>
	 	</table>
	 	</div></div>
		<div><p><?php echo $GLOBALS['lang']['msg']['debug_backtrace'];?></p><div>
	 	<table style='width:100%'>
	 	<tbody>
<?php
foreach (debug_backtrace() as $iInt => $sData) {
		if ($iInt <= 2) {
			continue;
		}
		// 前面的是错误捕捉
		?>
		 		<tr>
		 			<td style='width:50px'><?php echo $iInt + 1?></td>
		 			<td><?php echo isset($sData['file']) ? $sData['file'] : 'Callback';?></td>
		 		</tr>
		 		<tr>
		 			<td></td>
		 			<td><code>(<?php if (isset($sData['line'])) {
			echo $sData['line'];
		}
		?>) <?php echo isset($sData['class']) ? $sData['class'] . $sData['type'] : "";
		echo $sData['function'] . '(';
		if (isset($sData['args'])) {
			foreach ($sData['args'] as $argKey => $argVal) {
				echo $argKey . ' => ' . (CheckCanBeString($argVal) ? htmlspecialchars((string) $argVal) : 'Object') . ',';
			}
		}
		echo ')';?></code></td>
		 		</tr>
		 		<tr>
		 			<td></td>
		 			<td><code><?php
if (isset($sData['line'])) {
			$fileContent = $this->get_code($sData['file'], $sData['line']);
			echo $fileContent[$sData['line'] - 1];
		}
		?></code></td>
		 		</tr>
<?php }
	?>
		</tbody>
	 	</table>
	 	</div></div>
	 	<div><p><?php echo $GLOBALS['lang']['msg']['request_data'];?></p><div>
	 	<pre><?php echo '$_GET = ' . print_r(htmlspecialchars_array($_GET), 1)?></pre>
	 	<pre><?php echo '$_POST = ' . print_r(htmlspecialchars_array($_POST), 1)?></pre>
<?php
$post_data = $_COOKIE;unset($post_data['username']);unset($post_data['password']);
	?>
		<pre><?php echo '$_COOKIE = ' . print_r(htmlspecialchars_array($post_data), 1)?></pre>
	 	</div></div>
	 	<div><p><?php echo $GLOBALS['lang']['msg']['include_file'];?></p><div>
	 	<table style='width:100%'>
	 	<tbody>
		<?php foreach (get_included_files() as $iInt => $sData) {?>
			<tr><td style='width:30px'><?php echo $iInt?></td><td><?php echo $sData;?></td></tr>
		<?php }
	?>
		</tbody>
		</table>
	 	</div></div>
	 	<?php }
?>
	  </div>
	  <p><a href="javascript:history.back(-1)"><?php echo $GLOBALS['lang']['msg']['back'];?></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:location.reload()"><?php echo $GLOBALS['lang']['msg']['refresh'];?></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo $GLOBALS['bloghost'];?>zb_system/cmd.php?act=login"><?php echo $GLOBALS['lang']['msg']['admin'];?></a></p>
    </form>
  </div>
</div>
</div>
<script type="text/javascript">
</script>
</body>
</html>