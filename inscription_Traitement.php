<?php 
    require_once 'config.php'; // connexion à la bdd

    
    if(!empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['password_retype']))
    {
        
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $password_retype = htmlspecialchars($_POST['password_retype']);

        // vérifie si l'utilisateur existe
        $check = $bdd->prepare('SELECT pseudo, email, password FROM utilisateurs WHERE email = ?');
        $check->execute(array($email));
        $data = $check->fetch();
        $row = $check->rowCount();

        $email = strtolower($email); 
        
        // l'utilisateur n'existe pas 
        if($row == 0){ 
            if(strlen($pseudo) <= 100){ // longueur du pseudo <= 100
                if(strlen($email) <= 100){ // longueur du mail <= 100
                    if(filter_var($email, FILTER_VALIDATE_EMAIL)){ // l'email est de la bonne forme
                        if($password === $password_retype){ // les deux mdp saisis sont bon

                            // hash le mot de passe
                            $cost = ['cost' => 12];
                            $password = password_hash($password, PASSWORD_BCRYPT, $cost);

                            // insère dans la base de données
                            $insert = $bdd->prepare('INSERT INTO utilisateurs(pseudo, email, password) VALUES(:pseudo, :email, :password)');
                            $insert->execute(array(
                                'pseudo' => $pseudo,
                                'email' => $email,
                                'password' => $password,
                            ));
                            // message de succès
                            header('Location:inscription.php?reg_err=success');
                            die();
                        }else{ header('Location: inscription.php?reg_err=password'); die();}
                    }else{ header('Location: inscription.php?reg_err=email'); die();}
                }else{ header('Location: inscription.php?reg_err=email_length'); die();}
            }else{ header('Location: inscription.php?reg_err=pseudo_length'); die();}
        }else{ header('Location: inscription.php?reg_err=already'); die();}
    }
