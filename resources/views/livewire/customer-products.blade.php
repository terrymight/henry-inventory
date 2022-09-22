<div>
<button class="btn btn-secondary" wire:click.prevent="addProduct">+ Add Another Products</button>
    @foreach($customerProducts as $index => $customerProduct)
    <div class="row">
        <div class="col-4">
            <label>Products : </label><br />
            <select name="products[{{$index}}][pro]" id="products[{{$index}}][pro]" class="form-control">
                @foreach($allProducts as $product)
                <option @selected(old('name')==$product->name)>
                    {{ $product->name }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="col-3">
            <label>Quantity : </label>
            <input type="number" name="products[{{$index}}][qty]" id="products[{{$index}}][qty]" class="form-control" value="{{ old('products[qty]', $customerProduct['qty']) }}" placeholder="qty">
        </div>
        <div class="col-3">
            <label>Price : </label>
            <input type="number" name="products[{{$index}}][px]" value="{{ old('products[px]', $customerProduct['px']) }}" id="products[{{$index}}][px]" class="form-control" placeholder="price">
        </div>
        <div class="col-2">
            <a href="" wire:click.prevent="removeProduct({{ $index }})">Delete</a>
           
        </div>
    </div>
    @endforeach
</div>