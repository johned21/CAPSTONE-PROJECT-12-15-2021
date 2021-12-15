@section('mytitle', '| Change Password')
    
@extends('layouts.app')

@section('content')

<div class="wrapper">
	
    @include('component.user-sidebar')

    <div class="dashboard-content">
        <div class="text">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4 offset-md-4 mt-5">
                        {!! Form::open(["route" => "user.changepassword", 'method' => 'post',]) !!}
                        @include('items.change-pass-form')
                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        let btn = document.querySelector("#btn-menu");
        let sidebar = document.querySelector(".sidebar");
        let searchBtn = document.querySelector(".bx-search");

        btn.onclick = function(){
            sidebar.classList.toggle("active");
        }
        searchBtn.onclick = function(){
            sidebar.classList.toggle("active");
        }
        
    </script>

</div>
@endsection