@section('mytitle', '| Dashboard')
    
@extends('layouts.app')

@section('content')

<div class="wrapper">

    @include('component.user-sidebar')

    <div class="dashboard-content">
        <div class="text">
            <div class="container-fluid">
                <div class="row">
                    <h1 class="mt-2 enrollment-title">Enrollment Review Page</h1>
                    <ul class="crumb1">
                        <li class="" ><a href="{{route('user.enrollment')}}">Enrollment</a></li>
                        <li class=""><a href="{{route('user.payment')}}">Payment</a></li>
                        <li class="disabled"><a href="#">Review</a></li>
                    </ul>
                    <div class="col-md-12">
                        {!! Form::open(["route" => "user.review-enrollment.post", 'method' => 'post', 'id' => 'review-form',  'enctype'=>"multipart/form-data"]) !!}
                        @include('items.dashboard-review-enrollment-form')
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .crumb1 li
        {
            display: inline-block;
            padding: 15px;
            background: #3399ff;
            transform: skew(-20deg);
            cursor: pointer;
            opacity: 0.8;
            width: 100px;
        }
        .disabled {
            pointer-events: none;
        }
        .crumb1 li:hover
        {
            opacity: 1;
        }
        .crumb1 li a
        {
            display: block;
            color: #fff;
            transform: skew(20deg);
        }
    </style>
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