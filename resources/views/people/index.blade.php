@extends('layouts.app')

@section('content')
    <main>
        <button type="button" class="btn btn-outline-primary"><a href="{{route('people.create')}}" class="new-reg">新規登録</a></button>
        

        <!-- 検索ソート機能 -->

        <h2 class="section-ttl mt-3">製品一覧</h2>
        <div>
            <table class="person-table">
                <tr>
                    <th>社員番号</th>
                    <th>担当者名</th>
                    <th class="table-btn-s"></th>
                    <th class="table-btn-s"></th>
                </tr>
                @foreach($people as $person)
                    <tr>
                        <td class="person-id">{{$person->person_number}}</td>
                        <td class="person-name">{{$person->person_name}}</td>
                        <td class="table-btn-s"><a href="{{route('people.edit', $person)}}" class="person-edit">編集</a></td>
                        <td class="table-btn-s">
                            <form action="{{route('people.destroy', $person)}}" method="post">
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