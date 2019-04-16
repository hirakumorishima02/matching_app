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
応募しますか？<br>応募のメッセージで自分をアピールしてください。
</div>
<div class="col-md-8">
{{ Form::open(['url' => '/subscribes', 'method' => 'post']) }}
    <div class="form-group row">
    {{ Form::label('message', '応募メッセージ') }}
    {{ Form::textarea('message',$message, ['class' => 'form-control']) }}
    {{ Form::hidden('job_id',$job_id) }}
    {{ Form::hidden('user_id',$user_id) }}
    {{ Form::hidden('status',1) }}
    </div>
    <div class="form-group row">
    {{ Form::submit('応募', ['class' => 'btn btn-primary']) }}
    </div>
{{ Form::close() }}
</div>
</div>
</div>
@endsection