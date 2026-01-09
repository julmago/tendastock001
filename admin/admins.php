<?php require __DIR__.'/../config.php'; require __DIR__.'/../_inc/layout.php';
require_role('superadmin'); csrf_check();

if ($_SERVER['REQUEST_METHOD']==='POST') {
  $email = trim((string)($_POST['email'] ?? ''));
  $pass  = (string)($_POST['password'] ?? '');
  if ($email && $pass) {
    $hash = password_hash($pass, PASSWORD_DEFAULT);
    $pdo->prepare("INSERT INTO users(email,password_hash,role,status) VALUES(?,?, 'admin','active')")->execute([$email,$hash]);
    $msg = 'Admin creado.';
  } else $err='Completar email y contraseña.';
}

$rows = $pdo->query("SELECT id,email,status,created_at FROM users WHERE role='admin' ORDER BY id DESC")->fetchAll();

page_header('Admins internos');
if (!empty($msg)) echo "<p style='color:green'>".h($msg)."</p>";
if (!empty($err)) echo "<p style='color:#b00'>".h($err)."</p>";

echo "<form method='post'>
<input type='hidden' name='csrf' value='".h(csrf_token())."'>
<p><input name='email' placeholder='email' style='width:320px'></p>
<p><input name='password' placeholder='contraseña' style='width:320px'></p>
<button>Crear admin</button>
</form><hr>";

echo "<table border='1' cellpadding='6' cellspacing='0'><tr><th>ID</th><th>Email</th><th>Status</th><th>Alta</th></tr>";
foreach($rows as $r){
  echo "<tr><td>".h((string)$r['id'])."</td><td>".h($r['email'])."</td><td>".h($r['status'])."</td><td>".h($r['created_at'])."</td></tr>";
}
echo "</table>";
page_footer();
