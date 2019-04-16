@extends('layouts.app')

@section('content')
<div class="container">
    応募
    <table class="table">
        <tr>
            <th>タイトル</th>
            <th>クライアント</th>
        </tr>
        <tr>
            <td>{{$job->title}}</td>
            <td>{{$job->user->name}}</td>
        </tr>
    </table>
<div class="row justify-content-center">
<div class="col-md-8" style="height: 100px;">
応募完了しました。依頼者から決定されるまでお待ちください。<a href="{{ url('/subscribes') }}" class="btn btn-primary">応募状況</a>
</div>
<div class="col-md-8">
    応募メッセージ
</div>
<div class="col-md-8">
    {{$message}}
</div>
</div>
</div>
@endsection