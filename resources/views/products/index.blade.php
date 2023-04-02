@extends('layouts.app')

@section('content')
    <main>
        <button type="button" class="btn btn-outline-primary"><a href="{{route('products.create')}}" class="new-reg">新規登録</a></button>
        

        <!-- 検索ソート機能 -->

        <h2 class="section-ttl mt-3">製品一覧</h2>
        <div>
            <table class="product-table">
                <tr>
                    <th>商品番号</th>
                    <th>商品名</th>
                    <th></th>
                    <th></th>
                </tr>
                @foreach($products as $product)
                    <tr>
                        <td class="product-id">{{$product->product_id}}</td>
                        <td>{{$product->product_name}}</td>
                        <td class="table-btn"><a href="{{route('products.edit', $product)}}" class="product-edit">編集</a></td>
                        <td class="table-btn">
                            <form action="{{route('products.destroy', $product)}}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-link">削除</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </main>
@endsection