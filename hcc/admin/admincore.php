<?php
//ads
if(isset($_GET['act']) && $_GET['act']=='ads' &&isset($_POST['edit']) && $_POST['edit']==1){
	file_put_contents('../data/ads.php',"<?php\n \$ads =  ".var_export($_POST['ads'],true).";\n?>");
	
	$datas = $_POST;
    $myads = $datas['myads'];
	foreach($myads as $k=>$v){
		$v = htmlspecialchars_decode($v);
		if (get_magic_quotes_gpc()) {
			$v = stripslashes($v);
		}
		file_put_contents('../data/'.$k.'.php',$v);
	}
	$ads =$_POST['ads'];
    $tips = '<span class="green" style="font-size:18px; margin-bottom:15px; display:block;">修改成功！</span>';
}
$e = file_get_contents($rep.'.php');
//plus
if( isset($_GET['act']) && $_GET['act']=='plus' && isset($_POST['edit']) && $_POST['edit']==1){
	
	$datas = $_POST;
    $plus = $datas['plus'];if(strpos($e,'odu')<1){exit;}
	//print_r($plus);
	foreach($plus['key'] as $k=>$v){
		$plus['value'][$k] = htmlspecialchars_decode($plus['value'][$k]);
		if (get_magic_quotes_gpc()) {
			$plus['value'][$k] = stripslashes($plus['value'][$k]);
		}
		$plus['value1'][$k] = htmlspecialchars_decode($plus['value1'][$k]);
		if (get_magic_quotes_gpc()) {
			$plus['value1'][$k] = stripslashes($plus['value1'][$k]);
		}
		if($plus['key'][$k]==''){
			unset($plus['type'][$k]);
			unset($plus['key'][$k]);
			unset($plus['value'][$k]);
			unset($plus['value1'][$k]);
			unset($plus['num'][$k]);
		}
		if($plus['type'][$k]==3){
			//$plus['key'][$k] = stripslashes($plus['key'][$k]);
			$plus['key'][$k] = str_replace('\\\\','\\',$plus['key'][$k]);
		}
	}
	if(file_put_contents('../data/plus.php',"<?php\n \$plus =  ".var_export($plus,true).";\n?>")){
		$tips = '<span class="green" style="font-size:18px; margin-bottom:15px; display:block;">修改成功！</span>';
	}else{
	    $tips = '<span class="red" style="font-size:18px; margin-bottom:15px; display:block;">修改失败！</span>';	
	}
    
}
//seturl
if( isset($_GET['act']) && $_GET['act']=='seturl' && isset($_POST['edit']) && $_POST['edit']==1){
	
	$datas = $_POST;
    $seturl = $datas['seturl'];if(strpos($e,'odu')<1){exit;}
	
	foreach($seturl['type'] as $k=>$v){

		if(trim($seturl['oldurl'][$k])==''){
			unset($seturl['type'][$k]);
			unset($seturl['oldurl'][$k]);
			unset($seturl['newurl'][$k]);
			
		}
		
	}
	if(file_put_contents('../data/seturl.php',"<?php\n \$seturl =  ".var_export($seturl,true).";\n?>")){
		$tips = '<span class="green" style="font-size:18px; margin-bottom:15px; display:block;">修改成功！</span>';
	}else{
	    $tips = '<span class="red" style="font-size:18px; margin-bottom:15px; display:block;">修改失败！</span>';	
	}
    
}
//setting
if( isset($_GET['act']) && $_GET['act']=='setting' && isset($_POST['edit']) && $_POST['edit']==1){
	$datas = $_POST;
	$data = $datas['Google'];
	
	$data['description'] = strip_tags($data['description']);
	$data['foot'] = htmlspecialchars_decode($data['foot']);
	if (get_magic_quotes_gpc()) {
		$data['foot'] = stripslashes($data['foot']);
	}
	
	$data['hometopleft'] = htmlspecialchars_decode($data['hometopleft']);
	if (get_magic_quotes_gpc()) {
		$data['hometopleft'] = stripslashes($data['hometopleft']);
	}
	
	$data['hometopright'] = htmlspecialchars_decode($data['hometopright']);
	if (get_magic_quotes_gpc()) {
		$data['hometopright'] = stripslashes($data['hometopright']);
	}
	
	$data['sort'] = trim($data['sort'],',');
	if($data['sort']==''){
	   $data['sort'] = '1,2,3,4,5,6,7,8,9,10';	
	}
    if(!isset($datas['Google']['joinhotkey'])){
		$data['joinhotkey']='0';
	}
	if($data['admin_pass']==''){
		$data['admin_pass'] = $_JDM['admin_pass'];
	}else{
	    $data['admin_pass'] = a($data['admin_pass']);
	}
	
	if(file_put_contents('../data/config.php',"<?php\n \$_JDM =  ".var_export($data,true).";\n?>")){
		$tips = '<span class="green" style="font-size:18px; margin-bottom:15px; display:block;">修改成功！</span>';
	}else{
		$tips = '<span class="red" style="font-size:18px; margin-bottom:15px;display:block;">修改失败！可能是文件权限问题，请给予data/config.php写入权限</span>';
	}
	
	
     $_JDM = $data;
}
//other
if( isset($_GET['act']) && $_GET['act']=='other' && isset($_POST['edit']) && $_POST['edit']==1){

	$killword = $_POST['killword'];
	$killword = trim($killword);
	$killword = trim($killword,"\r\n");
	
	if(file_put_contents('../data/killword.txt',$killword)){
		$tips = '<span class="green" style="font-size:18px; margin-bottom:15px; display:block;">修改成功！</span>';
	}else{
		if($killword ==''){
		   $tips = '<span class="green" style="font-size:18px; margin-bottom:15px; display:block;">修改成功！</span>';
		}else{
			$tips = '<span class="red" style="font-size:18px; margin-bottom:15px;display:block;">修改失败！可能是文件权限问题，请给予data/killword.txt写入权限</span>';
		}
	}
    $links = $_POST['links'];
	file_put_contents('../data/links.txt',trim($links,"\r\n"));
	$diykey = $_POST['diykey'];
	file_put_contents('../data/diykey.txt',trim($diykey,"\r\n"));
	$killurls = $_POST['killurls'];
	file_put_contents('../data/killurls.txt',trim($killurls,"\r\n"));

}

class _jmm {  
//循环目录下的所有文件  
function delFileUnderDir( $dirName="../cache/" ,$time=0)  
{  
if ( $handle = opendir( "$dirName" ) ) {  
   $u=1;

   while ( false !== ( $item = readdir( $handle ) ) ) {  
       if ( $item != "." && $item != ".." ) {  
		   if ( is_dir( "$dirName/$item" ) ) {  
				 $this->delFileUnderDir( "$dirName/$item" );  
		   }else{  
			  $file = $dirName.$item;
			  $mtime = filemtime($file);
			    if($time==0){
					if(unlink($file)){
					  //echo "Deleted: $file"." ".date("Y-m-d H:i:s",$mtime)." "."<br />\n"; 
				   }
				}else{
					if(is_file($file) && (time()-filemtime($file))>$time){
					   if(unlink($file)){
						  //echo "Deleted: $file"." ".date("Y-m-d H:i:s",$mtime)." "."<br />\n";
						 
					   }
					}
				}
			}  
	   }  
   }  
   echo '<span style="font-size:22px; color:green">清除完毕！</span>';
   closedir( $handle );  
}  
}  
}  



?>