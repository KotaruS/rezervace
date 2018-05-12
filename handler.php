<?php
 require 'config.php';
 $db = connection();
$field = filter_input(INPUT_GET, 'field', FILTER_VALIDATE_INT);
$cas = filter_input(INPUT_GET, 'cas', FILTER_VALIDATE_INT);
$obsazeno = filter_input(INPUT_GET, 'obs', FILTER_VALIDATE_INT);
if (isset($field)) {
  $sql = 'UPDATE zdroje SET aktivni = 0 WHERE id = :id;';
  $stmt = $db->prepare($sql);
  $stmt->execute([':id' => $field]);
  header('Location: index.php');
}
if (isset($cas)) {
  $toggle = ($obsazeno==1) ? 0 : 1 ;
  $sql = 'UPDATE cas SET obsazeno =' . $toggle . ' WHERE id = :id;';
  $stmt = $db->prepare($sql);
  $stmt->execute([':id' => $cas]);
  header('Location: index.php');
}

?>
