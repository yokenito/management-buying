@extends('layouts.app')

@push('script')
    <script src="{{asset('/js/script.js')}}"></script>
@endpush

@section('content')
    <main>
        <div>
            <a href="{{route('bills.index')}}">&lt; 請求書一覧</a>
        </div>

        <h2 class="section-ttl mt-2">請求明細</h2>
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
                @if($bill->status == 0)
                    <a href="{{route('bills.edit', $bill)}}" class="new-reg">変更</a>
                @else
                    <a href="#" class="new-reg">印刷</a>
                @endif
            </button>

            @if($bill->status == 0)
                <button type="submit" class="btn btn-outline-dark ms-3" data-bs-toggle="modal" data-bs-target="#btn-confirm-BillModal{{$bill->id}}">確定</button>
            @elseif($bill->status == 1)
                <button type="submit" class="btn btn-outline-dark ms-3" data-bs-toggle="modal" data-bs-target="#btn-ProcessModal{{$bill->id}}">処理済</button>
            @endif

        </div>

        <!-- ボタンモーダル -->
        @include('modals.bills.btn_confirm_bill')
        @include('modals.bills.btn_process')
        
        <p class="document-status">納品書状況： 
            @if($bill->status == 0)
                <td>作成中</td>
            @elseif($bill->status == 1)
                <td>提示中</td>
            @elseif($bill->status == 2)
                <td>処理済</td>
            @endif
        </p>
        <div class="document">
            <div class="document-inner">
                <h3 class="document-ttl">請求書</h3>
                <div class="doc-inf">
                    <h4 class="doc-client-name">{{$bill->rceive->client->client_name}}　御中</h4>
                    <table class="doc-inf-table">
                        <tr>
                            <td>No</td>
                            <td>{{$bill->bill_id}}</td>
                        </tr>
                        <tr>
                            <td>作成日</td>
                            <td>{{$bill->issue_date}}</td>
                        </tr>
                    </table>
                </div>

                <div class="doc-inf-2">
                    <div>
                        <p>下記の通り、御請求申し上げます。</p>
                        <table class="doc-inf-2-table">
                            <tr>
                                <td class="doc-inf-table-color">件名</td>
                                <td>{{$bill->rceive->subject}}</td>
                            </tr>
                            <tr>
                                <td class="doc-inf-table-color">支払期限</td>
                                <td>{{$bill->payment_date}}</td>
                            </tr>
                            <tr>
                                <td class="doc-inf-table-color">振込先</td>
                                <td>{{$companyinf['payinf']}}</td>
                            </tr>
                        </table>
                    </div>

                    <div class="company-inf">
                        <p>{{$companyinf['name']}}</p>
                        <p>〒{{$companyinf['post']}}</p>
                        <p>{{mb_substr($companyinf['address'],0,13)}}</p>
                        <p>{{mb_substr($companyinf['address'],14,23)}}</p>
                        <p>TEL: {{$companyinf['phone']}}</p>
                        <p>担当者: {{$bill->person->person_name}}</p>
                    </div>
                </div>

                <table class="price-sum mt-3">
                    <tr>
                        <td>合計</td>
                        <td>{{number_format($bill->rceive->sum_price)}} 円</td>
                    </tr>
                </table>

                <div class="table-all">

                    <table class="detail-table">
                        <tr>
                            <th>製品番号</th>
                            <th>製品</th>
                            <th>数量</th>
                            <th>単位</th>
                            <th>単価</th>
                            <th>金額</th>
                        </tr>
                        @foreach($details as $detail)
                            <tr>
                                <td>{{$detail->product->product_id}}</td>
                                <td>{{$detail->product->product_name}}</td>
                                <td>{{$detail->product_count}}</td>
                                <td>個</td>
                                <td>{{number_format($detail->price)}}</td>
                                <td>{{number_format($detail->sum_price)}}</td>
                            </tr>
                        @endforeach

                        @for($i = 1; $i <= 12 - $details_count; $i++)
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
                            <td class="text-end">{{number_format($bill->rceive->sum_price)}}</td>
                        </tr>
                    </table>

                    <div class="bill-note">
                        <p>＜備考＞</p>
                        <p>{{$bill->note}}</p>
                    </div>
                </div>
                
            </div>
        </div>

    </main>
@endsection