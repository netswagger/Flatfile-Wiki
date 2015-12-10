<h2 class="sub-header">Create A New Wiki Post</h2>
<div class="table-responsive">
    <form action="./?post=NewWiki" method="POST">
    <p><input type="text" id="title" name="title" placeholder="Post title goes here..." class="form-control"></p>
</p><textarea class="form-control" rows="20" placeholder="Post text goes here..." id="text" name="text"></textarea></p>
<p><button type="submit" id="submit" name="submit" class="btn btn-default">Post It!</button></p>
<input type="hidden" id="post" name="post" value="NewWiki">
    </form>
</div>
<?php

if(isset($_POST['submit'])){
    post($_POST['title'],$_POST['text']);
    echo'submited! Refreshing in 2 seconds... <meta http-equiv="refresh" content="2">';
}
    
?>