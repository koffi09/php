
<?php 
 

  

  error_reporting(E_ALL|E_NOTICE);
  $host_name="127.0.0.1";
  $bd_name="inscription_transfert";
  $user="root";
  $password="";
  try{

    $bd=new PDO("mysql:host="  .$host_name. ";dbname=".$bd_name,$user,$password);
    $bd->exec('SET NAME utf8');
  } 
    catch(Exeption $e){
    echo'Erreur:'.$e->getMessage().'<br>';
    echo 'numero:'.$e->getCode();

     }

   $nom= $prenom=$email=$confirm_email=$password=$confirm_password=$contact=$ville="";
   $isSuccess=false;
   $nom_error=$prenom_error=$email_error=$confirm_email_error=$password_error=$confirm_password_error=$contact_error=$ville_error=$niveau_error=$serie_error="";
if (isset($_POST['submit'])){
          
         
         
    
            $nom=VerifyInput($_POST['name']);
            $prenom=VerifyInput($_POST['surname']);
            $email=VerifyInput($_POST['email']);
            $confirm_email=VerifyInput($_POST['confirm_email']);
            $password=VerifyInput(sha1($_POST['password']));
            $confirm_password=VerifyInput(sha1($_POST['confirm_password']));
            $contact=VerifyInput($_POST['contact']);
            $ville=VerifyInput($_POST['ville']);
            $lenght_nom=strlen($nom);
            $lenght_ville=strlen($ville);
            $lenght_prenom=strlen($prenom);
            $lenght_password=strlen($_POST['password']);
            $isSuccess=True;
            // Verification du nom//
           
           if(!empty($nom))
             {
               if(!is_numeric($nom))
                 {
                      recup_valeur($nom,$prenom,$email,$password,$contact,$ville);
                     if($lenght_nom<=10)
                    {
                       
                    }else
                    {
                        $isSuccess=false;
                       $nom_error="10 caractères au maximum!";
                      }
                 
                  } else
                    {
                     $isSuccess=false;
                    $nom_error="Ce ci n'est pas un nom!";
                    }
             } else
              {

               $nom_error="Entrer un nom!";
               $isSuccess=false;
               }

             
               
            if(!empty($prenom))
                 {
                   if(!is_numeric($prenom))
                 {
                       if($lenght_prenom<=20)
                    {
                      
                     }
                     else
                     {

                       $prenom_error="20 caractères au maximum!";
                        $isSuccess=false;
                       }
                 
                  } else{

                    $prenom_error="Ce ci n'est pas un prenom!";
                    $isSuccess=false;
                    }

             } else
              {
                 
               $prenom_error="Entrer un prenom!"; 
                $isSuccess=false;
              }
            
              


              if(!empty($confirm_email)){
              
              }   
              else
              {
                 
                $confirm_email_error="Entrer une email ";
                 $isSuccess=false;
              }
         
           


            if(!empty($email))
             {  
                if(isEmail($email))
                {
                   $reqemail=$bd->prepare("SELECT*FROM coordonnees_membre WHERE email=?");
                   $reqemail->execute(array($email));
                   $existemail=$reqemail->rowCount();//selection des colnnes;
                   if($existemail==0)
                    {
                     recup_valeur($nom,$prenom,$email,$password,$contact,$ville); 
                    if($email==$confirm_email)
                         {
                         
                         }else
                         {
                            $email_error="Les  deux emails ne sont pas identiques";
                            $isSuccess=false;
                          }
                    
                    
                    }else
                    {  
                       $confirm_email_error="Désolé l'adresse email  existe deja!";
                       $email_error=" Désolé  l'adresse email existe deja!";
                       $isSuccess=false;
                     
                     }
                  
                  } else
                  {
                  $email_error=" Entrer une email valide!";
                  $isSuccess=false;

                  } 
                  
                 }else
                 {
              
                 $email_error=" Enter une email";
                  $isSuccess=false;
                 }

          
           
               // ville//
           if(!empty($ville)){
    
              if(!is_numeric($ville))
              {
                 

              } 
              else
              {
                $ville_error="La valeur Entrée n'est pas une ville";
                 $isSuccess=false;
               }
            } 
            else 
           {
            $ville_error="Entrer une ville!";
             $isSuccess=false;
           }

              

           if(!empty($_POST[('confirm_password')])){
                  


              } 
              else
              {

                 $confirm_password_error="Confirmez ce champ!";
                  $isSuccess=false;
                  } 
            
                      // verification email
            if(!empty($_POST['password'])){
               if($lenght_password>=6&&$lenght_password<=10)
                {
                  if($password==$confirm_password){
                     
                  }
                  else
                  {
                    $password_error="les mots de passes ne sont pas identiques!";
                    $confirm_password_error="les mots de passes ne sont pas identiques!";
                    $isSuccess=false;
                  }
                  
                }
                else
                {
                 $password_error="6 caractères au minimum ou 10 maximum";
                 $isSuccess=false;
                 
                }
              
           } 
           else{
               $isSuccess=false;
               $password_error="Veuillez entrer un mot de passe!";
            }

            // verification du contact//   
        

         if(!empty($contact)){
             if(isPhone($contact)){

             }else
             {
              $contact_error="Entrer un numéro valide!";
               $isSuccess=false;
             }
         }
         else
         {
          
          $contact_error="Entrer un contact!";
          $isSuccess=false;
         }
     
        if(empty($niveau)){

          $niveau_error="Choisir votre niveau";
        }
         
         

         
        // appel de la fonction pour recupererles valeurs en base de dnnée//
          recup_valeur($nom,$prenom,$email,$password,$contact,$ville);

}

   function recup_valeur($nom,$prenom,$email,$password,$contact,$ville){
      $bd = new PDO('mysql:host=127.0.0.1;dbname=inscription_transfert','root','');  
        if(!empty($nom)&&!empty($prenom)&&!empty($email)&&!empty($password)&&!empty($contact)&&!empty($ville))
          {
         $insertmembre= $bd->prepare('INSERT INTO coordonnees_membre (nom,prenom,email,password,contact,ville) VALUES(?,?,?,?,?,?)') ;
       $insertmembre->execute(array($nom,$prenom,$email,$password,$contact,$ville)); 
        
      }
      } 

   
   
   function isPhone($var){
    
    return preg_match("#^[0-9]{2}([-. ]?[0-9]{2}){3}$#", $var);

    }
 

  function isEmail($var){

   return filter_var($var,FILTER_VALIDATE_EMAIL);    

  }
  

 function verifyInput($var){

   $var=trim($var);
   $var=htmlspecialchars($var);
   $var=stripcslashes($var);
  
   return $var;
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
          <h2  class="remerciement" style="color:green;text-align:center;display:<?php if($isSuccess) echo 'block'; else echo 'none';?> "> Inscription Effectuée avec succès! </h2>

          <div class="row">
          
              <div class="col-md-6 col-lg-6 col-sm-12 col-xs-6">
                <input type="text" autocomplete="off" name="name"id="nom" placeholder="Nom*"class=" form-control" value="<?php if(isset($nom)){
                  echo($nom);} ?>">
                

                <p class="comment"><?php echo $nom_error;?></p>
            </div>
            
              <div class="col-md-6 col-lg-6 col-sm-12 col-xs-6">
                <input type="text" autocomplete="off" id="prenom" value="<?php if(isset($prenom)){
                  echo($prenom);} ?>" class=" form-control" placeholder="Prénom*" name="surname" >
               <p class="comment"><?php echo $prenom_error;?> </p>
            </div>
          </div>
          <div class="row">
    
              <div class="col-md-6 col-lg-6 col-sm-12 col-xs-6">
                <input type="text" value="<?php if(isset($email)){
                  echo($email);} ?>" autocomplete="off" id="email" class=" form-control" placeholder="Email *exemple  mail@domain.com"  name="email">
              <p class="comment"> </p>
               <p class="comment"> <?php echo $email_error;?> </p>
            </div>
            
              <div class="col-md-6 col-lg-6 col-sm-12 col-xs-6">
                <input type="text" value="<?php if(isset($confirm_email)){
                  echo($confirm_email);} ?>" id="verifyemail"class=" form-control" placeholder="confirmation email *" name="confirm_email" value="" autocomplete="off">
                <p class="comment"><?php echo $confirm_email_error;?></p>
              </div>
          
          </div>
          <div class="row">
      
              <div class="col-md-6 col-lg-6 col-sm-12 col-xs-6">
                <input type="password"  
                   id="password" class="form-control" placeholder="Mot de passe *" name="password">
                 <p class="comment"><?php echo $password_error;?></p>
          
            </div>
        
              <div class="col-md-6 col-lg-6 col-sm-12 col-xs-6">
                <input type="password" 
                   class="form-control"  placeholder="Cofirmation du password*"  id="verifypassword"  name="confirm_password">
              <p class="comment"><?php echo $confirm_password_error;?></p>

              </div>
            
            
          </div>
          <div class="row">
            
              <div class="col-md-6 col-lg-6 col-sm-12 col-xs-6">
                <input type="text"  id="contact"class=" form-control" placeholder="contact *" autocomplete="on"name="contact" value="<?php if(isset($contact)){
                  echo($contact);} ?> ">
                <p class="comment"><?php echo $contact_error;?></p>


            </div>
      
              <div class="col-md-6 col-lg-6 col-sm-12 col-xs-6">
                <input type="text" class=" form-control" id="ville" placeholder="ville *" autocomplete="on"name="ville" value="<?php if(isset($ville)){
                  echo($ville);} ?>">
              <p class="comment"><?php echo $ville_error;?></p>

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
