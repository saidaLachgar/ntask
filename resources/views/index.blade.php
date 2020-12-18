@extends('masterPage.layout')
@section('content')
    <div class="row h-75 mt-4 justify-content-center pt-5">
        <div class="col-2 d-none d-xl-block d-lg-block border-right p-0">
            <div class="row">
                @php
                    $date = new DateTime("now", new DateTimeZone(auth()->user()->timezone) );
                    $hrs = $date->format('H');
                    $greetings = "Hello!";
                    $img="2";
                    if ($hrs >=  0){ $greetings = "Go to bed!";$img="5"; }      // at and After 12zm
                    if ($hrs >  4){ $greetings = "Mornin' Sunshine!";$img="4";} // REALLY early
                    if ($hrs >  6){ $greetings = "Good morning";$img="1";}      // at and After 7am
                    if ($hrs > 12){ $greetings = "Good afternoon";$img="3";}    // at and After 1pm
                    if ($hrs > 17){ $greetings = "Good evening";$img="6";}      // at and After 6pm
                    $Route=Route::currentRouteName();
                @endphp
                <div class="col-3 p-0 align-items-center d-flex"><img src="{{ asset('img/img ('.$img.').png') }}" alt="" class="w-100"></div>
                <div class="col-9"><h5 class="m-0 font-weight-bold text-capitalize">{{$greetings}} {{ strtok(auth()->user()->name, " ") }}.</h5></div>
            </div>
        <div class="row mb-2 mt-4"><a class="@if($Route!="Tasks") text-body @endif" href="{{ Route('Tasks') }}"><span class="h5 m-0"><i class="h6 mb-0 mr-2 ri-inbox-line"></i>Inbox</span></a></div>
            <div class="row mb-2"><a class="@if($Route!="Today") text-body @endif" href="{{ Route('Today') }}"><span class="h5 m-0"><i class="h6 mb-0 mr-2 ri-focus-3-line"></i>Today</span></a></div>
            <div class="row"><a class="@if($Route!="Completed") text-body @endif" href="{{ Route('Completed') }}"><span class="h5 m-0"><i class="h6 mb-0 mr-2 ri-check-double-line"></i>Completed</span></a></div>
            
            
            
        </div>
        <div class="col-11 col-xl-7 col-lg-7 pl-4">
            <div class="row d-flex d-lg-none d-xl-none mb-5">
                <div class="col-12 text-center"><h4 class="m-0 font-weight-bold text-capitalize">{{$greetings}}, {{ strtok(auth()->user()->name, " ") }}.</h4></div>
            </div> 
            <h1 class="text-primary mb-4" id="title">{{$Route}}@if($Route=="Today") <small class="h6 text-muted">{{$date->format("- D, M d")}}</small> @endif</h1>
            
            <div id="filter">
                @if($tasks->count())
                @php($i=0)
                @foreach ($tasks as $task)
                <div id="tsk-{{ $i }}" class="row py-1 tsk">
                    <div class="col-9">
                        <div class="custom-control custom-checkbox">
                        <form action="{{ route("Tasks.finished", $task)}}" method="post" id="completed-{{ $i }}">
                            @csrf
                            <input type="checkbox" @if($task->status==1) checked @endif name="status" onclick="TaskCompleted({{ $i }})" class="custom-control-input" id="customCheck{{ $i }}">
                            <label class="custom-control-label text-break striked" for="customCheck{{ $i }}">{{ $task->description }}</label>
                        </form>
                        </div>
                    </div>
                    <div class="col-3">
                        <button onclick="edit({{ $i }})" class="text-body btn btn-link p-0 float-right"><i class="ri-edit-line"></i></button>
                        <form action="{{route("Tasks.destroy", $task)}}" method="post" class= "mr-2 float-right">@csrf @method('DELETE')<button type="submit" class="btn btn-link p-0 text-body" style="outline:none;"><i class="ri-delete-bin-line"></i></button></form>
                    </div>
                </div>
                <form id="updateTsk-{{ $i }}" autocomplete="off" class="row py-1 d-none updateTsk" action="{{route("Tasks.update",$task)}}" method="post">
                    @csrf
                    <div class="col-9">
                        <div class="form-group mb-0">
                            <textarea name="updatetask" class="form-control form-control-sm" required rows="1">{{ $task->description }}</textarea>
                        </div>
                    </div>
                    <div class="col-3">
                        <button type="submit" class="text-primary btn btn-sm btn-link p-0 ml-1 float-right">Done</button>
                        <button type="button" onclick="cancel()" class="text-body btn btn-sm btn-link p-0 float-right">Cancel</button>
                    </div>
                </form>
                 @php($i+=1)
                @endforeach
                @else
                    <p>The are no @if($Route=="Completed") Completed @endif Tasks  :)</p>
                 @endif
                <form action="{{route("Tasks")}}" autocomplete="off" method="post" class="mb-4">
                    @csrf
                    <div class="input-group mt-2 bg-light border-0 p-0 rounded-lg">
                        <input type="text" name="description" class="form-control bg-light border-0" placeholder='Add a task' aria-label="Username" aria-describedby="basic-addon1">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-light rounded-lg border-0" id="basic-addon1"><button type="submit" class="btn btn-link p-0 text-primary" style="outline:none;">Add</button></span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<script>
    function cancel(){
        if($(".updateTsk:visible").length >= 1){
            $(".updateTsk:visible").addClass("d-none");
            $(".tsk:hidden").removeClass("d-none");
        }
    }
    function edit(e){
        cancel();
        $("#tsk-"+e).addClass("d-none");
        $("#updateTsk-"+e).removeClass("d-none");
    }
    function TaskCompleted(e){
        $("#tsk-"+e).css({ 'visibility': 'hidden', 'opacity': '0', 'transition': 'visibility 1s, opacity 0.5s linear' });
        setTimeout(function() {
            $("#tsk-"+e).addClass("d-none");
            $( "#completed-"+e ).submit();
        }, 500);
    }
</script>
   
@endsection