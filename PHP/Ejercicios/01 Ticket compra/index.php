<style>
  body { display: flex; flex-direction: column; align-items: center; justify-content: center; height: 100dvh; }
  h1 { font-family: Arial; }
  table { border-collapse: collapse; width: 20rem; }
  table tr:nth-child(odd) { background-color: #e3e9ef; }
  table tr:last-of-type { background-color: #eef0c8ff; font-weight: bold; font-size: 1.2em; }
  table td { padding: 4px 10px; font-family: "JetBrains Mono", consolas, monospace; vertical-align: top; }
  table td:last-of-type { text-align: right; }
  table td span { display: block; color: gray; font-size: 0.7em; font-style: italic; }
</style>

<?php
  $VAT_RATE = 0.21;
  $products = ["Pera" => 2, "Pan" => 1, "Fregona" => 14, "Agua" => 0.8, "Filete" => 4.5, "Zumo" => 1, "Macarrones" => 2.4];
  $bought = ["Pera" => 5, "Pan" => 2, "Agua" => 3, "Fregona" => 0, "Filete" => 1, "Zumo" => 3, "Macarrones" => 2];

  // Output
  echo "<h1>Ticket de compra</h1>";
  echo "<table>";

  $accum_price = 0;
  $accum_vat = 0;

  foreach ($products as $key => $value) {
    $amt = $bought[$key];
    if ($amt) {
      $netPrice = $value * $amt;
      $vat = $netPrice * $VAT_RATE;
      $price = $netPrice + $vat;

      $accum_price += $price;
      $accum_vat += $vat;

      echo "<tr>
        <td>$amt</td>
        <td>$key</td>
        <td>".toCents($price)."€ <span>IVA: ".toCents($vat)."€</span></td>
      </tr>";
    }
  }

  echo "<tr>
    <td></td>
    <td>Total</td>
    <td>".toCents($accum_price)."€<span>IVA incl.: ".toCents($accum_vat)."€</span></td>
  </tr>";

  echo "</table>";
  

  function toCents($number) {
    return number_format($number, 2, '.', "");
  }