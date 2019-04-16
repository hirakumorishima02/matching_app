<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subscribe;
use App\Job;

class SubscribeController extends Controller
{
        public function __construct()
    {
        $this->middleware('auth');
    }
    //応募状況表示
    public function index()
    {
        $query = Subscribe::query();
        $query->where('user_id',auth()->id()); 
        $subscribes = $query->get();
        return view('subscribes.index',compact('subscribes'));
    }
    //応募画面
    public function show($id)
    {
        $job = Job::find($id);
        $query = Subscribe::query();
        $query->where('user_id',auth()->id()); 
        $query->where('job_id',$id); 
        $query->where('status',1);
        $data = $query->first();

        $job_id = $id;
        $user_id = auth()->id();
        if (isset($data)) {
            $message = $data->message;
        } else {
            $message = '';
        }
        return view('subscribes.show',compact('job','message','job_id','user_id'));
    }
    //応募・納品
    public function store(Request $request)
    {
        $job = Job::find($request->job_id);
        $query = Subscribe::query();
        $query->where('user_id',$request->user_id); 
        $query->where('job_id',$request->job_id); 
        $query->where('status',$request->status);
        $data = $query->first();

        if (!isset($data)) {
            $data = new Subscribe();
            $data->user_id = $request->user_id;
            $data->job_id = $request->job_id;
            $data->status = $request->status;
        }
        $data->message = $request->message;
        $job_id = $data->job_id;
        $user_id = $data->user_id;
        $message = $data->message;
        if ($request->status == 1) {
            //応募
            $data->save();
            return view('subscribes.store',compact('job','message','job_id','user_id'));
        } else if ($request->status == 3) {
            //納品
            $query = Subscribe::query();
            $query->where('job_id',$job_id); 
            $query->where('user_id',$user_id); 
            $query->where('status',2);
            $subscribes = $query->first();
            if (isset($subscribes)) {
                //決定する人が特定できた時
                $subscribes->status = 3;
                $subscribes->save();
            }
            return $this->index();
        }
        
    }
}
