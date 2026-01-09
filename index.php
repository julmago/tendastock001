<?php require __DIR__.'/config.php'; require __DIR__.'/_inc/layout.php';
page_header('TiendaStock');
echo "<p>Accesos:</p><ul>
<li><a href='/admin/login.php'>Admin</a></li>
<li><a href='/proveedor/register.php'>Registro Proveedor</a> | <a href='/proveedor/login.php'>Login Proveedor</a></li>
<li><a href='/vendedor/register.php'>Registro Vendedor</a> | <a href='/vendedor/login.php'>Login Vendedor</a></li>
<li><a href='/shop/'>Tiendas Minoristas (público)</a></li>
<li><a href='/mayorista/'>Tiendas Mayoristas (público)</a></li>
</ul>";
page_footer();
