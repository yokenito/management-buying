@extends('layouts.app')

@push('script')
    <script src="{{asset('/js/script.js')}}"></script>
@endpush

@section('content')
    <main>
        <div>
            <a href="{{route('receives.index')}}">&lt; 納品書一覧</a>
        </div>

        <h2 class="section-ttl mt-2">納品明細</h2>
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
                @if($receive->status == 0)
                    <a href="{{route('receives.edit', $receive)}}" class="new-reg">変更</a>
                @else
                    <a href="#" class="new-reg">印刷</a>
                @endif
            </button>

            @if($receive->status == 0)
                <button type="submit" class="btn btn-outline-dark ms-3" data-bs-toggle="modal" data-bs-target="#btn-confirm-ReceiveModal{{$receive->id}}">確定</button>
            @elseif($receive->status == 1)
                <button type="submit" class="btn btn-outline-dark ms-3" data-bs-toggle="modal" data-bs-target="#btn-InvoiceModal{{$receive->id}}">請求済</button>
            @endif

        </div>

        <!-- ボタンモーダル -->
        @include('modals.receives.btn_confirm_receive')
        @include('modals.receives.btn_invoice')
        
        <p class="document-status">納品書状況： 
            @if($receive->status == 0)
                <td>作成中</td>
            @elseif($receive->status == 1)
                <td>受注</td>
            @elseif($receive->status == 2)
                <td>請求済</td>
            @endif
        </p>
        <div class="document">
            <div class="document-inner">
                <h3 class="document-ttl">納品書</h3>
                <div class="doc-inf">
                    <h4 class="doc-client-name">{{$receive->client->client_name}}　御中</h4>
                    <table class="doc-inf-table">
                        <tr>
                            <td>No</td>
                            <td>{{$receive->receive_id}}</td>
                        </tr>
                        <tr>
                            <td>作成日</td>
                            <td>{{$receive->issue_date}}</td>
                        </tr>
                    </table>
                </div>

                <div class="doc-inf-2">
                    <div>
                        <p>下記の通り、納品致します。</p>
                        <table class="doc-inf-2-table">
                            <tr>
                                <td class="doc-inf-table-color">件名</td>
                                <td>{{$receive->subject}}</td>
                            </tr>
                            <tr>
                                <td class="doc-inf-table-color">納期</td>
                                <td>{{$receive->delivery_line}}</td>
                            </tr>
                            <tr>
                                <td class="doc-inf-table-color">納品場所</td>
                                <td>{{$receive->delivery_place}}</td>
                            </tr>
                            <tr>
                                <td class="doc-inf-table-color">支払条件</td>
                                <td>{{$receive->pay_requirement}}</td>
                            </tr>
                        </table>
                    </div>

                    <div class="company-inf">
                        <p>{{$companyinf['name']}}</p>
                        <p>〒{{$companyinf['post']}}</p>
                        <p>{{mb_substr($companyinf['address'],0,13)}}</p>
                        <p>{{mb_substr($companyinf['address'],14,23)}}</p>
                        <p>TEL: {{$companyinf['phone']}}</p>
                        <p>担当者: {{$receive->person->person_name}}</p>
                    </div>
                </div>

                <table class="price-sum">
                    <tr>
                        <td>合計</td>
                        <td>{{number_format($receive->sum_price)}} 円</td>
                    </tr>
                </table>

                <div class="table-all">
                    @if($receive->status == 0)
                        <a href="{{route('receivedetails.create', $receive)}}">製品追加</a>
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
                        @foreach($receivedetails as $receivedetail)
                            <tr>
                                @if($receive->status == 0)
                                    <td><a class="link-none" href="{{route('receivedetails.edit', $receivedetail)}}">{{$receivedetail->product->product_id}}</a></td>
                                @else
                                    <td>{{$receivedetail->product->product_id}}</td>
                                @endif
                                <td>{{$receivedetail->product->product_name}}</td>
                                <td>{{$receivedetail->product_count}}</td>
                                <td>個</td>
                                <td>{{number_format($receivedetail->price)}}</td>
                                <td>{{number_format($receivedetail->sum_price)}}</td>
                            </tr>
                        @endforeach

                        @for($i = 1; $i <= 12 - $receivedetails_count; $i++)
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
                            <td class="text-end">{{number_format($receive->sum_price)}}</td>
                        </tr>
                    </table>

                    <div class="estimate-requirement">
                        <p>＜受注条件＞</p>
                        <p>{{$receive->receive_requirement}}</p>
                    </div>
                    <div class="estimate-note">
                        <p>＜備考＞</p>
                        <p>{{$receive->receive_requirement}}</p>
                    </div>
                </div>
                
            </div>
        </div>

    </main>
@endsection