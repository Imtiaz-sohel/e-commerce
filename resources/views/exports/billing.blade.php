<table>
    <thead>
        <tr>
            <th>SL</th>
            <th>Full Name</th>
            <th>Country</th>
            <th>State</th>
            <th>City</th>
            <th>Phone</th>
            <th>Pay Type</th>
            <th>Total Bill</th>
            <th>Diff. Shipping</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orderSearch as $key => $order)
        <tr>
            <td>{{ ++$key }}</td>
            <td>{{ $order->full_name }}</td>
            <td>{{ $order->country->name }}</td>
            <td>{{ $order->state->name }}</td>
            <td>{{ $order->city->name }}</td>
            <td>{{ $order->phone }}</td>
            <td>{{ $order->pay_type }}</td>
            <td>{{ $order->total_amount }}</td>
            <td>
                @if($order->different_shipping==1)
                    {{ "No" }}
                @else
                    {{ "Yes" }}    
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>