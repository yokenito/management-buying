@extends('layouts.app')

@section('content')
    <main>
        <h2 class="section-ttl">新規顧客の追加</h2>
        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{route('clients.store')}}" method="post" class="w-75">
            @csrf
            <div>
                <label for="client_name" class="form-label">顧客名<span class="form-note">必須</span></label>
                <input type="text" name="client_name" class="form-control" value="{{ old('client_name') }}">
            </div>
            <div class="mt-4">
                <label for="post_code" class="form-label">郵便番号<span class="form-note">必須</span></label>
                <input type="number" name="post_code" class="form-control" value="{{old('post_code')}}">
            </div>
            <div class="mt-4">
                <label for="client_address" class="form-label">住所<span class="form-note">必須</span></label>
                <input type="text" name="client_address" class="form-control" value="{{old('client_address')}}">
            </div>
            <div class="mt-4">
                <label for="client_phone" class="form-label">電話番号</label>
                <input type="number" name="client_phone" class="form-control" value="{{old('client_phone')}}">
            </div>
            <div class="mt-4">
                <label for="delivery_destination" class="form-label">基本納品先</label>
                <input type="text" name="delivery_destination" class="form-control" value="{{old('delivery_destination')}}">
            </div>
            
            <button type="submit" class="btn btn-outline-primary mt-4">登録</button>
        </form>
    </main>
@endsection