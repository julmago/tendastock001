<?php require __DIR__.'/../config.php'; require __DIR__.'/../_inc/layout.php';
require_any_role(['superadmin','admin']);
page_header('Admin');
echo "<ul>
<li><a href='/admin/admins.php'>Admins internos</a></li>
<li><a href='/admin/aprobaciones.php'>Aprobaciones</a></li>
<li><a href='/admin/proveedores.php'>Proveedores</a></li>
<li><a href='/admin/catalogo_proveedor.php'>Catálogo proveedor</a></li>
<li><a href='/admin/bodega.php'>Bodega (recepciones/stock)</a></li>
<li><a href='/admin/vendedores.php'>Vendedores</a></li>
<li><a href='/admin/tiendas.php'>Tiendas</a></li>
<li><a href='/admin/settings.php'>Settings / Comisiones</a></li>
</ul>";
page_footer();
