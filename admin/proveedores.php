<?php require __DIR__.'/../config.php'; require __DIR__.'/../_inc/layout.php';
require_any_role(['superadmin','admin']);
$rows = $pdo->query("SELECT p.id, p.display_name, p.status, u.email, p.created_at FROM providers p JOIN users u ON u.id=p.user_id ORDER BY p.id DESC")->fetchAll();
page_header('Proveedores');
echo "<table border='1' cellpadding='6' cellspacing='0'><tr><th>ID</th><th>Nombre</th><th>Email</th><th>Status</th><th>Alta</th></tr>";
foreach($rows as $r){ echo "<tr><td>".h((string)$r['id'])."</td><td>".h($r['display_name'])."</td><td>".h($r['email'])."</td><td>".h($r['status'])."</td><td>".h($r['created_at'])."</td></tr>"; }
echo "</table>";
page_footer();
