@extends('layouts.app')

@section('content')
<div class="container">
<div class="row justify-content-center">
<div class="col-md-8">
{{ Form::open(['url' => '/jobs', 'method' => 'post']) }}
    <div class="form-group row">
    {{ Form::label('title', '案件名') }}
    {{ Form::text('title',$title, ['class' => 'form-control']) }}
    </div>
    <div class="form-group row">
    {{ Form::label('content', '詳細') }}
    {{ Form::textarea('content',$content, ['class' => 'form-control']) }}
    </div>
    <div class="form-group row">
    {{ Form::submit('登録', ['class' => 'btn btn-primary']) }}
    {{ Form::hidden('func',1) }}
    </div>
{{ Form::close() }}
</div>
<div class="col-md-8">
{{ Form::open(['url' => '/jobs', 'method' => 'post']) }}
    応募一覧
    <table class="table">
        <tr>
            <th>応募者</th>
            <th>メッセージ</th>
            <th>状況</th>
        </tr>
    @if(isset($subscribes))
    @foreach($subscribes as $subscribe)
        <tr>
            <td>{{Form::radio('user_id', $subscribe->user->id)}} {{ $subscribe->user->name }}</td>
            <td>{{ $subscribe->message }}</td>
            <td>{{ $subscribe->status }}</td>
        </tr>
    @endforeach
    @endif
    </table>
    {{ Form::submit('決定', ['class' => 'btn btn-primary']) }}
    {{ Form::hidden('func',2) }}
{{ Form::close() }}
</div>
</div>
</div>
@endsection