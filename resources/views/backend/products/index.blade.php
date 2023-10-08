<x-backend.layouts.master>
    <div class="col-12">
        <div class="bg-light rounded h-100 p-4">
            <div class="card-header">
                <a class="btn btn-info mx-2" href="{{route('products.create')}}">Add Products</a>
                All Products <span class="badge rounded-pill bg-danger"> {{count($products)}}</span>
            </div>
            <div class="card-body">
                @if(session('message'))
                <div class="alert alert-success">
                    <span class="close" data-dismiss="alert"></span>
                    <strong>{{session('message')}}</strong>
                </div>
                @endif
                <div class="table-responsive">
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th scope="col">SL</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Discounted Price</th>
                                <th scope="col">Percent</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $sl=0 @endphp
                            @foreach($products as $product)
                            <tr>
                                <td>{{++$sl}}</td>
                                <td>{{$product->product_name}}</td>
                                <td>{{$product->selling_price}}</td>
                                <td>
                                    @if($product->discount_price == null)
                                    <span class="badge rounded-pill btn btn-info">No Discount</span>
                                    @elseif($product->discount_price == 0)
                                    <span class="badge rounded-pill text-black">Free</span>
                                    @else
                                    {{$product->discount_price}}
                                    @endif
                                </td>
                                <td>
                                    @if($product->discount_price == null)
                                    <span class="badge rounded-pill btn btn-info">No Discount</span>
                                    @elseif($product->discount_price == $product->selling_price)
                                    <span class="badge rounded-pill btn btn-info">No Discount</span>
                                    @else
                                    @php
                                    $amount = $product->selling_price-$product->discount_price;
                                    $discount = ($amount/$product->selling_price)*100;
                                    @endphp
                                    <span class="badge rounded-pill bg-danger">{{round($discount)}}%</span>
                                    @endif
                                </td>
                                <td>
                                    @if($product->status==1)
                                    <span class="badge rounded-pill bg-success">Active</span>
                                    @else
                                    <span class="badge rounded-pill bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('products.show',['product'=>$product->id])}}"><i
                                            class=" fa fa-eye"></i></a>
                                    <a href="{{route('products.edit',['product'=>$product->id])}}"><i
                                            class=" fa fa-pencil"></i></a>
                                    <form style="display:inline"
                                        action="{{ route('products.destroy', ['product' => $product->id]) }}"
                                        method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('are sure want delete?')" style="font-size: 11px"><i
                                                class=" fa fa-trash"></i></button>

                                        @if($product->status == 1)
                                        <a href="{{ route('product.inactive', $product->id) }}" class="btn btn-primary"
                                            title="active"><i class="fa-solid fa fa-thumbs-up"></i></a>
                                        @else
                                        <a href="{{ route('product.active', $product->id) }}" class="btn btn-primary"
                                            title="Inactive"><i class="fa-solid fa fa-thumbs-down"></i></a>
                                        @endif
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-backend.layouts.master>