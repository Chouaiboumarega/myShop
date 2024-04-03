<?php
//initialisation  de la connexion
    $serverName = 'localhost';
    $userName = 'root';
    $password = '';
    $dbname = 'myshop1';
// création de la connexion
$connexion = new mysqli($serverName, $userName, $password, $dbname);

    $name='';
    $email='';
    $phone='';
    $adresse='';
//si method POST  est utilisé on récupère les données envoyées par le formulaire
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //on associe chaque variable à une valeur posté par le formulaire
    $name=$_POST['name'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $adresse=$_POST['adresse'];

    $errorMessage='';
    $succesMessage='';
    //verifier siles chanmps sont vides
    do{
        if (empty($name) || empty($email) || empty($phone) || empty($adresse)) {
            $errorMessage = "Vous devez remplir obligatoirement tout les champs";
            break;
    }
    //ajouter le nouveau client en bdd
    $sql ="INSERT INTO clients1 (name, email, phone, adresse)" .
        "VALUES ('$name','$email', '$phone' ,'$adresse')";
    $result = $connexion->query($sql);
    // si erreur dans la requete alors message
    if(!$result){
        $errorMessage = "Requete invalide :" .$connexion->error;
        break;
    }
    $name = '';
    $email = '';
    $phone = '';
    $adresse = '';
    $succesMessage = 'Le Client a bien été ajouté ! ';

    header("location:/myshop/index.php");
    exit;
    } while(false);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Create</title>
</head>
<body>
    <div class="container mt-4">
        <h2> Nouveau client</h2>
        <!-- message d'erreur-->
        <?php
            if(!empty($errorMessage)){
                echo"
                    <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    <strong>{$errorMessage}</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>
                ";
            }
        ?>
        <form method='post'>
            <div class="row mb3">
                <label class="col-sm-3 col-from-label">Nom</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name;?>">
                </div>
            </div>
            <div class="row mb3">
                <label class="col-sm-3 col-from-label">Email</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="email" value="<?php echo $email;?>">
                </div>
            </div>
            <div class="row mb3">
                <label class="col-sm-3 col-from-label">Telephone</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="phone" value="<?php echo $phone;?>">
                </div>
            </div>
            <div class="row mb3">
                <label class="col-sm-3 col-from-label">Adresse</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="adresse" value="<?php echo $adresse;?>">
                </div>
            </div>
            <?php
            // si l'id est renseigné 
                if(!empty($succesMessage)){
                    echo "
                    <div class='row mb3'>
                        <div class='offset-sm-3 col-sm-6'>
                            <div class='alert alert-succes alert-dismissible fade  show' role='alert'>
                                <strong>{$succesMessage}</strong>
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                    </div>
                    ";
                }
                
            ?>
            <div class="row mb3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Soumettre</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/myShop/index.php" role="button">Annuler</a>
                </div>
            </div>
        </form>    
    </div>
</body>
</html>