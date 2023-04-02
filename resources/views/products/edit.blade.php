@extends('layouts.app')

@section('content')
    <main>
        <h2 class="section-ttl">製品の編集</h2>
        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{route('products.update',$product)}}" method="post" class="w-75">
            @csrf
            @method('patch')
            <div class="mt-4">
                <label for="product_id" class="form-label">商品番号<span class="form-note">必須</span></label>
                <input type="number" name="product_id" class="form-control" value="{{old('product_id', $product->product_id)}}">
            </div>
            <div class="mt-4">
                <label for="product_name" class="form-label">商品名<span class="form-note">必須</span></label>
                <input type="text" name="product_name" class="form-control" value="{{old('product_name', $product->product_name)}}">
            </div>
            
            <button type="submit" class="btn btn-outline-primary mt-4">登録</button>
        </form>
    </main>
@endsection