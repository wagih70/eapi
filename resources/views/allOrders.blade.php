@extends('layouts.app')

@section('content')
  
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <table id="cart" class="table table-hover table-condensed">
                <thead>
                <tr>
                    <th style="width:25%" class="text-center">Order Number</th>
                    <th style="width:25%" class="text-center">Total</th>
                    <th style="width:25%" class="text-center">Date</th>
                    <th style="width:25%" class="text-center">Status</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            
                            <td class="text-center">
                               <a style="color: black;" href="{{url('orders') }}/{{$order->id}}"> {{ $order->number }} </a>
                            </td>
                            <td class="text-center">
                               <a style="color: black;" href="{{url('orders') }}/{{$order->id}}"> $ {{ $order->total }} </a>
                            </td>
                            <td class="text-center">
                               <a style="color: black;" href="{{url('orders') }}/{{$order->id}}"> {{ $order->created_at }} </a>
                            </td>
                            <td class="text-center">
                                <div data-value="{{$order->id}}">
                                    <select name="status">
                                        <option disabled selected>{{$order->status}}</option>
                                        <option value="Placed">Placed</option>
                                        <option value="Shipped">Shipped</option>
                                        <option value="Received">Received</option>
                                    </select>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td><a href="{{ url('/') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
 
    <script type="text/javascript">

        $(document).ready(function ()
        {
            $('select[name="status"]').on('change',function()
            {
                 var status = jQuery(this).val();
                 var orderId = jQuery(this).parent().data('value');
                 if(orderId)
                 {
                    $.ajax({
                         url : '/update-status/' + orderId +'/'+status ,
                         type : "GET",
                         dataType : "json",
                         success: function (response) {
                            $("#card").load(" #card");
                         }
                    });
                 }
                 else
                 {
                    $('select[name="status"]').empty();
                 }
            });      
        });
    
    </script>
@endsection
