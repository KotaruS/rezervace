<?php
 require 'config.php';
 $db = connection();
?>
<!DOCTYPE html>
<html lang="cs">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rezervace</title>
<?php
$day = filter_input(INPUT_GET, 'day', FILTER_VALIDATE_INT);
$cas = filter_input(INPUT_GET, 'cas', FILTER_VALIDATE_INT);
if (isset($_GET['field']) && isset($_POST['button'])) {
  $sql = 'INSERT INTO zdroje (nazev, aktivni) VALUES (:nazev, 1);';
  $stmt = $db->prepare($sql);
  $stmt->execute([':nazev' => htmlspecialchars($_POST['nazev']) ]);
  header('Location: index.php');
}

if (isset($_GET['day']) && isset($_POST['button'])) {
  $sql = 'INSERT INTO den (datum, aktivni, zdroje_id) VALUES (:datum, 1, :hriste);';
  $stmt = $db->prepare($sql);
  $stmt->execute([':datum' =>  htmlspecialchars($_POST['datum']),
                  ':hriste' => $day]);
  header('Location: index.php');
}

if (isset($_GET['cas']) && isset($_POST['button'])) {
  $sql = 'INSERT INTO cas (den_id, cas_start, cas_konec, obsazeno) VALUES (:den, :cas1, :cas2, 0);';
  $stmt = $db->prepare($sql);
  $stmt->execute([':den' => $cas,
                  ':cas1' => htmlspecialchars($_POST['cas1']),
                  ':cas2' => htmlspecialchars($_POST['cas2'])]);
  header('Location: index.php');
}
?>
</head>
<body>
  <?php if (isset($_GET['field'])) {
  ?>
 <form action="" method="post">
  <input type="text" name="nazev" placeholder="Nazev hriste">
  <button type="submit" name="button">Submit</button>
 </form>
<?php } if (isset($_GET['day'])) {
?>
<form action="" method="post">
<input type="date" name="datum" min="<?php echo date('Y-m-d');?>" value="<?php echo date('Y-m-d');?>">
<button type="submit" name="button">Submit</button>
</form>
<?php } if (isset($_GET['cas'])) {
?>
<form action="" method="post">
<input type="time" name="cas1">
<input type="time" name="cas2">

<button type="submit" name="button">Submit</button>
</form>
<?php } ?>
</body>
</html>
