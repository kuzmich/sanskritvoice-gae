<?php
@date_default_timezone_set ('UTC');

//
//            WW  WW  WW
//            WW  WW  WW
//            WW  WW  WW
//             WWWWWWWW
//     __ __ _ _ _ __  _ __ _  _ 
//     \ V  V / | , , | __ \  V |
//      \_/\_/|_|_|_|_| .__/\_, |
//                    |_|   |___|
//
// ----------------------------------
//
//     Wimpy Playlister
//     7.4.32 2015-02-02
//     www.wimpyplayer.com
//     Copyright Plaino LLC
//
// ----------------------------------





$wimpyVersion = "7.4.32";


// -----------------------------
// Allow Folder Navigation
// -----------------------------
$allowFolderNavigation = true;

// -----------------------------
// Playlist Kind
// -----------------------------
// VALUES
// xml 		- XML playlists allow for cover art images (both folder-based 
//              and file-based) Plus using an XML playlist allows for distinction 
//              between skin files (which are json) and playlist files.
// txt 		- Simple text-based list
// json 	- (Experimental -- may not be supported on your system)
//
$playlistKind = "xml";

// -----------------------------
// Media Types
// -----------------------------
// The kinds of files to search for:
$media_types = "xml,pls,mp4,m4a,m4p,m4v,aac,mp3,wav";


// -----------------------------
// HTTP Option
// -----------------------------
// Allows you to run wimpy in "https" mode;
//$httpOption = "https";
$httpOption = "http";

// -----------------------------
// Hide Folders
// -----------------------------
// A list of folder names to ignore.
$hide_folders = "getid3,wimpy.buttons,wimpy.skins,wimpy.test,wimpy.getid3,assets,cgi-bin,_notes,_private,_private,_vti_bin,_vti_cnf,_vti_pvt,_vti_txt";

// -----------------------------
// Hide Files
// ------------------------v
// A list of file names to ignore.
$hide_files = "";

// -----------------------------
// Hide Keywords
// -----------------------------
// Files containing these keywords will be ignored.
$hide_keywords = ""; //wimpy,config,customizer,source,plugin

// -----------------------------
// Coverart Basename
// -----------------------------
// For each folder and sub-folder, you can have a single 
// image that will be used for all files in that folder 
// or sub-folder. 
//
// For example, if you have a folder set up as:
// myFolder/
//		coverart.jpg
//		track1.mp3
//		track2.mp3
// Then all the tracks in "myFolder" will use the "coverart.jpg" file
//
// This setting allows you to specify the filename to look for.
//
// For the sake of flexability, so you can use png or jpg 
// without having to modify this script, we are just defining 
// the "base name" to look for -- the file name without the extension.
//
// For example, the "base name" of this file: coverart.jpg
// is "coverart".
$coverartBasename = "coverart"; 

// -----------------------------
// Find All Media
// -----------------------------
// When set to "true", will recursively search through all subdirectoies. 
$findAllMedia = false; // false true

// -----------------------------
// Quirks Mode
// -----------------------------
// If not using gthe getID3 library, sets titles using the filename, but only shows text "between the dots"
// example: 01.MyTrack.mp3 would display as "MyTrack"
// This allows for files to be manually sorted within the folder.
$quirksmode = false;


// -------------------
// URL Style
// -------------------
// VALUES
// 1 = from the root 	/path/to/file.mp3
// 2 = full URL 		http://www.yoursite.com/path/to/file.mp3
$urlStyle = 2;


// -------------------
// Cross Domain Accessible
// -------------------
// Allows this script to be called from another domain (or local file system).
$allowCrossDomainAccess = true;


// -------------------
// Limit Files
// -------------------
// Limits the number of files that are returned
// -1 = no limit.
// [1-n] = integer representing the maximum number of files that can be returned.
// $limitFiles = 50; // 50 files will be returned.
// $limitFiles = -1; // no limit.
$limitFiles = -1;


// -------------------
// Ignore Folders
// -------------------
// Does not include folders in the returned playlist.
$ignoreFolders = false;

// -------------------
// Encrypt Filenames
// -------------------
// Filenames will not display as traditional URL's rather they will be "base64 encoded.
$encrypt = false;


/////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////
//
//                IMPORTANT !
//   Wimpy over-rides teh GETID3 options through query-strings
//   (in the $_REQUEST or $_POST). This allows Wimpy to be
//   configure getid3 from the client. 
//  
//   We've left these options for you in case you are using 
//   wimpy.php to retrieve XML playlists and you're 
//   some kind of wizard.
//
/////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////
//
//                MUCHO IMPORTANT-ARINO !
// 
//   You'll need to ensure the "getid3" library is located in 
//   the same folder as this file. The "getid3" library is a
//   folder included in the wimpy downlaod package. The entire
//   folder needs to be "next to" wimpy.php.
//
//   Example:
//   path/to/wimpy.php
//   path/to/getid3/*
//
/////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////


// -----------------------------
// Get ID3 Info
// -----------------------------
// Requires the getid3 library.
$getID3info = false;

// -----------------------------
// Extract Image
// -----------------------------
// Requires the getid3 library.
// Extracts embedded image from ID3.
// Embedded image must be either PNG or JPG
// May cause playlists to load slowly since the extracted data gets inserted into the playlist as base64'd data.
$getID3image = false;


/////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////
//
//               IMPORTANTE AMIGO!
//
//   NOTE: Any changes you make to the sorting 
//   options will not translate into the player. 
//   Because Wimpy has it's own built-in sorting 
//   mechanisms on the client-side. 
//   
//   We've left these options for you in case you are using 
//   wimpy.php to retrieve XML playlists and you're 
//   some kind of wizard.
//
/////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////

// -----------------------------
// Shuffle Files
// -----------------------------
// Randomizes the file list order. (Does not randomize folder lists.)
$shuffle = false;

// -----------------------------
// Sort Order
// -----------------------------
// Sets the sort order for files.
// VALUES
// asc 	- Ascending (A-Z);
// dec 	- Descending (Z-A);
$sortOrder = "asc";



// -----------------------------
// Sort Index
// -----------------------------
// Which field to sort on:
// VALUES
// none 	- don't sort
// date 	- Modification date of the file on the server
// artist 	- GetID3 options must be enabled
// title 	- Generally the "base name" of the file. Or if using GetID3 option, the actual title in the ID3 tag.
// file		- um
// ... any other field present.
// NOTE: When using quirksmode the value set here is overriddden and automatically set to "file"
$sortIndex = "none";



// -----------------------------
if($quirksmode){$sortIndex="file";}define("newline","\r\n");define("slash",DIRECTORY_SEPARATOR);$a=array();$a['allowFolderNavigation']=$allowFolderNavigation;$a['allowCrossDomainAccess']=$allowCrossDomainAccess;$a['coverartBasename']=$coverartBasename;$a['playlistKind']=$playlistKind;$a['quirksmode']=$quirksmode;$a['urlStyle']=$urlStyle;$a['limitFiles']=$limitFiles;$a['ignoreFolders']=$ignoreFolders;$a['encrypt']=$encrypt;$a['getID3info']=$getID3info;$a['getID3image']=$getID3image;$a['shuffle']=strtolower($shuffle);$a['sortOrder']=strtolower($sortOrder);$a['sortIndex']=$sortIndex;$a['media_types']=explode(",",$media_types);$a['hide_keywords']=explode(",",$hide_keywords);$a['hide_folders']=explode(",",$hide_folders);$a['hide_files']=explode(",",$hide_files);$b=null;if ( @get_magic_quotes_gpc () ){function c ( &$d ){if ( !is_array ( $d ) ){return;}foreach ( $d as $e=>$f ){is_array ( $d[$e] ) ? c ( $d[$e] ) : ( $d[$e]=stripslashes ( $d[$e] ) );}}$g=array ( &$_GET,&$_POST,&$_COOKIE,&$_REQUEST);c ( $g );}function h($i){$j=$i;$j=str_replace("&#","__AMP_PUOND__",$j);$j=str_replace("&","&amp;",$j);$j=str_replace("<","&lt;",$j);$j=str_replace(">","&gt;",$j);$j=str_replace("'","&apos;",$j);$j=str_replace('"',"&quot;",$j);$j=str_replace("__AMP_PUOND__","&#",$j);$j=str_replace("&amp;amp;","&amp;",$j);$j=str_replace("&amp;lt;","&lt;",$j);$j=str_replace("&amp;gt;","&gt;",$j);$j=str_replace("&amp;apos;","&apos;",$j);$j=str_replace("&amp;quot;","&quot;",$j);return $j;}function k($i,$l=false) {global $encrypt;$j=$i;$j=str_replace("&","%26",$j);$j=str_replace("?","%3F",$j);if($encrypt){$j="__1".base64_encode($j);}return $j;}if(@ini_get('safe_mode')){print('<?xml version="1.0"'.urldecode("%3F").'>');print('<playlist>');print('<item>');print('<file>ERROR</file>');print('<title>1. ERROR</title>');print('</item>');print('<item>');print('<file>ERROR</file>');print('<title>2. PHP is running in "Safe Mode".</title>');print('</item>');print('<item>');print('<file>ERROR</file>');print('<title>3. Contact Server Admin to Correct.</title>');print('</item>');print('<item>');print('<file>ERROR</file>');print('<title>4. ------------------</title>');print('</item>');print('<item>');print('<file>ERROR</file>');print('<title>5. You can still use Rave,</title>');print('</item>');print('<item>');print('<file>ERROR</file>');print('<title>6. however all URLs must be</title>');print('</item>');print('<item>');print('<file>ERROR</file>');print('<title>7. entered manually.</title>');print('</item>');print('</playlist>');exit;}function m($n){$o="__:__";$p=str_replace("://",$o,$n);$p=str_replace("\\","/",$p);$p=str_replace("//","/",$p);$p=str_replace($o,"://",$p);if(substr($p,-1)=="/"){$p=substr($p,0,sizeof($p)-1);}return $p;}if(!isset($_SERVER['SCRIPT_NAME'])){$_REQUEST=get_defined_vars();$_SERVER=$q;}$r=explode("/",$_SERVER['PHP_SELF']);$s=array_pop($r);$t['wwwroot']=$httpOption."://".$_SERVER['HTTP_HOST'];$t['www']=$t['wwwroot'].(implode("/",$r));$t['wwwself']=$t['wwwroot'].$_SERVER['PHP_SELF'];if(!@getcwd ()){$u=dirname(__FILE__);}else{$u=getcwd();}$t['sys']=m($u);$v=strrev ( $u );$w=strrev ( x($t['www']) );$y=strrev ( substr($v,strlen($w) ) );$t['sysroot']=$y;function z($Za,$Zb){foreach($Za as $Zc){if(@stristr(strtolower($Zb),strtolower($Zc))){return true;}}return false;}function Zd($Ze,$Zf=false) {global $a;if($Zf){$Zg=$Zf;}else{$Zg=$a['media_types'];}$Zh=array ();if(!$Ze || $Ze==""){$Ze=".";}$Zi=$a['hide_folders'];$Zj=$a['hide_files'];$Zk=$a['hide_keywords'];$Zl=@opendir($Ze);if($Ze){while (false !==($Zm=@readdir($Zl))){if($Zm!='.' && $Zm!='..') {$Zm=$Ze.'/'.str_replace("\\","/",$Zm);$Zn=Zo($Zm);if(is_dir($Zm)) {if(!z($Zi,$Zn['filename']) && !z($Zk,$Zn['filename'])){$Zh=array_merge($Zh,Zd($Zm,$Zg));}}else{if(in_array(strtolower($Zn['ext']),$Zg)){if(!z($Zj,$Zn['filename']) && !z($Zk,$Zn['filename'])){$Zh[]=$Zm;}}}}}@closedir($Zl);}return $Zh;}function Zp($Ze){global $a;$Zq=array();$Zr=array ();$Zs=array ();$Zh=array ();$Zl=@opendir($Ze);$Zt=$a['media_types'];$Zi=$a['hide_folders'];$Zj=$a['hide_files'];$Zk=$a['hide_keywords'];$Zu=$a['allowFolderNavigation'];if($Ze){while (false !==($Zm=@readdir($Zl))){if($Zm !='.' && $Zm !='..' && substr ($Zm,0,1 ) !="..") {$Zm=$Ze.'/'.str_replace("\\","/",$Zm);$Zn=Zo($Zm);if(is_dir($Zm) && $Zu==true) {if(!z($Zi,$Zn['filename']) && !z($Zk,$Zn['filename'])){$Zs[]=$Zm;}}else{if(in_array(strtolower($Zn['ext']),$Zt)){if(!z($Zj,$Zn['filename']) && !z($Zk,$Zn['filename'])){$Zh[]=$Zm;}}}}}@closedir($Zl);}$Zr['dirs']=$Zs;$Zr['files']=$Zh;return $Zr;}function Zv ($Zw,$Zx,$Zy,$Zz=false,$ZZa=false) {if(is_array($Zw) && count($Zw)>0) {foreach(array_keys($Zw) as $e) {$ZZb[$e]=@$Zw[$e][$Zx];}if(!$Zz) {if ($Zy=='asc'){asort($ZZb);}else{
arsort($ZZb);}}else{if ($ZZa===true) {natsort($ZZb);}else{natcasesort($ZZb);}if($Zy !='asc') {$ZZb=array_reverse($ZZb,true);}}foreach(array_keys($ZZb) as $e) {if (is_numeric($e)) {$ZZc[]=$Zw[$e];}else{$ZZc[$e]=$Zw[$e];}}return $ZZc;}else{return $Zw;}}function ZZd($ZZe,$ZZf=false){print "<pre>";print_r($ZZe);print "</pre>";if($ZZf){exit;}}function ZZg($ZZh){$j="";foreach($ZZh as $e=>$f){$j .="<".$e.">".h(trim($f))."</".$e.">".newline;}return $j;}function ZZi($ZZj,$ZZk=false){global $a,$t;$ZZl=$a['coverartBasename'];$ZZm=utf8_decode(rawurldecode($ZZj));if($ZZk){$ZZn['files']=Zd($ZZm);$ZZn['dirs']=array();}else{$ZZn=Zp($ZZm);}$Zs=array();$Zh=array();$ZZo=array();$ZZp=$a['quirksmode'];$ZZq=$a['getID3info'];$ZZr=$a['getID3image'];if( ! $a['ignoreFolders']){if(sizeof($ZZn['dirs'])>0){$ZZs=$ZZn['dirs'][0];$ZZt=Zo($ZZs);$ZZu=Zo($ZZt['basepath']);$ZZv=ZZw($ZZu['basepath']);for($ZZx=0; $ZZx<sizeof($ZZn['dirs']); $ZZx++){$ZZs=$ZZn['dirs'][$ZZx];$ZZt=Zo($ZZs);$ZZv=ZZw($ZZs);$ZZy=array();$ZZz="";$ZZy['date']=filemtime($ZZs);$ZZy['file']=$t['wwwself']."?".$ZZz."d=".k($ZZv,true);$ZZy['image']=ZZZa($ZZs.slash.$ZZl);$ZZy['kind']="xml";if($ZZp){$ZZZb=explode(".",$ZZt['filename']);array_shift($ZZZb);$ZZt['filename']=implode($ZZZb);}$ZZy['title']=preg_replace ('/_/'," ",$ZZt['filename']);$Zs[]=$ZZy;}}}if(sizeof($ZZn['files'])>0){for($ZZx=0; $ZZx<sizeof($ZZn['files']); $ZZx++){$ZZs=$ZZn['files'][$ZZx];$ZZt=Zo($ZZs);$ZZv=ZZw($ZZs);$ZZy=array();$ZZy['date']=filemtime($ZZs);$ZZy['file']=k( $ZZv );$ZZZc=$ZZt['ext'];$ZZy['kind']=$ZZZc;if($ZZq){$ZZZd=ZZZe($ZZs);}else{$ZZZd=array();}if($ZZp){$ZZZb=explode(".",$ZZt['basename']);array_shift($ZZZb);$ZZt['basename']=implode($ZZZb);}foreach($ZZZd as $e=>$f){if($e=='track_number'){$ZZy['index']=$f;} else if($e=='album' || $e=='year'){$ZZy[$e]=$f;}}if(@$ZZZd['artist']){$ZZy['artist']=@$ZZZd['artist'];}if( ! @$ZZZd['artist'] && @$ZZy['band']){$ZZy['artist']=@$ZZy['band'];}$ZZy['title']=(@$ZZZd['title'])? @$ZZZd['title'] : preg_replace ('/_/'," ",$ZZt['basename']);if(@$ZZZd['genre']){$ZZy['genre']=@$ZZZd['genre'];}if( isset($ZZZd['link']) ){$ZZy['link']=$ZZZd['link'];}$ZZZf=ZZZa($ZZt['basepath'].slash.$ZZt['basename']);if( ! $ZZZf ){if( isset($ZZZd['imageExists']) || isset($ZZZd['image'])){$ZZZf=$t['wwwself']."?jj=".k($ZZv,true);}if( ! $ZZZf ){$ZZZf=ZZZa($ZZt['basepath'].slash.$ZZl);}}if($ZZZf){$ZZy['image']=$ZZZf;}if( isset($ZZZd['index']) ){$ZZy['index']=$ZZZd['index'];}$Zh[]=$ZZy;}}if($a['shuffle']==true){shuffle($Zh);
}else{if($a['sortIndex'] !="none"){$ZZZg=$a['sortIndex'];$ZZZh=$a['sortOrder'];$Zh=Zv ($Zh,$ZZZg,$ZZZh,true,false);$Zs=Zv ($Zs,$ZZZg,$ZZZh,true,false);}}$j="";$ZZZi=$a['playlistKind'];if($ZZZi=="xml"){$ZZZj=h(ZZZa($ZZm.slash.$ZZl));$ZZZk="";if($ZZZj){$ZZZk= ' image="'.$ZZZj.'"';}$j="<playlist$ZZZk>".newline;} else if($ZZZi=="json"){$ZZZl=array();$ZZZl["cover"]=$ZZZj;}else{$j="";}if($ZZZi=="json"){$ZZZl["items"]=array();}for($ZZx=0; $ZZx<sizeof($Zs); $ZZx++){if($ZZZi=="xml"){$j .='<item>'.newline;$j .=ZZg($Zs[$ZZx]);$j .="</item>".newline;} else if($ZZZi=="json"){$ZZZl["items"][]=$Zs[$ZZx];}else{$j .=$Zs[$ZZx]['filename'].newline;}}$ZZZm=$a['limitFiles'];if($ZZZm>-1){$Zh=array_slice ($Zh,0,$ZZZm);}for($ZZx=0; $ZZx<sizeof($Zh); $ZZx++){if($ZZZi=="xml"){$j .='<item>'.newline;$j .=ZZg($Zh[$ZZx]);$j .="</item>".newline;} else if($ZZZi=="json"){$ZZZl["items"][]=$Zh[$ZZx];}else{$j .=$Zh[$ZZx]['file'].newline;}}if($ZZZi=="xml"){$j .="</playlist>";} else if($ZZZi=="json"){$j=@json_encode($ZZZl);}if($a['urlStyle']==1){$j=x($j);}@clearstatcache();return $j;}function Zo($ZZZn) {$ZZZn=str_replace("\\","/",$ZZZn);$ZZZo=explode("/",$ZZZn);$ZZZp=array_pop($ZZZo);$ZZZq=explode(".",$ZZZp);$ZZZr=array_pop($ZZZq);$ZZZs=implode(".",$ZZZq);$ZZZt=join("/",$ZZZo);$ZZZu=array();$ZZZu['filename']=$ZZZp;$ZZZu['ext']=$ZZZr;$ZZZu['extension']=$ZZZr;$ZZZu['basename']=$ZZZs;$ZZZu['basepath']=$ZZZt;return $ZZZu;}function ZZZe($ZZZv){global $a,$b;if($a['getID3info'] && $b){if($a['getID3image']){$b->option_save_attachments=true;}else{$b->option_save_attachments=false;}$ZZZw=$b->analyze(urldecode($ZZZv));getid3_lib::CopyTagsToComments($ZZZw);}else{$ZZZw=array();}$j=array();if(sizeof($ZZZw)>0){if(isset($ZZZw['comments_html'])){$ZZZx=@$ZZZw['comments_html'];foreach($ZZZx as $e=>$f){if($e=="comment"){$ZZZy=$ZZZx["comment"][0];$ZZZz=@$ZZZx["encoded_by"][0];if($ZZZz && stristr ($ZZZz,"itunes") ){$ZZZy=@$ZZZw["tags_html"]["id3v2"]["comment"][3];}$j["comment"]=$ZZZy;}else{$j[$e]=$f[0];}}}if(isset($ZZZw['tags_html'])){if(isset($ZZZw['tags_html']['id3v1'])){if(isset($ZZZw['tags_html']['id3v1']['track'])){$j['index']=@$ZZZw['tags_html']['id3v1']['track'][0];}}if(isset($ZZZw['tags_html']['id3v2'])){if(isset($ZZZw['tags_html']['id3v2']['comment'])){foreach($ZZZw['tags_html']['id3v2']['comment'] as $e=>$f){if(is_string($f)){if(substr($f,0,4)=="http"){$j["link"]=$f;break;}}}}}}if(isset($ZZZw['id3v2']['APIC'][0]['mime'])){$j['imageExists']=1;
}if($a['getID3image']){if(isset($ZZZw['comments']['picture'][0]['data'])){$j['image']=$ZZZw['comments']['picture'][0]['data'];$j['imageMime']=$ZZZw['comments']['picture'][0]['image_mime'];}}}return $j;}function ZZZa($ZZZZa){$j="";$ZZZZb=array("png","jpg","PNG","JPG");for($ZZx=0;$ZZx<count($ZZZZb); $ZZx++){$ZZZc=$ZZZZb[$ZZx];$ZZZZc=$ZZZZa.".".$ZZZc;if (@is_file($ZZZZc)){$j=ZZw($ZZZZc);break;}}return $j;}function ZZZZd($ZZZZe){global $t;$ZZZZf=m(rawurldecode($ZZZZe));$ZZZZg=$ZZZZf;if( substr($ZZZZf,0,4)=="http" ){$ZZZZg=$t['sys'].slash.substr($ZZZZf,strlen($t['www']),strlen($ZZZZf));} else if( substr($ZZZZf,0,1)=="/" ){$ZZZZg=$t['sysroot'].slash.$ZZZZg;} else if( substr($ZZZZf,0,1) !="/" ){$ZZZZg=$t['sys'].slash.$ZZZZg;}$ZZZZg=str_replace("//","/",$ZZZZg);return $ZZZZg;}function ZZw($ZZZZh){global $t,$a;$ZZZZf=m($ZZZZh);$ZZZZg=$t['www'].substr($ZZZZf,strlen($t['sys']),strlen($ZZZZf));if($a['urlStyle']==1){$ZZZZg=x($ZZZZg);}return $ZZZZg;}function x($ZZZZe){global $t;$ZZZZh=str_replace($t['wwwroot'],"",$ZZZZe);return $ZZZZh;}function ZZZZi($ZZZZj,$ZZZp,$ZZZZk) {header("Pragma: public",false);header("Expires: Thu,19 Nov 1981 08:52:00 GMT",false);header("Cache-Control: must-revalidate,post-check=0,pre-check=0",false);header("Cache-Control: no-store,no-cache,must-revalidate",false);header("Cache-Control: private",false);header("Content-Type: ".$ZZZZk);header("Content-Disposition: attachment; filename=\"$ZZZp\"",false);header("Content-Transfer-Encoding: Binary",false);readfile ($ZZZZj);
exit;}function ZZZZl($ZZZZm){global $a;$ZZZZn='<'.urldecode("%3F").'xml version="1.0" encoding="UTF-8"'.urldecode("%3F").'>';header("Pragma: public",false);header("Expires: Thu,19 Nov 1981 08:52:00 GMT",false);header("Cache-Control: must-revalidate,post-check=0,pre-check=0",false); header("Cache-Control: no-store,no-cache,must-revalidate",false);header("Content-Type: text/xml; charset=utf-8",false);if($a['allowCrossDomainAccess']){header('Access-Control-Allow-Credentials: true',false); header('Access-Control-Allow-Origin: *',false);header('Access-Control-Allow-Methods: GET,POST',false);header('Access-Control-Allow-Headers: Content-Type',false);}print ($ZZZZn.$ZZZZm);exit;}function ZZZZo($ZZZZp){global $a;header("Pragma: public",false);header("Expires: Thu,19 Nov 1981 08:52:00 GMT",false);header("Cache-Control: must-revalidate,post-check=0,pre-check=0",false);header("Cache-Control: no-store,no-cache,must-revalidate",false);header("Content-Type: text/plain; charset=utf-8");if($a['allowCrossDomainAccess']){header('Access-Control-Allow-Credentials: true',false); header('Access-Control-Allow-Origin: *',false);header('Access-Control-Allow-Methods: GET,POST',false);header('Access-Control-Allow-Headers: Content-Type',false);}print ($ZZZZp);exit;}function ZZZZq($ZZZZr=false){global $ZZZZs,$a,$b;if ( $ZZZZs["i"] ){$a['getID3info']=true;if ( $ZZZZs["j"] ){$a['getID3image']=true;}}if($a['getID3info']){$ZZZZt='wimpy.getid3'.slash.'getid3.php';if (is_file($ZZZZt)){require ($ZZZZt);} else if(is_file('getid3.php')){require ('getid3.php');}else{$a['getID3info']=false;}}if($a['getID3info']){$b=new getID3;if($ZZZZr){$b->option_save_attachments=true;}}}function ZZZZu ($f) {if( substr($f,0,3)=="__1" ){return base64_decode( substr($f,3,strlen($f)) );}else{return $f;}}function ZZZZv($ZZZZw){$j=rawurldecode($ZZZZw); $j=ZZZZu($j);$j=rawurldecode($j); $j=stripslashes($j);$j=strip_tags($j);$j=str_replace("\\","x",$j);$j=str_replace("..","x",$j);$j=str_replace("./","x",$j);$j=str_replace("/.","x",$j);return $j;}function ZZZZx(){header("HTTP/1.0 404 Not Found",false);print("<H1>404 Not Found</H1>");exit;}$ZZZZs["d"]=ZZZZv( @$_REQUEST['d'] );$ZZZZs["f"]=ZZZZv( @$_REQUEST["f"] );$ZZZZs["jj"]=ZZZZv( @$_REQUEST["jj"] );$ZZZZs["v"]=isset($_REQUEST["v"]) || array_key_exists("v",$_REQUEST);$ZZZZs["o"]=isset($_REQUEST["o"]) || array_key_exists("o",$_REQUEST);$ZZZZs["i"]=isset($_REQUEST["i"]) || array_key_exists("i",$_REQUEST);$ZZZZs["j"]=isset($_REQUEST["j"]) || array_key_exists("j",$_REQUEST);if($ZZZZs["v"]){print $wimpyVersion;exit;} else if ($ZZZZs["o"]){print "ok";exit;} else if ($ZZZZs["d"]){ZZZZq();$ZZZZy=ZZZZd($ZZZZs["d"]);if(file_exists ($ZZZZy)){if($a['playlistKind']=="xml"){header("Content-Type: text/xml; charset=utf-8",false);ZZZZl(ZZi($ZZZZy,false));}else{header("Content-Type: text/plain; charset=utf-8",false);ZZZZo(ZZi($ZZZZy,false));}}else{if($a['playlistKind']=="xml"){header("Content-Type: text/xml; charset=utf-8",false);print("<playlist><item><title>ERROR</title></item></playlist>");}else{header("Content-Type: text/plain; charset=utf-8",false);print("ERROR");}}} else if ($ZZZZs["f"]){$ZZZZz=$ZZZZs["f"];$ZZZZZa=Zo($ZZZZz);$ZZZZZb=true;if( in_array ($ZZZZZa['ext'],$a['media_types']) ){$ZZZZy=ZZZZd($ZZZZz);if( file_exists ($ZZZZy) ){$ZZZZZb=false;ZZZZi($ZZZZy,$ZZZZZa['filename'],"application/octet-stream");}}if($ZZZZZb){ZZZZx();}} else if ($ZZZZs["jj"]){$ZZZZy=ZZZZd ( $ZZZZs["jj"] );$ZZZZZb=true;if( file_exists ($ZZZZy) ){$a['getID3info']=true;$a['getID3image']=true;ZZZZq(true);$ZZZd=ZZZe($ZZZZy);if( isset($ZZZd["image"]) ){$ZZZZZb=false;$ZZZZZc=$ZZZd["image"];$ZZZZk=$ZZZd["imageMime"];header("Content-Type: ".$ZZZZk);echo $ZZZZZc;}else{$ZZZZZd=ZZZa($t['sys'].slash.$a['coverartBasename']);if($ZZZZZd){$ZZZZZb=false;$ZZZZZa=Zo($ZZZZZd);header("Content-Type: image/".$ZZZZZa['ext']);readfile($ZZZZZd);}}}if($ZZZZZb){ZZZZx();}}else{ZZZZq();if($a['playlistKind']=="xml"){ZZZZl(ZZi($t['sys'],$findAllMedia,false));}else{ZZZZo(ZZi($t['sys'],$findAllMedia,false));}}?>