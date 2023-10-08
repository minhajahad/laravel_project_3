<x-backend.layouts.master>


    <div class="col-12">
        <div class="bg-light rounded h-100 p-4">
            <div class="card-header">
                Show <a class="btn btn-info mx-2" href="{{route('products.index')}}">List</a>

            </div>
            <div class="card-body">
                <h2>Name: {{$product->product_name}}</h2>
                <h2>Price: {{$product->selling_price}}</h2>
                <h2>Discounted Price: {{$product->discount_price}}</h2>

                <h1><img src="/storage/products/{{($product->product_image)}}" style="width: 300px; height: 300px;">

                </h1>

            </div>


        </div>
    </div>


</x-backend.layouts.master>