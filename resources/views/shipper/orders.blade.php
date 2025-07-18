<h2>Orders from Connected Shopify Store</h2>

@if(!empty($error))
  <p style="color:red;">{{ $error }}</p>
@endif

<table class="table">
  <thead>
    <tr>
      <th>Order #</th>
      <th>Customer</th>
      <th>Total</th>
      <th>Status</th>
    </tr>
  </thead>
  <tbody>
    @forelse($orders as $order)
      <tr>
        <td>{{ $order['name'] }}</td> <!-- e.g. #1001 -->
        <td>
          @if(isset($order['customer']['first_name']))
            {{ $order['customer']['first_name'] }} {{ $order['customer']['last_name'] ?? '' }}
          @else
            N/A
          @endif
        </td>
        <td>{{ $order['total_price'] }} {{ $order['currency'] }}</td>
        <td>{{ ucfirst($order['financial_status']) }}</td>
      </tr>
    @empty
      <tr>
        <td colspan="4">No orders found.</td>
      </tr>
    @endforelse
  </tbody>
</table>
