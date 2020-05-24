@extends('layouts.app')

@section('content')
  
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card" id="card" style="margin-bottom: 30px;">
                <div class="card-header">Order No: {{$order->number}}
                    <div data-value="{{$order->id}}">
                        Status: {{$order->status}}
                    </div>
                </div>
                <div class="card-body">
                    <table id="cart" class="table table-hover table-condensed">
                        <thead>
                        <tr>
                            <th style="width:60%">Product</th>
                            <th style="width:10%">Price</th>
                            <th style="width:8%">Quantity</th>
                            <th style="width:22%" class="text-center">Subtotal</th>
                        </tr>
                        </thead>
                        <tbody>

                            @foreach($order->orderItems as $item)

                            <tr>
                                <td data-th="Product">
                                    <div class="row">
                                        <div class="col-sm-3 hidden-xs"><img src="{{ $item->photo }}" width="100" height="100" class="img-responsive"/></div>
                                        <div class="col-sm-9">
                                            <h5 class="nomargin">{{ $item->name }}</h5>
                                        </div>
                                    </div>
                                </td>
                                <td data-th="Price" >$ {{ $item->price }}</td>
                                <td data-th="Quantity" class="text-center">{{ $item->quantity }}</td>
                                <td data-th="Subtotal" class="text-center">${{ (int)$item->price * (int)$item->quantity }}</td>
                            </tr>

                            @endforeach

                        </tbody>
                        <tfoot>
                        <tr>   
                            <td><a href="{{ url('/') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td> 
                            <td colspan="2" class="hidden-xs"></td>
                            <td class="hidden-xs text-center"><strong>Total ${{ $order->total }}</strong>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
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

                $.ajax({
                     url : '/update-status/' + orderId +'/'+status ,
                     type : "GET",
                     dataType : "json",
                     success: function (response) {
                        $("#card").load(" #card");
                     }
                });
                 
            });      
        });
    
    </script>
@endsection
