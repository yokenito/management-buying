@extends('layouts.app')

@section('content')
    <main>
        <button type="button" class="btn btn-outline-primary"><a href="{{route('clients.create')}}" class="new-reg">新規登録</a></button>
        

        <!-- 検索ソート機能 -->

        <h2 class="section-ttl mt-3">顧客一覧</h2>
        <div>
            <table class="client-table">
                <tr>
                    <th>顧客名</th>
                    <th>郵便番号</th>
                    <th>住所</th>
                    <th>電話番号</th>
                    <th>納品先</th>
                    <th>見積回数</th>
                    <th>受注回数</th>
                    <th></th>
                    <th></th>
                </tr>
                @foreach($clients as $client)
                    <tr>
                        <td>{{$client->client_name}}</td>
                        <td>{{$client->post_code}}</td>
                        <td>{{$client->client_address}}</td>
                        <td>{{$client->client_phone}}</td>
                        <td>{{$client->delivery_destination}}</td>
                        <td>{{$client->estimate_count}}</td>
                        <td>{{$client->receive_count}}</td>
                        <td class="table-btn"><a href="{{route('clients.edit', $client)}}" class="client-edit">編集</a></td>
                        <td class="table-btn">
                            <form action="{{route('clients.destroy', $client)}}" method="post">
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