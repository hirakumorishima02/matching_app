use App\Subscribe;
use App\Portfolio;
・・・
    public function index()
    {
        $data = Job::where('user_id', '=', auth()->id())->first();
        if (isset($data)) {
            $title = $data->title;
            $content = $data->content;

            $query = Subscribe::query();
            $query->where('job_id',$data->id); 
            $subscribes = $query->get();
        } else {
            $title = '';
            $content = '';
            $subscribes = null;
        }
        return view('jobs.index',compact('title','content','subscribes'));
    }

    public function store(Request $request)
    {
        $data = Job::where('user_id', '=', auth()->id())->first();
        if (!isset($data)) {
            $data = new Job();
        }
        $data->title = $request->title;
        $data->content = $request->content;
        $data->user_id = auth()->id();
        $data->wish_at = date_format(Carbon::now() , 'Y-m-d');
        if ($request->func == 1) {
            //案件登録
            $data->save();
        } else if ($request->func == 2) {
            //応募者から決定
            $query = Subscribe::query();
            $query->where('job_id',$data->id); 
            $query->where('status','<>',1);
            if ($query->count() == 0) {
                //応募者だけの時は指定の人を決定とする
                $query = Subscribe::query();
                $query->where('job_id',$data->id); 
                $query->where('user_id',$request->user_id); 
                $query->where('status',1);
                $subscribes = $query->first();
                if (isset($subscribes)) {
                    //決定する人が特定できた時
                    $subscribes->status = 2;
                    $subscribes->save();
                }
            } else {
                //納品があるか？
                $query = Subscribe::query();
                $query->where('job_id',$data->id); 
                $query->where('user_id',$request->user_id); 
                $query->where('status',3);
                if ($query->count() == 1) {
                    //納品がある
                    $subscribes = $query->first();
                    if (isset($subscribes)) {
                        //決定する人が特定できた時
                        $subscribes->status = 4;
                        $subscribes->save();
                        //ポートフォリオに入れる
                        $portfolio = new Portfolio();
                        $portfolio->user_id=$request->user_id;
                        $job = Job::find($data->id);
                        $portfolio->title = $job->title;
                        $portfolio->content = '';
                        $portfolio->save();
                    }
                }
            }
        }
        return $this->index();
    }