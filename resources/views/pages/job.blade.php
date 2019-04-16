@extends('layouts.app')

@section('content')
<div class="container">
    案件詳細
    <table class="table">
        <tr>
            <th>タイトル</th>
            <th>クライアント</th>
        </tr>
        <tr>
            <td>{{$job->title}}</td>
            <td>{{$job->user->name}}</td>
        </tr>
        <tr>
            <th colspan="2">依頼内容</th>
        </tr>
        <tr>
            <td colspan="2">{!!$job->content!!}</td>
        </tr>
    </table>
    <a href="{{ url('/subscribes', $job->id) }}" class="btn btn-primary btn-lg">応募</a>
</div>
@endsection