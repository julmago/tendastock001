<?php require __DIR__.'/../config.php'; require __DIR__.'/../_inc/layout.php';
require_role('seller','/vendedor/login.php');
$st=$pdo->prepare("SELECT id,display_name,wholesale_status FROM sellers WHERE user_id=? LIMIT 1");
$st->execute([(int)$_SESSION['uid']]);
$s=$st->fetch();
page_header('Vendedor');
if(!$s){ echo "<p>No existe perfil vendedor.</p>"; page_footer(); exit; }
echo "<p>Vendedor: <b>".h($s['display_name'])."</b> | Mayorista: <b>".h($s['wholesale_status'])."</b></p>";
page_footer();
