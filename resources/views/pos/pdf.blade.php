<h2>Purchase Order {{ $po->po_num }}</h2>
<p>Supplier: {{ $po->supplier->name }} | {{ $po->supplier->email }}</p>
<p>Pengiriman: {{ $po->shipping_method }} | Pembayaran: {{ $po->payment_method }}</p>
<table width="100%" border="1" cellspacing="0" cellpadding="6">
  <thead><tr><th>No</th><th>Item</th><th>Qty</th><th>Sat</th><th>Harga</th><th>Subtotal</th></tr></thead>
  <tbody>
  @foreach($po->items as $i=>$it)
    <tr>
      <td>{{ $i+1 }}</td><td>{{ $it->item->name }}</td><td>{{ $it->qty }}</td>
      <td>{{ $it->item->unit }}</td><td>{{ number_format($it->unit_price) }}</td><td>{{ number_format($it->subtotal) }}</td>
    </tr>
  @endforeach
  </tbody>
</table>
