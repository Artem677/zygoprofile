<?php

/**
* @id           $Id$
* @author       Sherza (zygopterix@gmail.com)
* @package      ZYGO Profile
* @copyright    Copyright (C) 2011 - 2012 Psytronica.ru. http://psytronica.ru  All rights reserved.
* @license      GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
*/

 defined('JPATH_BASE') or die;

$plugin = JPluginHelper::getPlugin('user', 'zygo_profile');
$pluginParams = new JRegistry();
$pluginParams->loadString($plugin->params);
$thumb_width = $pluginParams->get('thumb_width', 100);
$thumb_height = $pluginParams->get('thumb_height', 100);
$helptext = $pluginParams->get('texthelp');

$u =JURI::getInstance();
$ustr= $u->toString();
$ustrFull = (strpos($ustr, '?')!=-1)? $ustr.'&avatarfunc=process' : $ustr.'?avatarfunc=process';

$script ='
var ZE_PATH = "'.JURI::root().'";
var ZE_IMAGE_HANDLING_PATH = "'.$ustrFull.'";
var ZE_THUMB_WIDTH = '.$thumb_width.';
var ZE_THUMB_HEIGHT = '.$thumb_height.';
';

$avatar = JRequest::getVar('avatar');

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; utf-8" />
	<link rel="stylesheet" href="<?php echo JURI::root(); ?>plugins/user/zygo_profile/fields/avatar/css/avatar.css" type="text/css" />
	<script src="<?php echo JURI::root(); ?>media/jui/js/jquery.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="<?php echo JURI::root(); ?>plugins/user/zygo_profile/fields/avatar/js/jquery.imgareaselect.min.js"></script>
	<script type="text/javascript" src="<?php echo JURI::root(); ?>plugins/user/zygo_profile/fields/avatar/js/jquery.ocupload-packed.js"></script>
	<script type="text/javascript" src="<?php echo JURI::root(); ?>plugins/user/zygo_profile/fields/avatar/js/avatar.js"></script>
	<script type="text/javascript">
		<?php echo $script; ?>
	</script>
</head>
<body>


	<div id="ze_upload_avatar_wrapper">
					
		<noscript>Javascript must be enabled!</noscript>
		<div id="upload_status"></div>
		<div style="float:left">
			<a id="upload_link" class="btn btn-primary" href="#"><?php echo JText::_("PLG_USER_ZYGO_PROFILE_SELECT_AVATAR"); ?></a>
		</div>

		<div id="thumbnail_form" <?php if(!$avatar) echo 'style="display:none;"'; ?>>
			<form name="form" action="" method="post">
				<input type="hidden" name="x1" value="" id="x1" />
				<input type="hidden" name="y1" value="" id="y1" />
				<input type="hidden" name="x2" value="" id="x2" />
				<input type="hidden" name="y2" value="" id="y2" />
				<input type="hidden" name="w" value="" id="w" />
				<input type="hidden" name="h" value="" id="h" />
				<input type="submit" name="save_thumb" class="btn btn-success" value="<?php echo JText::_("PLG_USER_ZYGO_PROFILE_SAVE_AVATAR"); ?>" id="save_thumb" />
				<input type="button" class="btn"  onclick="window.parent.SqueezeBox.close();" value="<?php echo JText::_("PLG_USER_ZYGO_PROFILE_CANCEL"); ?>" />
			</form>
		</div>
		<div style="clear:both"></div>

		<?php if(trim($helptext)) echo '<div id="zehelptext">'.$helptext.'</div>'; ?>

		<span id="loader" style="display:none;"><img src="<?php echo JURI::root(); ?>plugins/user/zygo_profile/fields/avatar/loader.gif" alt="Loading..."/></span> 
		<span id="progress"></span>
		<br />
		<div id="uploaded_image">
			<?php
				if($avatar){
					echo '<img src="'.JURI::root().str_replace('thumb', 'large', $avatar).'" id="thumbnail" />
					<div style="width:'.$thumb_width.'px; height:'.$thumb_height.'px;">
						<img src="'.JURI::root().str_replace('thumb', 'large', $avatar).'" style="position: relative;" id="thumbnail_preview" />
					</div>';

				}
			?>
		</div>
		<div style="clear:both"></div>
	</div>


</body>
</html>