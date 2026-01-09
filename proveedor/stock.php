<?php require __DIR__.'/../config.php'; require __DIR__.'/../_inc/layout.php';
require_role('provider','/proveedor/login.php');
$st=$pdo->prepare('SELECT id FROM providers WHERE user_id=? LIMIT 1');
$st->execute([(int)$_SESSION['uid']]);
$p=$st->fetch();
if(!$p){ http_response_code(400); exit('Proveedor inválido'); }
$rows=$pdo->prepare("SELECT ws.qty_available, ws.qty_reserved, pp.title, pp.base_price FROM warehouse_stock ws JOIN provider_products pp ON pp.id=ws.provider_product_id WHERE pp.provider_id=? ORDER BY ws.qty_available DESC");
$rows->execute([(int)$p['id']]);
$list=$rows->fetchAll();
page_header('Proveedor - Stock en bodega');
echo "<table border='1' cellpadding='6' cellspacing='0'><tr><th>Producto</th><th>Base</th><th>Disponible</th><th>Reservado</th></tr>";
foreach($list as $r){
  echo "<tr><td>".h($r['title'])."</td><td>".h((string)$r['base_price'])."</td><td>".h((string)$r['qty_available'])."</td><td>".h((string)$r['qty_reserved'])."</td></tr>";
}
echo '</table>'; page_footer();
