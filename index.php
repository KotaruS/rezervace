<?php
 require 'config.php';
?>
<!DOCTYPE html>
<html lang="cs">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rezervace</title>
</head>
<body>
<?php
$db= connection();
$sql = 'SELECT * FROM zdroje';
$stmt = $db->prepare($sql);
$stmt->execute();
$zdroje = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<main>
  <h1>Rezervace</h1><a href="add.php?field">přidat hřiště</a>
<?php
foreach ($zdroje as $zdroj) {
if ($zdroj['aktivni']==1) {

?>
  <div class="hriste">
    <h2><?php echo $zdroj['nazev']; ?></h2><a href="update.php?field=">upravit hřiště</a><a href="handler.php?field=<?php echo $zdroj['id'];?>">Smazat hřistě</a><a href="add.php?day=<?php echo $zdroj['id'];?>">přidat den</a>
  <?php
  $sql2 = 'SELECT * FROM den WHERE zdroje_id = :id ORDER BY datum ASC;';
  $stmt = $db->prepare($sql2);
  $stmt->execute([':id' => $zdroj['id']]);
  $dny = $stmt->fetchAll(PDO::FETCH_ASSOC);
  foreach ($dny as $den) {
  if ($den['aktivni']==1) {

  ?>
  <h3><?php  echo date('j. F Y', strtotime($den['datum'])); ?></h3><a href="add.php?cas=<?php echo $den['id'];?>">přidat čas</a>
<?php
$sql3 = 'SELECT * FROM cas WHERE den_id = :id1;';
$stmt = $db->prepare($sql3);
$stmt->execute([':id1' => $den['id']]);
$casy = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($casy as $cas) {
  // var_dump($cas);
$obsaz = ($cas['obsazeno']==1) ? 'red' : 'green' ;
?>
<a href="handler.php?cas=<?php echo $cas['id'];?>&obs=<?php echo $cas['obsazeno'];?>" style="background-color: <?php echo $obsaz; ?>"><?php  echo date('H:i', strtotime($cas['cas_start'])) . ' - ' . date('H:i', strtotime($cas['cas_konec'])); ?></a>
<?php
   }
 }}
?>
  </div>
<?php
 }
}
?>


</main>

</body>
</html>
