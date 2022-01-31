<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="author" content="seif"/>

            <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet" />
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
            <link rel="stylesheet" href="styles.css">
            <title>Inscription</title>
        </head>
        <body>
        <div class="login-form">
            <?php 
                if(isset($_GET['reg_err']))
                {
                    $err = htmlspecialchars($_GET['reg_err']);

                    switch($err)
                    {
                        case 'success':
                        ?>
                            <div class="alert alert-success">
                                 inscription réussie !
                            </div>
                        <?php
                        break;

                        case 'password':
                        ?>
                            <div class="alert alert-danger">
                                 mot de passe différent
                            </div>
                        <?php
                        break;

                        case 'email':
                        ?>
                            <div class="alert alert-danger">
                                 email non valide
                            </div>
                        <?php
                        break;

                        case 'email_length':
                        ?>
                            <div class="alert alert-danger">
                                 email trop long
                            </div>
                        <?php 
                        break;

                        case 'pseudo_length':
                        ?>
                            <div class="alert alert-danger">
                                 pseudo trop long
                            </div>
                        <?php 
                        case 'already':
                        ?>
                            <div class="alert alert-danger">
                                 compte deja existant
                            </div>
                        <?php 

                    }
                }
                ?>
            
            <form action="inscription_traitement.php" method="post">
                <h2 class="text-center">Inscription</h2>       
                <div class="form-group">
                    <input type="text" name="pseudo" class="form-control" placeholder="Pseudo" required="required" autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Email" required="required" autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Mot de passe" required="required" autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="password" name="password_retype" class="form-control" placeholder="Re-tapez le mot de passe" required="required" autocomplete="off">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">S'inscrire</button>
                </div>   

            </form>
            <p class="text-center"><a href="index.php">Se Connecter</a></p>
        </div>
        </body>
</html>
