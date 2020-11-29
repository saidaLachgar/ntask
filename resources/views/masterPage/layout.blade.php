<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>nTask</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!-- icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">    
    <style>
        html, body{
            height:100%;
        }
        .bg-cyan{
            background-color: #f3f8ff;
        }
        .search:focus{
            color: #495057;
            background-color: #f3f8ff;
            border: none;
            outline: 0;
            box-shadow: none;
        }
        .form-control:focus{
            box-shadow: none;
        }
        .search::placeholder{
            color:#a1a6ac;
        }
        .btn-primary.focus, .btn-primary:focus {
            box-shadow: none !important;
        }
        a:hover, .btn:hover,  .btn-link:focus{
            text-decoration: none !important;
            outline: 0 !important;
            box-shadow: none !important;
            opacity: .8;
        }
       input:checked~.striked {
            text-decoration: line-through;          
        }
    </style>
</head>
<body>
<nav class="row bg-white shadow-sm justify-content-center fixed-top py-2">
    <div class="col-6 col-lg-2 col-xl-2 pl-0 d-flex align-items-center">
        <h4 class="text-primary font-weight-bold m-0">nTask<i class="ri-quill-pen-fill"></i></h4>
    </div>
    @auth
        <div class="col-6 d-none d-xl-block d-lg-block pl-0">
            <div class="input-group my-2 bg-cyan border-0 p-0 rounded-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-cyan border-0 pr-0" id="basic-addon1"><i class="ri-search-2-line text-primary"></i></span>
                </div>
                <input type="text" class="form-control bg-cyan border-0 search" placeholder='Search...' id="SearchinTasks" aria-describedby="basic-addon1">
            </div>
        </div>
        <div class="col-1 d-none d-xl-flex d-lg-flex pl-0 align-items-center" style="justify-content: right;">
        <form action="{{ route('logout')}}" method="post">
            @csrf
            <button class="btn btn-link text-muted font-weight-bold m-0 px-0" type="submit">Logout</button>
        </form>
        </div>
    @endauth
    @guest
        <div class="col-7 d-none d-xl-flex d-lg-flex pl-0 align-items-center" style="justify-content: right;">
        <span class="font-weight-bold m-0"><a href="{{ Route('login') }}" class=" text-muted">LOGIN</a>&nbsp;&nbsp;·&nbsp;&nbsp;<a href="{{ Route('Register') }}" class=" text-muted">SIGNUP</a></span>
        </div>
        <div class="col-4 d-flex d-lg-none d-xl-none p-0"></div>
    @endguest
    @auth
        <div class="col-4 d-flex d-lg-none d-xl-none p-0 align-items-center justify-content-end">
            <span class="font-weight-bold my-2"><a class=" text-muted" id="toggle"><i class="ri-menu-3-line"></i></a></span>
        </div>
        <div class="card card-body border-0" style="display: none;" id="menu">
            <div class="row justify-content-center">
                <div class="col-10">
                    <div class="row mb-3">
                        <div class="input-group my-2 bg-cyan border-0 p-0 rounded-lg">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-cyan border-0 pr-0" id="basic-addon1"><i class="ri-search-2-line text-primary"></i></span>
                            </div>
                            <input type="text" class="form-control bg-cyan border-0 search" placeholder='Search...' id="SearchinTasksMobile" aria-describedby="basic-addon1">
                            <button class="btn btn-sm btn-light bg-cyan text-primary" id="searchbtn">search</button>
                        </div>
                    </div>
                    @php
                        $Route=Route::currentRouteName();
                    @endphp
                    <a class="row mb-3 @if($Route!="Tasks") text-body @endif" href="{{ Route('Tasks') }}"><i class="h5 mb-0 mr-2 ri-inbox-line"></i><h6 class="m-0"> Inbox</h6></a>
                    <a class="row mb-3 @if($Route!="Today") text-body @endif" href="{{ Route('Today') }}"><i class="h5 mb-0 mr-2 ri-focus-3-line"></i> <h6 class="m-0">Today</h6></a>
                    <a class="row mb-3 @if($Route!="Completed") text-body @endif" href="{{ Route('Completed') }}"><i class="h5 mb-0 mr-2 ri-check-double-line"></i> <h6 class="m-0">Completed</h6></a>
                    <div class="row">
                        <form action="{{ route('logout')}}" method="post" class=" m-0 w-100 text-right">
                            @csrf
                            <button class="btn btn-link text-muted font-weight-bold" type="submit">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endauth
</nav>
<div class="container-fluid h-100 pt-5">
    @yield('content')    
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
<script>
  
$(document).ready(function() {
    $('#toggle, #searchbtn').click(function() {
        $('#menu').slideToggle();
        $(".ri-menu-3-line, .ri-close-line").toggleClass("ri-menu-3-line ri-close-line");
    });
    
  $("#SearchinTasks, #SearchinTasksMobile").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    if(value==""){
        $("#title").html("Inbox");
    }else{
        $("#title").html("<small>Searching for “ "+value+" ”</small>");
    }
    $("#filter *").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
    if($('#filter *:visible').length===0){
        if(!$('#noresult').length){
            $('#filter').after('<small id="noresult"><b>No matching results</b> - Try different search terms</small>');
            console.log("hahowa tzad");
        }
    }else{
        if($('#noresult').length){
            $("#noresult").remove();
            console.log("tmsa7");
        }
    }
  });
    
});

</script>

</body>
</html>
{{-- 

// $('#SearchinTasks').on('keyup', function(){
    //     var csrf=$('meta[name="csrf-token"]').attr('content'),
    //     text= $('#SearchinTasks').val();
    //     $.ajax({
    //         type:"POST",
    //         headers: {'X-CSRF-TOKEN': csrf},
    //         url: '{{ route("Tasks.search") }}',
    //         dataType: "json",
    //         data: {text: text},
    //         success: function(response) {
    //             console.log(response);
    //          }
    
    //     });
    
    
    // }); --}}