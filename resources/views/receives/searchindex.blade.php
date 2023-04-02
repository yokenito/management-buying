@extends('layouts.app')

@push('scripts')
    <script src="{{asset('/js/script.js')}}"></script>
@endpush

@section('content')
    <main>
        <!-- 作成用モーダル -->
        @include('modals.receives.create_receive')
        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#createReceiveModal">納品書作成</button>
        
        <!-- 担当者検索用モーダル -->
        @include('modals.search_person')
        @include('modals.search_client')

        <!-- 検索ソート機能 -->
        <h2 class="section-ttl mt-3">検索条件</h2>
        <form action="{{route('receives.searchindex')}}" method="get" class="search-form">
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
                        <div class="d-flex">
                            <input type="text" name="client_name" class="form-control mt-2" id="set-client" value="{{$request->client_name}}" readonly>
                            <input type="hidden" name="client" id="set-client-id" value="{{$request->client}}" readonly>
                            <div class="my-parts mt-2" data-bs-toggle="modal" data-bs-target="#searchClientModal"><span></span></div>
                        </div>
                    </div>
                    <div class="ps-3">
                        <label for="subject">件名：</label>
                        <input type="text"  name="subject" value="{{$request->subject}}" class="form-control mt-2">
                    </div>
                    <div class="ps-3 col-md-1">
                        <label for="estimate_id">見積番号：</label>
                        <input type="text" name="estimate_id" value="{{$request->estimate_id}}" class="form-control mt-2">
                    </div>
                    <div class="ps-3 col-md-2">
                        <label for="person">担当者：</label>
                        <div class="d-flex">
                            <input type="text" name="person_name" class="form-control mt-2 w-10" id="set-person" value="{{$request->person_name}}" readonly>
                            <input type="hidden" name="person" id="set-person-id" value="{{$request->person}}" readonly>
                            <div class="my-parts mt-2" data-bs-toggle="modal" data-bs-target="#searchPersonModal"><span></span></div>
                        </div>
                    </div>
                    
                    <div class="ps-3">
                        <label for="person">納品書状況：</label>
                        <select name="status" class="form-control mt-2">
                            <option value="" <?php if($request->status==null){echo "selected";} ?>></option>
                            <option value="0" <?php if($request->status=="0"){echo "selected";} ?>>作成中</option>
                            <option value="1" <?php if($request->status==1){echo "selected";} ?>>受注</option>
                            <option value="2" <?php if($request->status==2){echo "selected";} ?>>請求済</option>
                        </select>
                    </div>
                </div>

                <div class="ps-3 search-btn-box mt-2">
                    <button type="submit" class="btn btn-outline-secondary search-btn mt-2">検索</button>
                </div>
            </div>
        </form>


        <h2 class="section-ttl mt-3">納品書一覧</h2>
        <div>
            <table class="estimate-table">
                <tr>
                    <th>納品書番号</th>
                    <th>見積番号</th>
                    <th>発行日</th>
                    <th>顧客</th>
                    <th>件名</th>
                    <th class="indextable-price">金額</th>
                    <th>納期</th>
                    <th>担当者</th>
                    <th>納品書状況</th>
                    <th></th>
                    <th></th>
                </tr>
                @foreach($receives as $receive)
                    <tr>
                        <td>{{$receive->receive_id}}</td>
                        <td>
                            @if($receive->estimate_id == null)
                            ー
                            @else
                            {{$receive->estimate->estimate_no}}
                            @endif
                        </td>
                        <td>{{$receive->issue_date}}</td>
                        <td>{{$receive->client->client_name}}</td>
                        <td>{{$receive->subject}}</td>
                        <td>{{number_format($receive->sum_price)}} 円</td>
                        <td>{{$receive->delivery_line}}</td>
                        <td>{{$receive->person->person_name}}</td>
                        @if($receive->status == 0)
                            <td>作成中</td>
                        @elseif($receive->status == 1)
                            <td>受注</td>
                        @elseif($receive->status == 2)
                            <td>請求済</td>
                        @endif
                        <td class="table-btn"><a href="{{route('receives.show',$receive)}}" class="estimate-show">明細</a></td>
                        <td class="table-btn">
                            <button type="submit" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#confirmReceiveDeleteModal{{$receive->id}}">
                                削除
                            </button>
                        </td>
                    </tr>
                    <!-- 削除確認用モーダル -->
                    @include('modals.receives.confirm_receive_delete')
                @endforeach
            </table>
        </div>
    </main>
@endsection