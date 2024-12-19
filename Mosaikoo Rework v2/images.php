<!-- Aucune modifictaion faites -->

<?php
    Session_start() ;
    if(empty($_SESSION['autorisation']) && $_SESSION['autorisation'] != true ){
        header('location : verif.php');
        exit();  
      }
    
?>



<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>les images</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>

    <link rel="stylesheet" href="css/style.css">

    <?php
	
//connexion à la BDD
require "config.php" ;
$bdd=connect() ;


$modif = $_GET['modif'];
$_SESSION['modif'] = $modif;

$sql = "SELECT * from essai where EMAIL='$modif' order by ID_ESSAIE";
$resultat = $bdd->query($sql);

?>
    <style>
        .slider {
            width: 500px;
            height: auto;
            background-color: black;
            margin-left: auto;
            margin-right: auto;
            margin-top: 0px;
            text-align: center;
            overflow: hidden;
        }
        .image-container {
            width: 1500px;
            background-color: pink;
            clear: both;
            position: relative;
            -webkit-transition: left 2s;
            -moz-transition: left 2s;
            -o-transition: left 2s;
            transition: left 2s;
        }
        .slide {
            float: left;
            margin: 0px;
            padding: 0px;
            position: relative;
        }
        #slide-1:target ~ .image-container {
            left: 0px;
        }
        #slide-2:target ~ .image-container {
            left: -500px;
        }

        .buttons {
            position: relative;
            top: -20px;
        }
        .buttons a {
            display: inline-block;
            height: 15px;
            width: 15px;
            border-radius: 50px;
            background-color: lightgreen;
        }
    </style>
</head>

        <?php     
        $compt=0;
        while($essai = $resultat->fetch(PDO::FETCH_OBJ))
        {

        ?>
        <style>
            #slide-<?php echo $compt+1?>:target ~ .image-container {
                left: 0px;
            }      
            #slide-<?php echo $compt+2?>:target ~ .image-container {
                left: -500px;
            }
        </style>
        <body>
        <div class="slider">
            <span id="slide-<?php echo $compt+1?>"></span>
            <span id="slide-<?php echo $compt+2?>"></span>
            <div class="image-container">
                <img src="<?php echo $essai->IMAGE_D_ENTREE ?>" class="slide" width="500" height="auto" />
                <img src="<?php echo $essai->IMAGE_MOSAIQUE ?>" class="slide" width="500" height="auto" />
            </div>
            <div class="buttons">
                <a href="#slide-<?php echo $compt+1?>"></a>
                <a href="#slide-<?php echo $compt+2?>"></a>
            </div>
            </div>

    </div>
    
</body>
    <?php    
    $compt+=2;
        }
        ?>
        
    <a class="btn btn-outline-info mb-5 mt-5  " href="prospect.php">Revenir a la liste</a>

</html>