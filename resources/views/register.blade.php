@extends('layouts.app')

@section('content')
    <main>
        <ul class="reg-list">
            <li>
                <a href="{{route('clients.index')}}" class="reg-link">顧客一覧</a>    
            </li>
            <li>
                <a href="{{route('products.index')}}" class="reg-link">製品一覧</a>
            </li>
            <li>
                <a href="{{route('people.index')}}" class="reg-link">担当者一覧</a>
            </li>
            <li>
                <a href="#" class="reg-link">ログアウト</a>
            </li>
        </ul>
    </main>
@endsection
