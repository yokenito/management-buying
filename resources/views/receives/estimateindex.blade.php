@extends('layouts.app')

@section('content')
    <main>

        <h2 class="section-ttl mt-3">受注見積一覧</h2>

        <div>
            <table class="estimatesearch-table">
                <tr>
                    <th>見積番号</th>
                    <th>発行日</th>
                    <th>顧客</th>
                    <th>件名</th>
                    <th class="indextable-price">金額</th>
                    <th>有効期間</th>
                    <th>納期</th>
                    <th>担当者</th>
                    <th></th>
                </tr>
                @foreach($estimates as $estimate)
                    <tr>
                        <td>{{$estimate->estimate_no}}</td>
                        <td>{{$estimate->issue_date}}</td>
                        <td>{{$estimate->client->client_name}}</td>
                        <td>{{$estimate->subject}}</td>
                        <td>{{number_format($estimate->sum_price)}} 円</td>
                        <td>{{$estimate->date_line}}</td>
                        <td>{{$estimate->delivery_line}}</td>
                        <td>{{$estimate->person->person_name}}</td>
                        <td class="table-btn"><a href="{{route('receives.estimatecreate',$estimate)}}" class="estimate-show">作成</a></td>
                    </tr>
                @endforeach
            </table>
            <div>{{ $estimates->links() }}</div>
        </div>
    </main>
@endsection