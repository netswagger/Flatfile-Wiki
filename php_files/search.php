<?php

$path_to_check = './post/';
$needle = $_GET['s'];
$files = array();

$count = 0;

if(strlen($needle)>3){
    echo'<table class="table table-bordered table-striped"><tbody>';
    foreach(glob($path_to_check.'*.txt') as $filename)
    {
      foreach(file($filename) as $fli=>$fl)
      {
        $linenum = $fli+1;
        if(strpos($fl, $needle)!==false&&$linenum!=1&& !in_array($filename, $files))
        {
          $theFile = str_replace("./post/", "", $filename);
          $link = '?post='.$theFile;
          $fl2 = str_replace($_GET['s'], "<b>".$_GET['s']."</b>", $fl);
          echo "<tr><td><h2 style='margin:0px;'><a href='$link'>".$theFile.'</a></h2> <b>Found on line '.($linenum).'</b>: <i>'.$fl2.'</i></td></tr>';
          $count++;
          $files[] =$filename;
        }
        else if(strpos($fl, $needle)!==false&&!in_array($filename, $files)){
          $theFile = str_replace("./post/", "", $filename);
          $link = '?post='.$theFile;
          echo "<tr><td><h2 style='margin:0px;'><a href='$link'>".$theFile.'</a></h2></td></tr>';
          $count++;
          $files[] =$filename;
        }
      }
    }
    if($count==0||$count>1){
        echo '<br></br>'.$count.' results found for '.$_GET['s'];
    }
    else{
        echo '<br></br>'.$count.' result found for '.$_GET['s'];
    }
    echo'</tbody></table>';
}
else{
    echo '<br></br> Sorry, you search term needs to be longer than 3 characters';
}