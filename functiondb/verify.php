<?php
  include_once '../config/database.php';
try {
    $bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query= $bdd->prepare("SELECT id FROM users WHERE flag=:flag");
    $query->execute(array(':flag' => $_GET["flag"]));
    $val = $query->fetch();
    if ($val == null) {
        echo "Verification echouee";
        return (-1);
    }
    $query->closeCursor();
    $query= $bdd->prepare("UPDATE users SET verified='Y' WHERE id=:id");
    $query->execute(array('id' => $val['id']));
    $query->closeCursor();
    echo "Verification réussie <a href='../pages/login.php'>Se connecter</a>";
    return (0);
  } catch (PDOException $e) {
    return (-2);
  }
?>