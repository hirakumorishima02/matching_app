@extends('layouts.app')

@section('content')
<div class="container">
    案件一覧
    <table class="table">
        <tr>
            <th>タイトル</th>
            <th>クライアント</th>
        </tr>
        
    @foreach($list as $job)
        <tr>
            <td><a href="/job/{{ $job->id }}">{{ $job->title }}</a></td>
            <td>{{ $job->user->name }}</td>
        </tr>
    @endforeach
    </table>
</div>
@endsection