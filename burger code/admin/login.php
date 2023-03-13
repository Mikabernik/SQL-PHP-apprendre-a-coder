
<?php
     
     require 'database.php';
     session_start();
     $email = $Error = $password = "";
 
     if(!empty($_POST)) {

        $email          = checkInput($_POST['email']);
        $password       = checkInput($_POST['password']);
         
        $db = Database::connect();
        $statement = $db->prepare("SELECT * FROM login WHERE  email = ? and password = ?");
        $statement->execute(array($email,$password));
        Database::disconnect();
        

        if($statement->fetch()){
            $_SESSION["email"] = $email;
            header("Location: index.php");
        }
        else {
            $Error = "wrong login";
        }
         
     }
 
     function checkInput($data) {
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);
       return $data;
     }
 ?>
 
 <!DOCTYPE html>
 <html>
     <head>
         <title>Burger Code</title>
         <meta charset="utf-8"/>
         <meta name="viewport" content="width=device-width, initial-scale=1">
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
         <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
         <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
         <link rel="stylesheet" href="../css/styles.css">
     </head>
     
     <body>
         <h1 class="text-logo"><span class="bi-shop"></span> Burger Code <span class="bi-shop"></span></h1>
         <div class="container admin">
             <div class="row">
                 <h1><strong>Login</strong></h1>
                 <br>
                 <form class="form" action="login.php" role="form" method="post" >
                     <br>
                     <div>
                         <label class="form-label" for="email">Name:</label>
                         <input type="text" class="form-control" id="email" name="email" placeholder="name" value="<?php echo $email;?>">
                     </div>
                     <br>
                     <div>
                         <label class="form-label" for="password">Password:</label>
                         <input type="password" class="form-control" id="password" name="password" placeholder="password" value="<?php echo $password;?>">
                     </div>
                     <br>
                     <span><?php echo "$Error"  ;?></span>
                     <br>
                     <div class="form-actions">
                         <button type="submit" class="btn btn-success"> se connecter</button>
                    </div>
                 </form>
             </div>
         </div>   
     </body>
 </html>
 