<?php

require('session.php');

?>


<?php

    $username = "root";
    $password = "";
    $host = "127.0.0.1";
    $dbname = "ecvdphp";


    try{
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION ); 
    }   
    catch (\PDOException $e){
    echo $e->getMessage();
    }



   /* echo trim($_POST["nom"]);
    echo trim($_POST["mdp"]);
    echo trim($_POST["email"]);*/

        $file = file("users.txt");
            if(isset($_POST['nom']) && empty($_POST['nom']) == false && isset($_POST['mdp']) && empty($_POST['mdp']) == false && isset($_POST['email']) && empty($_POST['email']) == false) {
  /*          $data = $_POST['nom'] . '.+.' . $_POST['mdp'] . '.+.' . $_POST['email'] . "\n";*/
/*            var_dump($file);*/

           

            try{
                $result = $conn->prepare('SELECT username, password, email FROM users WHERE username = :username AND password = :password AND email = :email');
                $result->bindParam(':username', $_POST['nom'], PDO::PARAM_STR);
                $result->bindParam(':password', $_POST['mdp'], PDO::PARAM_STR);
                $result->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
                $result->execute();
                if($result->fetchAll()) {

                    $_SESSION['login_user']=$_POST['nom'];
                    $_SESSION['pwd_user']=$_POST['mdp'];

                    header('Location: connect.php');
                     exit;
                }
            }   
            catch (\PDOException $e){
                echo $e->getMessage();
            }

            
           /* foreach($file as $line) {

                if($line == $data) {
                    echo $data . " is in the users.txt";
                    
                    $_SESSION['login_user']=$_POST['nom'];
                    $_SESSION['pwd_user']=$_POST['mdp'];

                    header('Location: connect.php');
                     exit;
                }
            }
        }*/
    }
    else {
       die('no post data to process');
    }
?>

<?php

echo md5($_POST["mdp"]);


?>

