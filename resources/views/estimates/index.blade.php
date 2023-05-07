@extends('layouts.app')

@push('scripts')
    <script src="{{asset('/js/script.js')}}"></script>
@endpush

@section('content')
    <main>
        <h2>テスト</h2>
        <button type="button" class="btn btn-outline-primary"><a href="{{route('estimates.create')}}" class="new-reg">新規見積追加</a></button>

        <!-- 担当者検索用モーダル -->
        @include('modals.search_person')
        @include('modals.search_client')

        <!-- 検索機能 -->
        <h2 class="section-ttl mt-3">検索条件</h2>
        <form action="{{route('estimates.searchindex')}}" method="get" class="search-form">
            @csrf
            <div>
                <div class="my-2 d-flex">
                    <div class="ps-3">
                        <label for="issue_date" class="form-label">発行日：</label>
                        <div class="d-flex">
                            <input type="date" name="issue_date_start" class="form-control">
                            <span class="m-1">〜</span>
                            <input type="date" name="issue_date_end" class="form-control">
                        </div>
                    </div>
                    <div class="ps-3">
                        <label for="client">顧客：</label>
                        <div class="d-flex">
                            <input type="text" name="client_name" class="form-control mt-2" id="set-client" value="{{old('client_name')}}" readonly>
                            <input type="hidden" name="client" id="set-client-id" value="{{old('client')}}" readonly>
                            <div class="my-parts mt-2" data-bs-toggle="modal" data-bs-target="#searchClientModal"><span></span></div>
                        </div>
                    </div>
                    <div class="ps-3">
                        <label for="subject">件名：</label>
                        <input type="text" name="subject" class="form-control mt-2">
                    </div>
                    <div class="ps-3 col-xs-2">
                        <label for="person">担当者：</label>
                        <div class="d-flex">
                            <input type="text" name="person_name" class="form-control mt-2 w-10" id="set-person" value="{{old('person_name')}}" readonly>
                            <input type="hidden" name="person" id="set-person-id" value="{{old('person')}}" readonly>
                            <div class="my-parts mt-2" data-bs-toggle="modal" data-bs-target="#searchPersonModal"><span></span></div>
                        </div>
                    </div>
                    
                    <div class="ps-3">
                        <label for="person">見積状況：</label>
                        <select name="status" class="form-control mt-2">
                            <option value=""></option>
                            <option value="0">作成中</option>
                            <option value="1">提示中</option>
                            <option value="2">受注</option>
                            <option value="3">期限切れ</option>
                        </select>
                    </div>
                </div>

                <div class="ps-3 search-btn-box mt-2">
                    <button type="submit" class="btn btn-outline-secondary search-btn mt-2">検索</button>
                </div>
            </div>
        </form>

        <h2 class="section-ttl mt-3">見積一覧</h2>

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
                    <th>見積状況</th>
                    <th></th>
                    <th></th>
                </tr>
                @foreach($estimates as $estimate)
                    <tr class="h50">
                        <td>{{$estimate->estimate_no}}</td>
                        <td>{{$estimate->issue_date}}</td>
                        <td>{{$estimate->client->client_name}}</td>
                        <td>{{$estimate->subject}}</td>
                        <td>{{number_format($estimate->sum_price)}} 円</td>
                        <td>{{$estimate->date_line}}</td>
                        <td>{{$estimate->delivery_line}}</td>
                        <td>{{$estimate->person->person_name}}</td>
                        @if($estimate->status == 0)
                            <td>作成中</td>
                        @elseif($estimate->status == 1)
                            <td>提示中</td>
                        @elseif($estimate->status == 2||$estimate->status == 4)
                            <td>受注</td>
                        @else
                            <td>期限切れ</td>
                        @endif
                        <td class="table-btn"><a href="{{route('estimates.show',$estimate)}}" class="estimate-show">明細</a></td>
                        <td class="table-btn">
                            @if($estimate->status == 1||$estimate->status == 2||$estimate->status == 4)
                            ー
                            @else
                                <button type="submit" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#confirmEstimateDeleteModal{{$estimate->id}}">
                                    削除
                                </button>
                            @endif
                        </td>
                    </tr>
                    <!-- 削除確認用モーダル -->
                    @include('modals.estimates.confirm_estimate_delete')
                @endforeach
            </table>
            <div>{{ $estimates->links() }}</div>
        </div>
    </main>
@endsection