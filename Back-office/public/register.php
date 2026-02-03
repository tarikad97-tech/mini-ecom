    <?php
    header('Content-Type: application/json');
<<<<<<< HEAD
     session_start();
    include '../../database/config.php';
    if(isset($_POST['email']) && isset($_POST['password'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        $sql = "SELECT * FROM users WHERE email = '$email' AND password_hash = '$password'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0)
            {
                $row=mysqli_fetch_assoc($result);
                $_SESSION['email'] = $email;
                $_SESSION['id'] = $row['id'];
                $_SESSION['role'] = $row['role'];;
                echo json_encode(['message'=>'success']);
           
        }
        else{
            echo json_encode(['message'=>'Email ou mot de passe incorrect']);

        }
    }
=======
    session_start();
    include '../../database/config.php';
    
    if(isset($_POST['flname']) && isset($_POST['email']) && isset($_POST['password'])){
        $name =  $_POST['flname'];
        $email =  $_POST['email'];
        $password = $_POST['password'];
        
        $check_sql = "SELECT * FROM users WHERE email = '$email'";
        $check_result = mysqli_query($db, $check_sql);
        
        if(mysqli_num_rows($check_result) > 0){
            echo json_encode(['message'=>'Email déjà enregistré']);
        }
        else{
            $sql = "INSERT INTO users (name, email, password_hash, role) VALUES ('$name', '$email', '$password', 'client')";
            if(mysqli_query($db, $sql)){
               
                echo json_encode(['message'=>'success']);
            }
            else{
                echo json_encode(['message'=>'Erreur lors de l\'inscription']);
            }
        }
    }
    else{
        echo json_encode(['message'=>'Tous les champs sont requis']);
    }
>>>>>>> fe107523e3ffa606ce3c43c4eaab6700ce3544be
    ?>

