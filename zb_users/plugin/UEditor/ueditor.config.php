<?php

require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';

header("Content-type: application/x-javascript; charset=utf-8"); 
//Somecode here.

ob_clean();

$upload_dir = 'zb_users/upload/' . date('Y/m') . '/';
//$upload_path = $bloghost . $upload_dir;
$upload_path = '';
$upload_dir = $blogpath . $upload_dir;

$UEditor_lang=$lang['lang'];
if(strpos($UEditor_lang,'en')===0)$UEditor_lang='en';
$UEditor_lang=strtolower('\'' . $UEditor_lang . '\'');

$UEditor_initialStyle='';
if(isset($lang['font_family']))$UEditor_initialStyle=trim($lang['font_family']);
if(!$UEditor_initialStyle)$UEditor_initialStyle='微软雅黑,宋体,Arial,Helvetica,sans-serif;';
$UEditor_initialStyle=str_replace('"','&qout;',$UEditor_initialStyle);
$UEditor_initialStyle='"body{font-size:14px;font-family:'.$UEditor_initialStyle.'}"';


#echo '/*' . $upload_dir . '*/' ;

$output_js="(function(){var URL;URL = '{$bloghost}zb_users/plugin/UEditor/';window.UEDITOR_CONFIG = {";

$array_config = array(
	'UEDITOR_HOME_URL' => 'URL',
	'HOST_URL' => 'bloghost',
    'serverUrl' => 'URL + "php/controller.php"',
	'toolbars' => "[ [ 'source', '|', 'undo', 'redo', '|', 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript','forecolor', 'backcolor', '|', 'insertorderedlist', 'insertunorderedlist','indent', 'justifyleft', 'justifycenter', 'justifyright','|', 'removeformat','formatmatch','autotypeset', 'searchreplace','pasteplain'],[ 'fontfamily', 'fontsize','|', 'emotion','link','music','insertimage','scrawl','insertvideo', 'attachment','spechars','|', 'map', 'gmap','|', "
				  . ($zbp->option['ZC_SYNTAXHIGHLIGHTER_ENABLE']?"'insertcode',":'')
				  . "'blockquote', 'wordimage','inserttable', 'horizontal','fullscreen']]",
	'shortcutMenu' => "['fontfamily', 'fontsize', 'bold', 'italic', 'underline', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist']",
	'maximumWords' => 1000000000,
	'initialContent' => '"<p></p>"',
	'initialStyle' => $UEditor_initialStyle,
	'wordCount' => 'true',
	'elementPathEnabled' => 'true',
	'initialFrameHeight' => '300',
	'toolbarTopOffset' => '200',
	'sourceEditor' => '\''.($zbp->option['ZC_CODEMIRROR_ENABLE']?'codemirror':'textarea').'\'',
	'theme' => '"default"',
    'themePath' => 'URL +"themes/"',
	'lang' => $UEditor_lang,
	'langPath' => 'URL+"lang/"',
	'codeMirrorJsUrl' => 'URL+ "third-party/codemirror/codemirror.js"',
	'codeMirrorCssUrl' => 'URL+ "third-party/codemirror/codemirror.css"',
	"maxUpFileSize" => $zbp->option['ZC_UPLOAD_FILESIZE'],
	"allowDivTransToP" => 'false',
	'catchRemoteImageEnable' => 'false'
);


foreach ($array_config as $key => $value) {
	$output_js .= '"' . $key . '":' . $value . ',';
}

$output_js .= '"zb_full":""};';
$output_js .= '})();';


//Code here
echo $output_js;

die();

?>

