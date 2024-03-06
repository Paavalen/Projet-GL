<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['connecte']) || $_SESSION['connecte'] !== true) {
    // Rediriger l'utilisateur vers une page de connexion ou afficher un message d'erreur
    header('Location: index.html');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>projetT</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/Bold-BS4-Footer-Big-Logo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="assets/css/Modal-Login-form-1.css">
    <link rel="stylesheet" href="assets/css/Modal-Login-form.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css.css">
    <style>
        .bouton {
            margin-top: 20px;
        }

        /* Ajoutez d'autres styles personnalisés pour le bouton ici */
        .bouton button {
            padding: 15px 100px;
            margin-bottom: 25px;
            font-size: 16px;
            background-color: #5d6ede;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            margin-left: 50%;
            margin-right: 50%;
        }

        a.modifier:hover {
            background-color: rgb(75, 135, 239);
        }

        button.bouton:hover {
            background-color: #4CAF50;
        }
    </style>

</head>

<body>
    <!-- Bar de navigation -->
    <!-- Sidebar -->
    <div class="dashboard">
        <div class="navigation">
            <!-- Sidebar Holder -->
            <nav id="sidebar">
                <div class="logo">
                    <h3>
                        <img src="assets/img/Mascareignes.png" width="200px" height="70px">
                    </h3>
                </div>

                <ul class="liste_navbar">
                    <li class="active">
                        <a href="admin.php">
                            <i class="glyphicon glyphicon-home"></i>
                            Gestion utilisateur
                        </a>
                    </li>
                    <li>
                        <a href="a_rechercher.php">
                            <i class="glyphicon glyphicon-briefcase"></i>
                            Rechercher utilisateur
                        </a>
                    </li>
                    <li>
                        <a href="gestionUtilisateur.php">
                            <i class="glyphicon glyphicon-duplicate"></i>
                            Pages
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="deco">
                                <form action="deconnexion.php" method="post">
                                    <button type="submit">Déconnexion</button>
                                </form>
                            </div>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- Fin sidebar -->

            <!-- Contenu (droite sidebar) -->
            <div id="contenu">
                <div class="profile">
                    <ul class="session">
                        <li>
                            <div class="user-info">
                                <h3 class="user-label"> <img src="assets/img/utilisateur.png" alt="logUser" width="25px"
                                        height="25px"><br> Utilisateur: </h3>
                                <h3 class="user-value">
                                    <?php echo $_SESSION['utilisateur']; ?>
                                </h3>
                            </div>
                        </li>
                    </ul>
                </div>
                <h3 style="color: #5d6ede">Veuillez remplir le formulaire ci-dessous :</h3>
                <div class="formulaire">
                    <div class="container">
                        <div>

                            <!-- //////////////////////////////////////////////// Code php pour reccuperer les valeurs dans la base de donnees \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ -->
                            <?php
                            //connexion à la bd
                            $con = new mysqli("localhost", "root", "", "alumni");
                            if ($con->connect_error) {
                                die("Erreur de connexion : " . $con->connect_error);
                            } else {
                                // Vérifier d'abord si l'utilisateur existe déjà dans la table "utilisateur" en utilisant l'ID
                                $id_update = $_GET['id'];
                                $stmt = $con->prepare("SELECT * FROM utilisateur WHERE id = ?");
                                $stmt->bind_param("i", $id_update);
                                $stmt->execute();
                                $stmt_result = $stmt->get_result();

                                if ($stmt_result->num_rows > 0) {
                                    $data = $stmt_result->fetch_assoc();

                                    // Remplir les champs du formulaire avec les valeurs récupérées de la base de données
                                    $nom = $data['nom'];
                                    $prenom = $data['prenom'];
                                    $sexe = $data['sexe'];
                                    $ddn = $data['dateNaissance'];
                                    $adresse = $data['adresse'];
                                    $nationalite = $data['nationalite'];
                                    $telephone = $data['telephone'];
                                    $aadresse = $data['ancienAdresse'];
                                    $filiere = $data['filiere'];
                                    $anneeUniversite = $data['anneeEtude'];
                                    $profession = $data['profession'];
                                    $email = $data['email'];
                                    $motDePasse = $data['motDePasse'];

                                } else {
                                    echo "<h2>Utilisateur introuvable</h2>";
                                }
                            }
                            ?>
                            <!-- //////////////////////////////////////////////// Fin du code php \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ -->

                            <form action="update.php?id=<?php echo $id_update; ?>" method="post">
                                <div class="form-group mb-3">
                                    <!-- Nom -->
                                    <div id="formdiv">
                                        <div class="row" style="margin-right:0px;margin-left:0px;padding-top:24px;">
                                            <div class="col-md-8 offset-md-1">
                                                <p
                                                    style="margin-left:2%;font-family:Roboto, sans-serif;font-size:24px;">
                                                    <strong>Nom
                                                    </strong></p>
                                            </div>
                                            <div class="col-md-10 offset-md-1"><input class="form-control" type="text"
                                                    style="margin-left:0px;font-family:Roboto, sans-serif;" name="nom"
                                                    value="<?php echo $nom ?>" placeholder="Veuillez saisir votre nom">
                                            </div>
                                        </div>
                                        <!-- Prenom -->
                                        <div class="row" style="margin-right:0px;margin-left:0px;padding-top:24px;">
                                            <div class="col-md-8 offset-md-1">
                                                <p
                                                    style="margin-left:2%;font-family:Roboto, sans-serif;font-size:24px;">
                                                    <strong>Prenom </strong>
                                                </p>
                                            </div>
                                            <div class="col-md-10 offset-md-1"><input class="form-control" type="text"
                                                    style="margin-left:0px;font-family:Roboto, sans-serif;"
                                                    name="prenom" value="<?php echo $prenom ?>"
                                                    placeholder="Veuillez saisir votre prenom"></div>
                                        </div>
                                        <!-- Sexe -->
                                        <div class="row"
                                            style="margin-right:0px;margin-left:0px;padding-top:24px;margin-top:-16px;">
                                            <div class="col-md-8 offset-md-1">
                                                <p
                                                    style="margin-left:2%;font-family:Roboto, sans-serif;font-size:24px;">
                                                    <strong>Sexe </strong>
                                                </p>
                                            </div>
                                            <div class="col-md-10 offset-md-1"><select class="form-select"
                                                    style="font-family:Roboto, sans-serif;" name="sexe">
                                                    <optgroup label="Gender">
                                                        <option value="<?php echo $sexe ?>">Homme</option>
                                                        <option value="<?php echo $sexe ?>">Femme</option>
                                                    </optgroup>
                                                </select></div>
                                        </div>
                                        <!-- Date de naissance -->
                                        <div class="row" style="margin-right:0px;margin-left:0px;padding-top:24px;">
                                            <div class="col-md-8 offset-md-1">
                                                <p
                                                    style="margin-left:2%;font-family:Roboto, sans-serif;font-size:24px;">
                                                    <strong>Date de naissance </strong>
                                                </p>
                                            </div>
                                            <div class="col-md-10 offset-md-1"><input class="form-control"
                                                    value="<?php echo $ddn ?>" style="font-family:Roboto, sans-serif;"
                                                    name="ddn" type="date"></div>
                                        </div>
                                        <!-- Adresse -->
                                        <div class="row" style="margin-right:0px;margin-left:0px;padding-top:24px;">
                                            <div class="col-md-8 offset-md-1">
                                                <p
                                                    style="margin-left:2%;font-family:Roboto, sans-serif;font-size:24px;">
                                                    <strong>Adresse actuelle </strong>
                                                </p>
                                            </div>
                                            <div class="col-md-10 offset-md-1"><input class="form-control" type="text"
                                                    style="margin-left:0px;font-family:Roboto, sans-serif;"
                                                    name="adresse" value="<?php echo $adresse ?>"
                                                    placeholder="Veuillez saisir votre adresse actuelle"></div>
                                        </div>
                                        <!-- Nationalite -->
                                        <div class="row" style="margin-right:0px;margin-left:0px;padding-top:24px;">
                                            <div class="col-md-8 offset-md-1">
                                                <p
                                                    style="margin-left:2%;font-family:Roboto, sans-serif;font-size:24px;">
                                                    <strong>Nationalité</strong>
                                                </p>
                                            </div>
                                            <div class="col-md-10 offset-md-1"><input class="form-control" type="text"
                                                    style="margin-left:0px;font-family:Roboto, sans-serif;"
                                                    name="nationalite" value="<?php echo $nationalite ?>"
                                                    placeholder="Votre nationalité"></div>
                                        </div>

                                        <!-- Telephone -->
                                        <div class="row" style="margin-right:0px;margin-left:0px;padding-top:24px;">
                                            <div class="col-md-8 offset-md-1">
                                                <p
                                                    style="margin-left:2%;font-family:Roboto, sans-serif;font-size:24px;">
                                                    <strong>Numero de telephone</strong>
                                                </p>
                                            </div>
                                            <div class="col-md-10 offset-md-1" style="font-family:Roboto, sans-serif;">
                                                <input class="form-control" type="text" style="margin-left:0px;"
                                                    name="telephone" value="<?php echo $telephone ?>"
                                                    placeholder="Telephone">
                                            </div>
                                        </div>

                                        <!-- ancien adresse -->
                                        <div class="row" style="margin-right:0px;margin-left:0px;padding-top:24px;">
                                            <div class="col-md-8 offset-md-1">
                                                <p
                                                    style="margin-left:2%;font-family:Roboto, sans-serif;font-size:24px;">
                                                    <strong>Ancien adresse a Maurice</strong>
                                                </p>
                                            </div>
                                            <div class="col-md-10 offset-md-1"><input class="form-control" type="text"
                                                    style="margin-left:0px;font-family:Roboto, sans-serif;"
                                                    name="aadresse" value="<?php echo $aadresse ?>"
                                                    placeholder="Veuillez saisir votre ancien adresse a Maurice">
                                            </div>
                                        </div>

                                        <!-- Filiere -->
                                        <div class="row" style="margin-right:0px;margin-left:0px;padding-top:24px;">
                                            <div class="col-md-8 offset-md-1">
                                                <p
                                                    style="margin-left:2%;font-family:Roboto, sans-serif;font-size:24px;">
                                                    <strong>Filière au sein de l'université</strong>
                                                </p>
                                            </div>
                                            <div class="col-md-10 offset-md-1"><input class="form-control" type="text"
                                                    style="margin-left:0px;font-family:Roboto, sans-serif;"
                                                    name="filiere" value="<?php echo $filiere ?>"
                                                    placeholder="Veuillez saisir votre ancien adresse a Maurice">
                                            </div>
                                        </div>

                                        <!-- annee d'etude -->
                                        <div class="row" style="margin-right:0px;margin-left:0px;padding-top:24px;">
                                            <div class="col-md-8 offset-md-1">
                                                <p
                                                    style="margin-left:2%;font-family:Roboto, sans-serif;font-size:24px;">
                                                    <strong>Année d'études au sein de l'université </strong>
                                                </p>
                                            </div>
                                            <div class="col-md-10 offset-md-1"><input class="form-control"
                                                    style="font-family:Roboto, sans-serif;" name="anneeUniversite"
                                                    value="<?php echo $anneeUniversite ?>" type="date">
                                            </div>
                                        </div>

                                        <!-- Profession -->
                                        <div class="row" style="margin-right:0px;margin-left:0px;padding-top:24px;">
                                            <div class="col-md-8 offset-md-1">
                                                <p
                                                    style="margin-left:2%;font-family:Roboto, sans-serif;font-size:24px;">
                                                    <strong>Profession</strong>
                                                </p>
                                            </div>
                                            <div class="col-md-10 offset-md-1"><input class="form-control" type="text"
                                                    style="margin-left:0px;font-family:Roboto, sans-serif;"
                                                    name="profession" value="<?php echo $profession ?>"
                                                    placeholder="Veuillez saisir votre ancien adresse a Maurice">
                                            </div>
                                        </div>
                                        <!-- email -->
                                        <div class="row" style="margin-right:0px;margin-left:0px;padding-top:24px;">
                                            <div class="col-md-8 offset-md-1">
                                                <p
                                                    style="margin-left:2%;font-family:Roboto, sans-serif;font-size:24px;">
                                                    <strong>Email</strong>
                                                </p>
                                            </div>
                                            <div class="col-md-10 offset-md-1"><input class="form-control" type="text"
                                                    style="margin-left:0px;font-family:Roboto, sans-serif;" name="email"
                                                    value="<?php echo $email ?>"
                                                    placeholder="Veuillez saisir votre adresse email">
                                            </div>
                                        </div>
                                        <!-- Mot de passe -->
                                        <div class="row" style="margin-right:0px;margin-left:0px;padding-top:24px;">
                                            <div class="col-md-8 offset-md-1">
                                                <p
                                                    style="margin-left:2%;font-family:Roboto, sans-serif;font-size:24px;">
                                                    <strong>Mot de passe</strong>
                                                </p>
                                            </div>
                                            <div class="col-md-10 offset-md-1"><input class="form-control"
                                                    type="password"
                                                    style="margin-left:0px;font-family:Roboto, sans-serif;"
                                                    name="motDePasse" value="<?php echo $motDePasse ?>"
                                                    placeholder="Veuillez saisir votre mot de passe">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="bouton">
                                    <button type="submit">Valider</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin navbar -->
</body>

</html>