@extends('layouts.app')

@push('script')
    <script src="{{asset('/js/script.js')}}"></script>
@endpush

@section('content')
    <main>
        <div>
            <a href="{{route('estimates.index')}}">&lt; 見積一覧</a>
        </div>

        <h2 class="section-ttl mt-2">見積明細</h2>
        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="mt-2 d-flex">
            <button type="button" class="btn btn-outline-primary">
                @if($estimate->status == 0)
                    <a href="{{route('estimates.edit', $estimate)}}" class="new-reg">変更</a>
                @else
                    <a href="#" class="new-reg">印刷</a>
                @endif
            </button>

            @if($estimate->status == 0)
                <button type="submit" class="btn btn-outline-dark ms-3" data-bs-toggle="modal" data-bs-target="#btn-confirm-EstimateModal{{$estimate->id}}">見積確定</button>
            @elseif($estimate->status == 1)
                <button type="submit" class="btn btn-outline-dark ms-3" data-bs-toggle="modal" data-bs-target="#btn-receive-EstimateModal{{$estimate->id}}">受注</button>
            @endif

            @if($estimate->status == 0)

            @else
                <button type="submit" class="btn btn-outline-dark ms-3" data-bs-toggle="modal" data-bs-target="#btn-copy-EstimateModal{{$estimate->id}}">再発行</button>
            @endif
        </div>

        <!-- ボタンモーダル -->
        @include('modals.estimates.btn_confirm_estimate')
        @include('modals.estimates.btn_receive_estimate')
        @include('modals.estimates.btn_copy_estimate')
        
        <p class="document-status">見積状況： 
            @if($estimate->status == 0)
                <td>作成中</td>
            @elseif($estimate->status == 1)
                <td>提示中</td>
            @elseif($estimate->status == 2||$estimate->status == 4)
                <td>受注</td>
            @else
                <td>期限切れ</td>
            @endif
        </p>
        <div class="document">
            <div class="document-inner">
                <h3 class="document-ttl">見積書</h3>
                <div class="doc-inf">
                    <h4 class="doc-client-name">{{$estimate->client->client_name}}　御中</h4>
                    <table class="doc-inf-table">
                        <tr>
                            <td>No</td>
                            <td>{{$estimate->estimate_no}}</td>
                        </tr>
                        <tr>
                            <td>見積日</td>
                            <td>{{$estimate->issue_date}}</td>
                        </tr>
                    </table>
                </div>

                <div class="doc-inf-2">
                    <div>
                        <p>下記の通り、御見積もり申し上げます。</p>
                        <table class="doc-inf-2-table">
                            <tr>
                                <td class="doc-inf-table-color">件名</td>
                                <td>{{$estimate->subject}}</td>
                            </tr>
                            <tr>
                                <td class="doc-inf-table-color">納期</td>
                                <td>{{$estimate->delivery_line}}</td>
                            </tr>
                            <tr>
                                <td class="doc-inf-table-color">支払条件</td>
                                <td>{{$estimate->pay_requirement}}</td>
                            </tr>
                            <tr>
                                <td class="doc-inf-table-color">有効期限</td>
                                <td>{{$estimate->date_line}}</td>
                            </tr>
                        </table>
                    </div>

                    <div class="company-inf">
                        <p>{{$companyinf['name']}}</p>
                        <p>〒{{$companyinf['post']}}</p>
                        <p>{{mb_substr($companyinf['address'],0,13)}}</p>
                        <p>{{mb_substr($companyinf['address'],14,23)}}</p>
                        <p>TEL: {{$companyinf['phone']}}</p>
                        <p>担当者: {{$estimate->person->person_name}}</p>
                    </div>
                </div>

                <table class="price-sum">
                    <tr>
                        <td>合計</td>
                        <td>{{number_format($estimate->sum_price)}} 円</td>
                    </tr>
                </table>

                <div class="table-all">
                    @if($estimate->status == 0)
                        <a href="{{route('estimatedetails.create', $estimate)}}">製品追加</a>
                    @endif

                    <table class="detail-table">
                        <tr>
                            <th>製品番号</th>
                            <th>製品</th>
                            <th>数量</th>
                            <th>単位</th>
                            <th>単価</th>
                            <th>金額</th>
                        </tr>
                        @foreach($estimatedetails as $estimatedetail)
                            <tr>
                                @if($estimate->status == 0)
                                    <td><a class="link-none" href="{{route('estimatedetails.edit', $estimatedetail)}}">{{$estimatedetail->product->product_id}}</a></td>
                                @else
                                    <td>{{$estimatedetail->product->product_id}}</td>
                                @endif
                                <td>{{$estimatedetail->product->product_name}}</td>
                                <td>{{$estimatedetail->product_count}}</td>
                                <td>個</td>
                                <td>{{number_format($estimatedetail->price)}}</td>
                                <td>{{number_format($estimatedetail->sum_price)}}</td>
                            </tr>
                        @endforeach

                        @for($i = 1; $i <= 12 - $estimatedetails_count; $i++)
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endfor
                    </table>
                    <table class="sum-line-table">
                        <tr class="sum-line">
                            <td></td> 
                            <td>合計</td>
                            <td class="text-end">{{number_format($estimate->sum_price)}}</td>
                        </tr>
                    </table>

                    <div class="estimate-requirement">
                        <p>＜見積条件＞</p>
                        <p>{{$estimate->estimate_requirement}}</p>
                    </div>
                    <div class="estimate-note">
                        <p>＜備考＞</p>
                        <p>{{$estimate->estimate_requirement}}</p>
                    </div>
                </div>
                
            </div>
        </div>

    </main>
@endsection