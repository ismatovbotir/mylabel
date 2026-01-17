<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use App\Models\TaskStatus;
use Illuminate\Support\Facades\Http;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       // $data=Task::where('status','!=','done')->with(['authorName','user'])->orderBy('created_at','desc')->paginate(20);
        //dd($data);
        $id=auth()->user()->id;
        $data = Task::where('status', '!=', 'done')
    ->where(function ($q) use ($id) {
        $q->where('user_id', $id)
          ->orWhere('author', $id);
    })
    ->with(['authorName', 'user'])
    ->orderBy('created_at', 'desc')
    ->paginate(20);
        return view('task.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data=User::all();
        //dd($data);
        return view('task.create',['data'=>$data]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {
        $body=$request->validated();
        //dd($body);
        $author=auth()->user();
        //dd($author);
        $task=Task::create([
            'user_id'=>$body['user'],
            'author'=>$author->id,
            'title'=>$body['title'],
            'task'=>$body['task'],
            'type'=>$body['type'],
            'expires_at'=>$body['expires']
        ]);
        TaskStatus::create([
            'user_id'=>$author->id,
            'task_id'=>$task->id
        ]);
        $this->sendTelegram('Yangi Task');
        return to_route('admin.task.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user=auth()->user()->id;
        $task=Task::find($id);
        if($task->status=='new' && $task->user_id==$user){
            $task->update(['status'=>'processing']);
            TaskStatus::create([
                'user_id'=>$user,
                'task_id'=>$task->id,
                'status'=>'processing'
            ]);
        }
       
        return view('task.show',['data'=>$task]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function sendTelegram($text='test',$id='-312950852'){
        $response = Http::withBody(json_encode(
            [
                //"business_connection_id"=>$message->business_connection_id,
                "chat_id" => $id,
                "text" => $text,
                "parse_mode" => "HTML"
            ]
        ))
        ->post("https://api.telegram.org/bot525501231:AAHteYYF_PI174fPeyZZmuB6I1xVLIJg_oQ/sendMessage");

    }

}
