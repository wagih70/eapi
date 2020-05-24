<a class="dropdown-item" href="{{ url('orders') }}/{{$notification->data['orderId']}}">
    Order number: {{$notification->data['number']}} has been {{$notification->data['status']}}
</a>