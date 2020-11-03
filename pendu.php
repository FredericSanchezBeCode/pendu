<style> 
form{
    position: absolute;
    width: 50%;
    top: 45%;
    left: 25%;    
}
button{
    width: 60px;
    height: 60px;
    background-color: #123456;
    color: aliceblue;
    font-size: 2em;
    font-variant: small-caps;
	
    }
	button:disabled{
		color: gray;
	}
h1{
    text-align: center;
    font-size: 5em;
}
#main{
    font-size: 2em;
    text-align: center; 
    margin-bottom: 0.2em;
    }    
.img{
    width: 250px;
    height: 400px;
    display: block;      
    margin: auto;  
    margin-bottom: 1em;            
}
 h1.titre{
    color:darkred;
    font-family:cursive; 
}    
</style>

<?php
session_start();
$dictionnaire=['ordinateur','javascript','smartphone','meteorologie','frederic'];

?>
<h1 class="titre">Le Pendu</h1>
<div id="main">
<?php
    
if(!isset($_SESSION['arr_word_to_find'])){
    $mot = $dictionnaire[array_rand($dictionnaire, 1)];
    $_SESSION['arr_word_to_find'] = str_split($mot);
    $_SESSION['arr_word_found'] = [] ;
    for($i = 0 ; $i < strlen($mot); $i++){
    
        array_push($_SESSION['arr_word_found'],"_");    
    }
    $_SESSION['lettresJouees'] = [];
    $pas_dedans= false;
	$_SESSION['nb_essais_restants']=8;
    
}
if(isset($_POST['lettreentree'])){
    $pas_dedans= true;
	
    array_push($_SESSION['lettresJouees'],$_POST['lettreentree']);
    if(in_array($_POST['lettreentree'], $_SESSION['arr_word_to_find'])){
        foreach($_SESSION['arr_word_to_find'] as $i => $v){
            if($v == $_POST['lettreentree']){
                $_SESSION['arr_word_found'][$i]=$v;
                $pas_dedans= false;
            }
        }
    }
 
}
for($i = 0 ; $i < count($_SESSION['arr_word_found']); $i++){
    
    echo $_SESSION['arr_word_found'][$i]. ' ';
}
?> 
<p><?php    
if(isset($pas_dedans) && $pas_dedans ){
    echo 'pas dedans'.'<br/>';  
	$_SESSION['nb_essais_restants']--;
}    
?>
</p>    
</div>
    
<?php    
if($_SESSION['arr_word_to_find']==$_SESSION['arr_word_found']){ 
    echo '<br/>'.'<h1>victoire !</h1>'.'<br/>';
    echo '<img src="images/champions.png" class="img">';    
}
else{
	if($_SESSION['nb_essais_restants']==0){
		echo '<br/>'.'<h1>T es mauvais !</h1>'.'<br/>';
		echo '<img src="images/loser.png" class="img">';
	}
}
?>
<form action="" method="post">
<?php
if(($_SESSION['arr_word_to_find']!=$_SESSION['arr_word_found']) && ($_SESSION['nb_essais_restants']>0)){
    foreach(range('a','z') as $lettre){
    echo '<button type="submit"';
	if(in_array($lettre, $_SESSION['lettresJouees'])){
		echo (' disabled ');
	}
	echo 'value='.$lettre.' name="lettreentree">'.$lettre.'</button> ';
    } 
}
/*	var_dump($_SESSION['lettresJouees']);  */
    ?>
</form>

