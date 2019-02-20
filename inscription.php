
<?php 



/*$nom= $prenom=$email=$confirm_email=$password=$confirm_password=$contact=$ville=$niveau=$serie=$prenomlenght="";*/
 
$nom_error=$prenom_error=$email_error=$confirm_email_error=$password_error=$confirm_password_error=$contact_error=$ville_error=$niveau_error=$serie_error="";


if (isset($_POST['submit'])){
            try{
         
          $bd=new PDO('mysql:host=127.0.0.1;dbname=INSCRIPTION_CR3TL;' ,'root','');
           }
      
      catch(Exception $e){


        die('Erreur:'.$e->getMessage());
      
      }
     

   if(!empty($_POST['name']) AND !empty($_POST['surname'])AND !empty($_POST['email'])AND !empty($_POST['confirm_email'])AND !empty($_POST['password'])AND !empty($_POST['confirm_password'])AND !empty($_POST['contact'])AND !empty($_POST['ville'])AND !empty($_POST['niveau'])AND !empty($_POST['serie']))
        {

            $nom=VerifyInput($_POST['name']);
            $prenom=VerifyInput($_POST['surname']);
            $email=VerifyInput($_POST['email']);
            $confirm_email=VerifyInput($_POST['confirm_email']);
            $password=VerifyInput(sha1($_POST['password']));
            $confirm_password=VerifyInput(sha1($_POST['confirm_password']));
            $contact=VerifyInput($_POST['contact']);
            $ville=VerifyInput($_POST['ville']);
            $niveau=$_POST['niveau'];
            $serie=$_POST['serie'];
            
            $lenght_nom=strlen($nom);
             
             if($lenght_nom<5){

               
              
              }
        
              else {

                $nom_error="5 caractères maxi!";
              }
             
        
  

     }
     

     else 
        { 
         $nom_error="champs requis!";
         $prenom_error="champs requis!";
         $email_error="champs requis!";
         $confirm_email_error="champs requis!";
         $password_error="champs requis!";
         $confirm_password_error="champs requis!";
         $contact_error="champs requis!";
         $ville_error="champs requis!";
         $niveau_error="champs requis!";
         $serie_error="champs requis!";
    
       }
}
    
  function verifyInput($var){

   $var=trim($var);
   $var=htmlspecialchars($var);
   $var=stripcslashes($var);
  }
     

?>






<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style1.css">
    <script src="js/jquery-1.11.1.js">
    </script>
    <script src="js/bootstrap.min.js"></script>
    <title>Inscription</title>
  </head>
  <body>
    <header>
      <?php include'entete1.php'?>
    </header>
    <div id="courses_box1">
      <div class="container">
        <h1 style="text-align:center;font-size:40px;color:white"><strong> Crée ton compte! </strong></h1>
        <form method="POST" id="form" class="form-container" action="" >
          <div class="row">
          
              <div class="col-md-6 col-lg-6 col-sm-12 col-xs-6">
                <input type="text" autocomplete="off" id="nom" class=" form-control" placeholder="Nom*" name="name">
                <p class="comment"><?php echo $nom_error;?></p>
            </div>
            
              <div class="col-md-6 col-lg-6 col-sm-12 col-xs-6">
                <input type="text" autocomplete="off" id="prenom" class=" form-control" placeholder="Prénom*" name="surname" >
               <p class="comment"><?php echo $prenom_error;?> </p>
            </div>
          </div>
          <div class="row">
    
              <div class="col-md-6 col-lg-6 col-sm-12 col-xs-6">
                <input type="text" autocomplete="off" id="email" class=" form-control" placeholder="Email *exemple  mail@domain.com"  name="email">
              <p class="comment"> </p>
               <p class="comment"> <?php echo $email_error;?> </p>
            </div>
            
              <div class="col-md-6 col-lg-6 col-sm-12 col-xs-6">
                <input type="email" id="verifyemail"class="required form-control" placeholder="confirmation email *" name="confirm_email" value="" autocomplete="off">
                <p class="comment"><?php echo $confirm_email_error;?></p>
              </div>
          
          </div>
          <div class="row">
      
              <div class="col-md-6 col-lg-6 col-sm-12 col-xs-6">
                <input type="password" id="password"class="required form-control" placeholder="Mot de passe *" name="password" value="">
                 <p class="comment"><?php echo $password_error;?></p>
          
            </div>
        
              <div class="col-md-6 col-lg-6 col-sm-12 col-xs-6">
                <input type="password" class="form-control" placeholder="Cofirmation du password*"autocomplete="on" id="verifypassword"  name="confirm_password" value="">
              <p class="comment"><?php echo $confirm_password_error;?></p>

              </div>
            
            
          </div>
          <div class="row">
            
              <div class="col-md-6 col-lg-6 col-sm-12 col-xs-6">
                <input type="text"  id="contact"class=" form-control" placeholder="contact *" autocomplete="on"name="contact" value="">
                <p class="comment"><?php echo $contact_error;?></p>


            </div>
      
              <div class="col-md-6 col-lg-6 col-sm-12 col-xs-6">
                <input type="text" class=" form-control" id="ville" placeholder="ville *" autocomplete="on"name="ville" value="">
              <p class="comment"><?php echo $ville_error;?></p>

              </div>
      
          </div>
          <div class="row">
            
              <div class="col-md-6 col-lg-6 col-sm-12 col-xs-6"  >
                <p class="comment">   <?php echo $niveau_error;?>  </p>
          
                <select name="niveau" type="text" placeholder="Formation" class = "form-control"  id = "formation_id">
                  <option value="--Classe--">-Classe-</option>
                  <option value="1">Troisième</option>
                  <option value="2">Terminale</option>
                </select>
              </div>
      
                <div class="col-md-6 col-lg-6 col-sm-12 col-xs-6">
                  <p class="comment"><?php echo $serie_error;?></p>
                  <select name="serie" required type="text" placeholder="" class = "form-control">
                    <option value="--Série--">--Série--</option>
                    <option value="1">A1</option>
                    <option value="2">A2</option>
                    <option value="3"> C</option>
                    <option value="4"> D</option>
                    <option value="5"> E</option>
                  </select>

              </div>
            </div>
            <div classs="row">
              <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                <button type="submit" id="submit" name="submit"class="btn btn-primary btn-block btn-circle" style="border-radius:30px; background-color: #37BDBF ;height:50px;margin:0 auto;width:50%;margin-top:25px" >
                  <p style="font-size:20px;color:#F26524 ">
                    <b> S'inscrire </b>
                  </p>
                </button>
              </div>
              <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                <h3 style="color:black;text-align:center">
                   Déja un compte ? 
                  <a href="connexion.php" style="text-decoration:none;color:#8B0000 "><strong> Connecte toi!</strong></a>
                </h3>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  
 
  

  <footer>
    <br>
    <br>
    <div class="container-fluid footer">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-6">
          <div class="contep" style="margin-left:25px">
            <h3><strong> Niveau et matières</strong></h3>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-3 col-sm-3 col-xs-3">
          <div class="contep" style="margin-left:25px">
            <h5>
              Niveau 3eme
            </h5>
            <ul>
              <li><a href="#"> Mathématiques</a></li>
              <li><a href="#">  Physiques-chimies</a></li>
              <li><a href="#"> Anglais </a></li>
              <li><a href="#"> Francais </a></li>
            </ul>
          </div>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-3">
          <h5>
            Niveau Terminal C-E
          </h5>
          <ul>
            <li><a href="#">Mathématiques</a></li>
            <li><a href="#"> Physiques-chimies </a></li>
            <li><a href="#">Francais </a></li>
            <li><a href="#"> SVT</a></li>
          </ul>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-3">
          <h5>
            Niveau Terminal D
          </h5>
          <ul>
            <li><a href="#">Mathématiques </a></li>
            <li><a href="#"> Physiques-chimies </a></li>
            <li><a href="#">Francais </a></li>
            <li><a href="#"> SVT </a></li>
          </ul>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-3">
          <h5>
            Niveau Terminal A
          </h5>
          <ul>
            <li><a href="#">Philosophie</a></li>
            <li><a href="#"> Anglais </a></li>
            <li><a href="#"> Francais </a></li>
            <li><a href="#">Allemand </a></li>
            <li><a href="#"> Espagnol </a></li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="contep" style="margin-left:25px">
          <div class="col-md-4 col-sm-4 col-xs-6">
            <h3><strong> Aides</strong></h3>
          </div>
          <div class="col-md-4 col-sm-4 col-xs-6">
            <h3><a href=""> Dévoirs-maison </a></h3>
          </div>
          <div class="col-md-4 col-sm-4 col-xs-6">
            <h3><a href=""> Cours-particuliers </a></h3>
          </div>
        </div>
      </div>
      <div class="row">
        <hr>
        <div class="content" style="margin-left:25px">
          <div class="col-md-4 col-sm-4 col-xs-3">
            <h3><a href="#">A propos de nous</a></h3>
          </div>
          <div class="col-md-4 col-sm-4 col-xs-4">
            <h3>Nous contacter </h3>
            <ul>
              <li>
                <h4>
                  <a href="#"><img src="image/facebook.png" class="img-reponsive" style="width:30px"> facebook </a>
                </h4>
              </li>
              <li>
                <h4>
                  <a href="#"><img src="image/whatapp.png" style="width:30px"class="img-reponsive">Whatsapp +225 xx.xx.xx.xx </a>
                </h4>
              </li>
              <li>
                <h4>
                  <a href="#"><img src="image/gmail.png" style="width:30px" class="img-reponsive"> email:cr3tl@gmail.com </a>
                </h4>
              </li>
            </ul>
          </div>
          <div class="col-md-4 col-sm-4 col-xs-4">
            <h3><a href="inscription_prof.php" style="text-decoration:none">Récrutement de pof à domicil </a></h3>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="copiright">
          <div class="col-md-12 col-sm-12 col-xs-6">
            <h4 class="pull-left"> © CR3TL 2019 </h4>
          </div>
        </div>
      </div>
    </div>
  </footer>
</body>
</html>
