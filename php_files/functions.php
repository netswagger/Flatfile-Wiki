<?php
include 'scFunction.php';
include 'shortcodes.php';
//The post directory
$dir = './post/';
function check_shortcode($content){
	$content = $content;
	function get_tag($tag){
		global $content;
		$x = explode('['.$tag.']', $content);
		var_dump($content);
	}
	
	//Title
	get_tag('title');

}

//Makes nav for post
function get_post(){
	global $dir;
	
	function get_string_between($string, $tag){
	    $string = " ".$string;
	    $ini = strpos($string,"[$tag]");
	    if ($ini == 0) return "";
	    $ini += strlen("[$tag]");
	    $len = strpos($string,"[/$tag]",$ini) - $ini;
	    return substr($string,$ini,$len);
	}

	if ($handle = opendir($dir)) {

            /* This is the correct way to loop over the directory. */
            while (false !== ($entry = readdir($handle))) {
                if(substr(strtolower($entry), -4)=='.txt'){
                        $title = get_string_between(file_get_contents($dir.$entry),"title");
                        $active = "";
                        if(isset($_GET['post'])&&$_GET['post']==$entry){
                                $active = "active";

                        }
                        if($title){
                                echo'<li class="'.$active.'"><a href="?post='.$entry.'">'.$title.'</a></li>';
                        }
                }
            }
    closedir($handle);
    }
}
//Fucntion to disaply the post
function display_post(){
	global $dir;
	//Gets the post content
	if(isset($_GET['post'])&&$_GET['post']!='NewWiki'){
		$content = nl2br(file_get_contents($dir.$_GET['post']));
                echo '<p><span class="glyphicon glyphicon-pencil btn pull-left" aria-hidden="true"></span> '
                . '<span class="glyphicon glyphicon-remove btn pull-right" aria-hidden="true" id="btnOpenDialog"></span></p><br>';
		echo do_shortcode($content);
	}
        else if(isset($_GET['post'])&&$_GET['post']=='NewWiki'){
            include 'new_wiki.php';
        }
        else if(isset($_GET['s'])){
            include 'search.php';
        }
        //Else display home screen
	else{
            include 'home.php';
	}
}

//Submit new post fucntion
function post($title,$text){
    
    $title2 = preg_replace("/[^0-9a-zA-Z ]/", "",$title);
   
    $title3 = date("Y-m-d-his").'_'.substr(strtolower( str_replace("__", "_",str_replace(" ", "_",$title2))),0,20);
    $myfile = fopen("./post/".$title3.".txt", "w") or die("Unable to open file!./post/".$title3.".txt");
    $txt = "[title]".$title."[/title]\n";
    fwrite($myfile, $txt);
    fwrite($myfile, $text);
    fclose($myfile);
     
}

