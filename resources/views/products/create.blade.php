@extends('layouts.app')

@section('content')
    <main>
        <h2 class="section-ttl">新規製品の追加</h2>
        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{route('products.store')}}" method="post" class="w-75">
            @csrf
            <div class="mt-4">
                <label for="product_id" class="form-label">商品番号<span class="form-note">必須</span></label>
                <input type="number" name="product_id" class="form-control" value="{{old('product_id')}}">
            </div>
            <div class="mt-4">
                <label for="product_name" class="form-label">商品名<span class="form-note">必須</span></label>
                <input type="text" name="product_name" class="form-control" value="{{old('product_name')}}">
            </div>
            
            <button type="submit" class="btn btn-outline-primary mt-4">登録</button>
        </form>
    </main>
@endsection