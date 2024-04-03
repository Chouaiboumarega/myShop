<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href ="style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>myShop</title>
</head>
<body>
    <div class="container mt-4">
        <h1>Liste des clients</h1>
        <a href="/myshop/createClients.php?id=$row[id]'" class="btn btn-primary">Ajouter un client</a>
        <table class="table">
            <thead>
                <tr class="title">
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Adresse</th>
                    <th>Created_at</th>
                    <th>Action</th>
                </tr>
            </thead>    
            <tbody>
            <!-- debut du code de connexion avec la bdd -->
            <?php
                $serverName = 'localhost';
                $userName = 'root';
                $password = '';
                $dbname = 'myshop1';
            // création de la connexion
            $connexion = new mysqli($serverName, $userName, $password,$dbname);
            // verifier si la connexion a reussie
            if ($connexion->connect_error) {  
                die("Connexion échouée: " . $connexion->connect_error);
            }
            //lire toutes les données de la table clients
            $sql = "SELECT * FROM clients1";
            $result = $connexion -> query($sql); 
            // verifier si la requete est executéé correctement
            if(!$result){
                die ("Requete invalide :" .$conn->error());
            }
            // lire les data de chaque ligne
            while($row = $result->fetch_assoc()){
                echo"
                    <tr>
                        <td>$row[id]</td>
                        <td>$row[name]</td>
                        <td>$row[email]</td>
                        <td>$row[phone]</td>
                        <td>$row[adresse]</td>
                        <td>$row[created_at]</td>
                        <td>
                        <a class='btn btn-primary' href='/myshop/updateClient.php?id=$row[id]'> Modifier </a>
                        <a class='btn btn-danger' href='/myshop/deleteClient.php?id=$row[id]'> Supprimer </a>
                        </td>    
                    </tr>
                ";
            }
            ?>           
            </tbody>
        </table>
    </div>
</body>
</html>