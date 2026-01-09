<?php require __DIR__.'/../config.php'; require __DIR__.'/../_inc/layout.php';
require_any_role(['superadmin','admin']);
$rows = $pdo->query("SELECT s.id, s.display_name, s.wholesale_status, u.email, s.created_at FROM sellers s JOIN users u ON u.id=s.user_id ORDER BY s.id DESC")->fetchAll();
page_header('Vendedores');
echo "<table border='1' cellpadding='6' cellspacing='0'><tr><th>ID</th><th>Nombre</th><th>Email</th><th>Mayorista</th><th>Alta</th></tr>";
foreach($rows as $r){
  echo "<tr><td>".h((string)$r['id'])."</td><td>".h($r['display_name'])."</td><td>".h($r['email'])."</td><td>".h($r['wholesale_status'])."</td><td>".h($r['created_at'])."</td></tr>";
}
echo "</table>";
page_footer();
