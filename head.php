<?php

  include_once "database/functions.php";
  restrict($level);

  $bodyClass = '';

  if($page != null)
    $bodyClass = 'class="'.$page.'"';

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Traubenkernölverwaltung</title>


    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/form.js"></script>
    <script src="js/functions.js"></script>
    <script src="js/jquery-1.7.min.js"></script>

    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="shortcut icon" type="image/png" href="images/grapes_hover.png"/>
  </head>
  <body <?php echo($bodyClass); ?>>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php"><h1>Traubenkernölverwaltung</h1></a>

        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <?php if(isset($_SESSION['user'])): ?>
              <li><a href="getBarrels.php">Fässer</a></li>
              <li><a href="getPressings.php ">Pressung</a></li>
              <li><a href="getBottlings.php ">Abfüllungen</a></li>
              <li><a href="getProducts.php">Produkte</a></li>
              <li><a href="getStrains.php">Sorten</a></li>
              <li><a href="getCustomers.php">Kunden</a></li>
              <li><a href="getDeliveries.php">Lieferungen</a></li>
              <?php if(isAdmin($_SESSION['user'])): ?>
              <li><a href="getUsers.php">Benutzer</a></li>
              <?php endif; ?>
              <li><a href="login.php?logout=1">Logout</a></li>
            <?php endif;?>

          </ul>
          </div><!--/.nav-collapse -->
        </div>
      </nav>
