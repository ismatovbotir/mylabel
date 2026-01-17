<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>80mm POS Receipt</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: monospace;
      background: #fff;
      padding: 0;
    }

    .receipt {
      width: 72mm;
      max-width: 100%;
      padding: 10px;
      margin: auto;
    }

    .center {
      text-align: center;
    }

    .bold {
      font-weight: bold;
    }

    .line {
      border-top: 1px dashed #000;
      margin: 10px 0;
    }

    table {
      width: 100%;
      font-size: 12px;
    }

    td, th {
      padding: 3px 0;
    }

    .items td:last-child,
    .totals td:last-child {
      text-align: right;
    }

    .footer {
      margin-top: 10px;
      font-size: 10px;
      text-align: center;
    }

    @media print {
      body {
        margin: 0;
        padding: 0;
      }

      .receipt {
        margin: 0;
        width: 72mm;
      }
    }
  </style>
</head>
<body onload="printPromot()">

  <div class="receipt">
    <div class="center bold">My Store</div>
    <div class="center">Tashkent, Uzbekistan</div>
    <div class="center">Tel: +998 90 123 4567</div>

    <div class="line"></div>

    <table>
      <tr><td>Date:</td><td>2025-04-15</td></tr>
      <tr><td>Invoice:</td><td>#POS-1005</td></tr>
      <tr><td>Cashier:</td><td>Ali</td></tr>
    </table>

    <div class="line"></div>

    <table class="items">
      <thead class="bold">
        <tr><th>Item</th><th>Total</th></tr>
      </thead>
      <tbody>
        <tr><td>Scanner</td><td>$120.00</td></tr>
        <tr><td>Label x2</td><td>$40.00</td></tr>
        <tr><td>Ribbon</td><td>$15.00</td></tr>
      </tbody>
    </table>

    <div class="line"></div>

    <table class="totals">
      <tr><td>Subtotal:</td><td>$175.00</td></tr>
      <tr><td>Tax (10%):</td><td>$17.50</td></tr>
      <tr class="bold"><td>Total:</td><td>$192.50</td></tr>
      <tr><td>Paid:</td><td>$200.00</td></tr>
      <tr><td>Change:</td><td>$7.50</td></tr>
    </table>

    <div class="line"></div>

    <div class="center">Thank you!</div>
    <div class="footer">No returns without receipt</div>
  </div>
  <script>
    function printPromot() {
        window.print();
    }
</script>
</body>
</html>
