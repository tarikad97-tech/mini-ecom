    <?php
    header('Content-Type: application/json');
     session_start();
    include '../../database/config.php';
    if(isset($_POST['email']) && isset($_POST['password'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM users WHERE email = '$email' AND password_hash = '$password'";
        $result = mysqli_query($db, $sql);
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
    ?>

