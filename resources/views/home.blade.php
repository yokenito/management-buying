@extends('layouts.app')

@section('content')
    <main>
        <ul class="home-list">
            <li>
                <a href="{{route('estimates.index')}}" class="home-link">見積書</a>    
            </li>
            <li>
                <a href="{{route('receives.index')}}" class="home-link">納品書</a>
            </li>
            <li>
                <a href="{{route('bills.index')}}" class="home-link">請求書</a>
            </li>
        </ul>
    </main>
@endsection
