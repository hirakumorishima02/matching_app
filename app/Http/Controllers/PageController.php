<?php

namespace App\Http\Controllers;

use App\Job;
use Illuminate\Http\Request;
class PageController extends Controller
{
    //案件一覧
    public function list()
    {
        $list = Job::all();
        return view('pages.jobList',compact('list'));
    }
    //案件詳細
    public function show($id)
    {
        $job = Job::find($id);
        //改行の置換
        $job->content = str_replace("\r\n", '<br>', $job->content);
        return view('pages.job',compact('job'));
    }
}