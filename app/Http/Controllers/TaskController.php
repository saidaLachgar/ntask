<?php

namespace App\Http\Controllers;

use DateTime;
use DateTimeZone;
use App\Models\task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct(){
        $this->middleware("auth");
    }
    
    public function index(){
        $tasks= task::where('user_id', auth()->user()->id)->where("status", 0)->get();
        return view("index", [
            "tasks" => $tasks
        ]);
    }
    
    public function store(request $request){
        $this->validate($request, [
            'description' => 'required'
        ]);
        $date = new DateTime("now", new DateTimeZone(auth()->user()->timezone) );
        $request->user()->tasks()->create([
            "description"=>$request->description,
            "createdOn"=>$date
        ]);
        return back();
    }
    public function destroy(task $task){
        // $this->authorize('delete', $task);
        $task->delete();
        return back();
    }
    public function update(task $task,request $request){
        $task->update(['description' => $request->updatetask]);
        return back();
    }
    public function finished(task $task,request $request){
        $bool=$request->status == "on" ? 1 : 0;
        $task->update(['status' => $bool]);
        return back();
    }

    public function Today(){
        $date = new DateTime("now", new DateTimeZone(auth()->user()->timezone) );
        $tasks= task::where('user_id', auth()->user()->id)->where("status", 0)->whereDate("createdOn",'=', $date->format('Y-m-d'))->get();
        return view("index", [
            "tasks" => $tasks
        ]);
    }
    public function Completed(){
        $date = new DateTime("now", new DateTimeZone(auth()->user()->timezone) );
        $tasks= task::where('user_id', auth()->user()->id)->where("status", 1)->get();
        return view("index", [
            "tasks" => $tasks
        ]);
    }

    // public function search(Request $request) {
    //     $rslt = task::select("id")->where('description', 'Like', "%".$request->text."%")->where('user_id', auth()->user()->id)->get();
    //     return response()->json($rslt);
    // }
}
