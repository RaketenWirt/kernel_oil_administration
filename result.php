<?php
include "database/functions.php";


#########
// STRAINS
if(isset($_POST['insertStrain']))
{
  $name = strip_tags($_POST['name']);

  if (getStrainByName($name) != null)
  {
    header("Location:addStrain.php?msg=Sorte existiert bereits&err=1");
  }

  insertStrain($name);
  header("Location:getStrains.php?msg=Sorte hinzugefügt&err=0");

}

if(isset($_POST['updateStrain']))
{
  $id = strip_tags($_POST['updateStrain']);
  if(sizeOf(getStrainByID($id)) != 0)
    {
      updateStrain($id, $_POST['name']);
      header("Location:getStrains.php?msg=Sorte geändert&err=0");
    }
  else
  {
    header("Location:getStrains.php?msg=Sorte existiert nicht&err=1");
  }
}

if(isset($_POST['deleteStrain']))
{
  $id = $_POST['deleteStrain'];
  if(sizeOf(getStrainByID($id)) != 0)
    {
      deleteStrainByID($id);
      // deleteLabelByStrain()
      header("Location:getStrains.php?msg=Sorte gelöscht&err=0");
    }
  else
  {
    header("Location:getStrains.php?msg=Sorte existiert nicht&err=1");
  }

}


if(isset($_POST['insertBottle']))
{
  $ml = strip_tags($_POST['ml']);
  if (getBottleByMl($ml) != null)
  {
    header("Location:addBottle.php?msg=Flaschengröße existiert bereits&err=1");
  }

  insertBottle($ml);
  header("Location:getBottles.php?msg=Flasche hinzugefügt$err=0");
}

if(isset($_POST['updateBottle']))
{
  $ml = strip_tags($_POST['ml']);
  if(sizeOf(getBottleByID($_POST['updateBottle'])) != 0)
    {
      updateBottle($_POST['updateBottle'], $ml);
      header("Location:getBottles.php?msg=Flaschentyp geändert&err=0");
    }
  else
  {
    header("Location:getBottles.php?msg=Flasche existiert nicht&err=1");
  }
}

if(isset($_POST['deleteBottle']))
{
  if(sizeOf(getBottleByID($_POST['deleteBottle'])) != 0)
    {
      deleteBottleByID($_POST['deleteBottle']);
      header("Location:getBottles.php?msg=Flaschentyp gelöscht&err=0");
    }
  else
  {
    header("Location:getBottles.php?msg=Flaschentyp existiert nicht&err=1");
  }
}

if(isset($_POST['stockBottle']))
{
  $bottle = getBottleByID($_POST['stockBottle']);
  $amount = $bottle->amount + $_POST['amount'];
  if(sizeOf($bottle) != 0)
    {

      stockBottle($bottle->ID, $amount);
      header("Location:getBottles.php?msg=Flaschen eingelagert&err=0");
    }
  else
  {
    header("Location:getBottles.php?msg=Flasche existiert nicht&err=1");
  }
}

if(isset($_POST['insertPressing']))
{
  $date = strip_tags($_POST['date']);
  $amount = strip_tags($_POST['amount']);
  $barrels = strip_tags($_POST['barrels']);
  try{
    insertPressing($date, $amount, $barrels);
    header("Location:addPressing.php?msg=Pressung hinzugefügt&err=0");
  } catch (Exception $e)
  {
    header("Location:addPressing.php?msg=Hinzufügen fehlgeschlagen&err=1");
  }
}

if(isset($_POST['insertBarrel']))
{
  $date = strip_tags($_POST['date']);
  $literPerBarrel = strip_tags($_POST['literPerBarrel']);
  $strain = strip_tags($_POST['strain']);

  insertBarrel($strain, $literPerBarrel,$date);
  header("Location:addBarrel.php?msg=Fass hinzugefügt&err=0");
}

if(isset($_POST['insertBottling']))
{
  $date = strip_tags($_POST['date']);
  $amount = strip_tags($_POST['amount']);
  $pressing = strip_tags($_POST['pressing']);
  $bottle = strip_tags($_POST['bottle']);

  insertBottling($date, $amount, $pressing, $bottle);
  header("Location:addBottling.php?msg=Abfüllung hinzugefügt&err=0");
}

if(isset($_POST['insertCustomer']))
{
  try{
    $firstname = strip_tags($_POST['firstname']);
    $lastname = strip_tags($_POST['lastname']);
    $company = strip_tags($_POST['company']);
    $road = strip_tags($_POST['road']);
    $zip = strip_tags($_POST['ZIP']);
    $city = strip_tags($_POST['city']);
    $country = strip_tags($_POST['country']);

    // if(!is_numeric($_POST['ZIP']))
    // {
    //   throw new Exception("PLZ muss eine Zahl sein. Ihre Eingabe: ");
    // }
    // else
      insertCustomer($firstname, $lastname, $company, $road, $zip, $city, $country);
  }
  catch(Exception $e)
  {
    header("Location:addCustomer.php?msg=Es ist ein Fehler aufgetreten&err=1 ");
  }
  header("Location:getCustomers.php?msg=Kunde hinzugefügt&err=0");
}

if(isset($_POST['updateCustomer']))
{
  $firstname = strip_tags($_POST['firstname']);
  $lastname = strip_tags($_POST['lastname']);
  $company = strip_tags($_POST['company']);
  $road = strip_tags($_POST['road']);
  $zip = strip_tags($_POST['zip']);
  $city = strip_tags($_POST['city']);
  $country = strip_tags($_POST['country']);

  if(sizeOf(getCustomerByID($_POST['updateCustomer'])) != 0)
    {
      updateCustomer($_POST['updateCustomer'], $firstname, $lastname, $company, $road, $zip, $city, $country);
      header("Location:getCustomers.php?msg=Kunde bearbeitet&err=0");
    }
  else
  {
    header("Location:getCustomers.php?msg=Kunde existiert nicht&err=1");
  }
}

if(isset($_POST['deleteCustomer']))
{

  if(sizeOf(getCustomerByID($_POST['deleteCustomer'])) != 0)
    {
      deleteCustomerByID($_POST['deleteCustomer']);
      header("Location:getCustomers.php?msg=Kunde gelöscht&err=0");
    }
  else
  {
    header("Location:getCustomers.php?msg=Kunde existiert nicht&err=1");
  }
}

if(isset($_POST['insertUser']))
{
  $username = strtolower(strip_tags($_POST['username']));
  $password = strip_tags($_POST['password']);
  $email = strip_tags($_POST['email']);
  $admin = ($_POST['admin'] == null) ? "0" : "1" ;

  if (getUserByName($username) != 0)
  {
    header("Location:addUser.php?msg=Benutzer existiert bereits&err=1");
  }
  else
  {
    insertUser($username, $password, $email, $admin);
    header("Location:getUsers.php?msg=Benutzer hinzugefügt&err=0");
  }
}

if(isset($_POST['updateUser']))
{
  $username = strtolower(strip_tags($_POST['username']));
  $password = strip_tags($_POST['password']);
  $email = strip_tags($_POST['email']);
  $admin = strip_tags($_POST['admin']);
  if(isset($_POST['admin']))
        $admin = true;
  $user = getUserByID($_POST['updateUser']);
  if(sizeOf($user) != 0)
    {
      updateUser($_POST['updateUser'], $username, $password, $email, $admin);
      header("Location:getUsers.php?msg=Benutzer bearbeitet&err=0");
    }
  else
  {
    header("Location:getUsers.php?msg=Benutzer existiert nicht&err=1");
  }
}

if(isset($_POST['deleteUser']))
{

  if(sizeOf(getUserByID($_POST['deleteUser'])) != 0)
    {
      deleteUserByID($_POST['deleteUser']);
      header("Location:getUsers.php?msg=Benutzer entfernt&err=0");
    }
  else
  {
    header("Location:getCustomers.php?msg=Benutzer existiert nicht&err=1");
  }
}

if(isset($_POST['stockBottles']))
{
  $amount = strip_tags($_POST['amount']);
  $name = strip_tags($_POST['name']);

  stockBottles($amount, $name);
  header("Location:stockBottles.php?msg=Flaschen eingelagert&err=0");
}

if(isset($_POST['stockLabels']))
{
  $amount = strip_tags($_POST['amount']);
  $bottle = strip_tags($_POST['bottle']);
  $strain = strip_tags($_POST['strain']);

  stockLabels($amount,$bottle,$strain);
  header("Location:stockLabels.php?msg=Etiketten eingelagert&err=0");
}

if(isset($_POST['bottlePresssing']))
{
  $pressing = strip_tags($_POST['pressing']);
  $bool = strip_tags($_POST['bool']);

  bottlePresssing($pressing, $bool);
  header("Location:bottlePressing.php?msg=Pressung abgefüllt&err=0");
}

if (isset($_POST['login']))
{

  $username = strtolower(strip_tags($_POST['username']));
  $password = strip_tags($_POST['password']);
  $user = getUserByName($username);
  if($user == false)
    header("Location:login.php?msg=Benutzer existiert nicht&err=1");
  else if($user->password == $password)
  {
    session_start();
    $_SESSION['username'] = $user->username;
    $_SESSION['user'] = $user->ID;
    header("Location:index.php?msg=Willkommen ".$_SESSION['username']."&err=0");
  }
  else
  {
    header("Location:login.php?msg=Passwort falsch&err=1&user=".$username);
  }
}

if (isset($_POST['insertDelivery']))
{
  $strains = array();
  $bottles = array();
  $amounts = array();

  $customer = strtolower(strip_tags($_POST['customer']));
  $date = strtolower(strip_tags($_POST['date']));

  $strains = $_POST['strain'];
  $bottles = $_POST['bottle'];
  $amounts = $_POST['amount'];

  

  //echo $shipmentID;

  for($i = 0; $i < sizeOf($strains); $i++)
  {
    if ($i == 0)
      insertShipment($customer, $date);
    

    if($amounts[$i] <=  (getProductByStrainByBottle($strains[$i], $bottles[$i]) -> amount))
    {
      insertShipmentItem(getProductByStrainByBottle($strains[$i], $bottles[$i]) -> ID, getShipmentIDByCustomerByDate($customer, $date) -> ID, $amounts[$i]);
      updateProduct($strains[$i], $bottles[$i], $amounts[$i]);
    }
    else
    {
      header("Location:addDelivery.php?msg=Nicht genug " . getStrainByID($strains[$i]) -> name . " in der Größe "  . getBottleByID($bottles[$i]) -> name . " vorhanden&err=1");
      exit;
    }
  }

  header("Location:addDelivery.php?msg=Lieferung eingetragen&err=0");
}
?>