<?php
error_reporting(E_ALL);
require 'connect.php';

function spellcheck($word) {
    $link=mysqli_connect('localhost','dbuser','123','spellchecker');
    $output=array();
    $word=  mysqli_real_escape_string($link,$word);
    $query="SELECT word FROM english WHERE LEFT(word,1)='".substr($word,0,1)."'";
    $words=  mysqli_query($link,$query);
    while(($wordsrow=  mysqli_fetch_assoc($words))!==false && in_array($word, $wordsrow)==false){
        similar_text($word,$wordsrow['word'],$percent);
        if($percent>82){
           echo $wordsrow['word'],'<br>'; 
        }
    }
   
}
if(isset($_GET['word']) && $_GET['word']!=null){
    $word=$_GET['word'];
    $spellcheck=spellcheck($word);
}
?>
<html>
    <head>
        <title>Spell checker</title>
    </head>
    <body>
        <form action="" method="get">
            Check single word spelling:<p />
            <input type="text" name="word"/><p />
            <input type="submit" value="check"/>
        </form>
    </body>
</html>