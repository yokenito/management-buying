@extends('layouts.app')

@section('content')
    <main>

        <!-- 検索機能 -->
        <h2 class="section-ttl mt-3">検索条件</h2>
        <form action="{{route('receives.searchestimateindex')}}" method="get" class="search-form">
            @csrf
            <div>
                <div class="my-2 d-flex">
                    <div class="ps-3">
                        <label for="issue_date" class="form-label">発行日：</label>
                        <div class="d-flex">
                            <input type="date" name="issue_date_start" value="{{$request->issue_date_start}}" class="form-control">
                            <span class="m-1">〜</span>
                            <input type="date" name="issue_date_end" value="{{$request->issue_date_end}}" class="form-control">
                        </div>
                    </div>
                    <div class="ps-3">
                        <label for="client">顧客：</label>
                        <input type="text" name="client" value="{{$request->client}}" class="form-control mt-2">
                    </div>
                    <div class="ps-3">
                        <label for="subject">件名：</label>
                        <input type="text"  name="subject" value="{{$request->subject}}" class="form-control mt-2">
                    </div>
                    
                    <div class="ps-3 col-xs-2">
                        <label for="person">担当者：</label>
                        <input type="text" name="person" value="{{$request->person}}" class="form-control mt-2 w-10">
                    </div>
                </div>

                <div class="ps-3 search-btn-box mt-2">
                    <button type="submit" class="btn btn-outline-secondary search-btn mt-2">検索</button>
                </div>
            </div>
        </form>

        <h2 class="section-ttl mt-3">受注見積一覧</h2>

        <div>
            <table class="estimate-table">
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