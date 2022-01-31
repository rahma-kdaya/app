<?php 
    session_start(); // Demarrage de la session
    require_once 'config.php'; // connexion à la base de données

    if(!empty($_POST['email']) && !empty($_POST['password'])) 
    {
        
        $email = htmlspecialchars($_POST['email']); 
        $password = htmlspecialchars($_POST['password']);
        $email = strtolower($email);
        

        $check = $bdd->prepare('SELECT pseudo, email, password FROM utilisateurs WHERE email = ?');
        $check->execute(array($email));
        $data = $check->fetch();
        $row = $check->rowCount();
        
        

        //  l'utilisateur existe
        if($row > 0)
        {
            if(filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                if(password_verify($password, $data['password']))
                {
                    $_SESSION['user'] = $data['pseudo'];
                    header('Location: landing.php');
                    die();
                }else{ 
                    setcookie("PHPSESSID", "", time() - 3600, "/");
                    session_destroy(); 
                    header('Location: index.php?login_err=password'); die(); }
            }else{ 
                setcookie("PHPSESSID", "", time() - 3600, "/");
                 session_destroy(); 
                header('Location: index.php?login_err=email'); die(); }
        }else{ 
            setcookie("PHPSESSID", "", time() - 3600, "/");
            session_destroy();    
            header('Location: index.php?login_err=already'); die(); }
    }else{
        setcookie("PHPSESSID", "", time() - 3600, "/");
        session_destroy(); 
        header('Location: index.php'); die();
    } 