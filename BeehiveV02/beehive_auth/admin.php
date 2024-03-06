<?php 
   session_start();

   include("php/config.php");
   if(!isset($_SESSION['valid'])){
    header("Location: index.php");
   }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, 
				initial-scale=1.0">
    <title>Accueil admin</title>
    <link rel="stylesheet" href="styleAdmin.css">
    <link rel="stylesheet" href="responsiveAdmin.css">
</head>

<body>

    <!-- for header part -->
    <header>

        <div class="logosec">
            <div class="logo">Bee hive</div>
            <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210182541/Untitled-design-(30).png"
                class="icn menuicn" id="menuicn" alt="menu-icon">
        </div>

        <div class="searchbar">
            <input type="text" placeholder="Search">
            <div class="searchbtn">
                <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210180758/Untitled-design-(28).png"
                    class="icn srchicn" alt="search-icon">
            </div>
        </div>

        <div class="message">
            <div class="circle"></div>
            <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210183322/8.png" class="icn" alt="">
            <div class="dp">
                <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210180014/profile-removebg-preview.png"
                    class="dpicn" alt="dp">
            </div>
        </div>

    </header>

    <div class="main-container">
        <div class="navcontainer">
            <nav class="nav">
                <div class="nav-upper-options">
                    <div class="nav-option option1">
                        <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210182148/Untitled-design-(29).png"
                            class="nav-img" alt="dashboard">
                        <h3> Dashboard</h3>
                    </div>

                    <div class="option2 nav-option">
                        <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210183322/9.png"
                            class="nav-img" alt="articles">
                        <h3> Utulisateur</h3>
                    </div>

                    <div class="nav-option option3">
                        <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210183320/5.png"
                            class="nav-img" alt="report">
                        <h3> Report</h3>
                    </div>

                    <div class="nav-option option4">
                        <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210183321/6.png"
                            class="nav-img" alt="institution">
                        <h3> Institution</h3>
                    </div>

                    <div class="nav-option option5">
                        <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210183323/10.png"
                            class="nav-img" alt="blog">
                        <h3> Profile</h3>
                    </div>

                    <div class="nav-option option6">
                        <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210183320/4.png"
                            class="nav-img" alt="settings">
                        <h3> Settings</h3>
                    </div>

                    <div class="nav-option logout">
                        <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210183321/7.png"
                            class="nav-img" alt="logout">
                        <h3> <a href="php/logout.php"> <button class="btn">Log Out</button> </a></h3>
                    </div>

                </div>
            </nav>
        </div>
        <div class="main">

            <div class="searchbar2">
                <input type="text" name="" id="" placeholder="Search">
                <div class="searchbtn">
                    <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210180758/Untitled-design-(28).png"
                        class="icn srchicn" alt="search-button">
                </div>
            </div>

            <div class="box-container">

                <div class="box box1">
                    <div class="text">
                        <h2 class="topic-heading"></h2>
                        <h2 class="topic">Nombre des utilisateurs</h2>
                    </div>

                    <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210184645/Untitled-design-(31).png"
                        alt="Views">
                </div>

                <div class="box box2">
                    <div class="text">
                        <h2 class="topic-heading">150</h2>
                        <h2 class="topic">Likes</h2>
                    </div>

                    <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210185030/14.png" alt="likes">
                </div>

                <div class="box box3">
                    <div class="text">
                        <h2 class="topic-heading">320</h2>
                        <h2 class="topic">Comments</h2>
                    </div>

                    <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210184645/Untitled-design-(32).png"
                        alt="comments">
                </div>

                <div class="box box4">
                    <div class="text">
                        <h2 class="topic-heading">70</h2>
                        <h2 class="topic">Published</h2>
                    </div>

                    <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210185029/13.png" alt="published">
                </div>
            </div>

            <div class="report-container">
                <div class="report-header">
                    <h1 class="recent-Articles">Liste des utilisateurs</h1>
                    
                </div>

                <table class="table">
                    <thead>
                        <tr class="titre">
                            <th>Username</th>
                            <th>Email</th>
                            <th>Age</th>
                            <th>Password</th>
                            <th>Update</th>
                            <th>Delete user</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Pour récupérer les informations dans la base de données et ensuite les afficher -->
                        <?php
                        $host = "localhost";
                        $username = "root";
                        $password = "";
                        $DBname = "beehive";

                        $bdd = mysqli_connect($host, $username, $password, $DBname);

                        if (mysqli_connect_errno()) {
                            die("Erreur de connexion: " . $mysqli_connect_error());
                        }

                        $sql = "SELECT * FROM users";
                        $resultat = $bdd->query($sql);

                        if (!$resultat) {
                            die("Erreur lors de l'exécution de la requête: " . $bdd->error);
                        }

                        while ($row = $resultat->fetch_assoc()) {
                            echo "
                            <tr>
                                <td>$row[Username]</td>
                                <td>$row[Email]</td>
                                <td>$row[Age]</td>
                                <td>$row[Password]</td>
                                <td>
                                    <button class='modifier' onclick=\"window.location.href='formUpdate.php?id=$row[Id]'\" style='color: blue;'><img src=\"assets/img/modifier.png\" alt=\"logUser\" width=\"25px\" height=\"25px\"></button>
                                    <button class='supprimer' onclick=\"window.location.href='delete.php?id=$row[Id]'\" style='color: red;'><img src=\"assets/img/effacer.png\" alt=\"logUser\" width=\"25px\" height=\"25px\"></button>
                                </td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="./index.js"></script>
</body>

</html>