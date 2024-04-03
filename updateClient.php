<?php

    $serverName = 'localhost';
    $userName = 'root';
    $password = '';
    $dbname = 'myshop1';

$connexion = new mysqli($serverName, $userName, $password, $dbname);

    $id = '';
    $name='';
    $email='';
    $phone='';
    $adresse='';

    $errorMessage='';
    $succesMessage='';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // RECUPERATION DES DONNEES ENVOYEES POUR LA MODIFICATION
    if (!isset($_GET["id"])) {
        // On affiche le formulaire
        header("location:/myshop/index.php");
        exit;
    }
    $id = $_GET["id"];

    $sql ="SELECT * FROM clients1 WHERE id=$id";
    $result=$connexion->query($sql);
    $row = $result->fetch_assoc();

    if(!$row){
        header("location:/myshop/index.php");
    exit;
    }
    $name= $row['name'];
    $email=  $row['email'];
    $phone= $row['phone'];
    $adresse= $row['adresse'];
    
} 
else{
//methode POST modifie les données du client
    $id = $_GET['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $adresse = $_POST['adresse'];

    do {
       if (empty($id) || empty($name) || empty($email) || empty($phone) || empty($adresse)) {
        $errorMessage = "Vous devez remplir obligatoirement tout les champs";
        break;
    }
    $sql ="UPDATE clients1
           SET name= '$name', email='$email', phone='$phone',adresse='$adresse'
           WHERE id=$id";
        
    $result = $connexion->query($sql);
        if (!$result) {
            $errorMessage= "Erreur dans la modification :" . $connexion->error;
            break;
}
    $succesMessage="Client Modifié avec succés!";

    header("location:/myshop/index.php");
    exit;
    } while(false); // permet d'utiliser des instructions Break

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Update</title>
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
        <form method="post">
            <input type="hidden" value="<?php echo $id; ?>">
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
                    <a class="btn btn-outline-primary" href="/myshop/index.php" role="button">Annuler</a>
                </div>
            </div>
        </form>    
    </div>
</body>
</html>