<table id="customers" >
    <thead>
    <tr>
            <th>المنتج</th>
            <th>الفئة</th>
            <th>الكمية</th>
            <th>السعر</th>
            <th>الإجمالى</th>
    </tr>
    </thead>
    <tbody>
    @foreach($order->details as $detail)
        <tr>
            <td>{{$detail->product->title??''}}</td>
            <td>{{$detail->product->category->title??''}}</td>
            <td>{{$detail->qty}}</td>
            <td>{{$detail->price}}</td>
            <td>{{$detail->total}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
