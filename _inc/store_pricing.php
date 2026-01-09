<?php
function best_provider_source(PDO $pdo, int $store_product_id): ?array {
  $st = $pdo->prepare("
    SELECT pp.id AS provider_product_id, pp.base_price, ws.qty_available, ws.qty_reserved
    FROM store_product_sources sps
    JOIN provider_products pp ON pp.id = sps.provider_product_id AND pp.status='active'
    JOIN providers p ON p.id = pp.provider_id AND p.status='active'
    JOIN warehouse_stock ws ON ws.provider_product_id = pp.id
    WHERE sps.store_product_id = ? AND sps.enabled=1
      AND (ws.qty_available - ws.qty_reserved) > 0
    ORDER BY pp.base_price ASC, pp.id ASC
    LIMIT 1
  ");
  $st->execute([$store_product_id]);
  $r = $st->fetch();
  return $r ?: null;
}

function store_product_price(PDO $pdo, array $store, array $sp): array {
  if (!empty($sp['manual_price'])) {
    return [(float)$sp['manual_price'], (float)$sp['manual_price'], 'manual', null];
  }
  $best = best_provider_source($pdo, (int)$sp['id']);
  if ($best) {
    $base = (float)$best['base_price'];
    $sell = $base * (1.0 + ((float)$store['markup_percent'] / 100.0));
    return [$sell, $base, 'provider', (int)$best['provider_product_id'];
  }
  if ((int)$sp['own_stock_qty'] > 0) {
    $base = (float)($sp['own_stock_price'] ?? 0);
    if ($base < 0) $base = 0;
    return [$base, $base, 'seller_own', null];
  }
  return [0.0, 0.0, 'none', null];
}
?>
