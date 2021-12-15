@section('mytitle', '| Enrollment Form')
    
@extends('layouts.app')

@section('content')

<div class="wrapper">
	
    @include('component.user-sidebar')

    <div class="dashboard-content">
        <div class="text">
            <div class="container-fluid">
                <div class="row">
                <h1 class="mt-3 enrollment-title">Enrollment Page</h1>
                <p class="enrollment-desc">New Enrollment</p>
                <ul class="crumb1">
                    <li><a href="#">Enrollment</a></li>
                    <li class="bg-secondary"><a href="#">Payment</a></li>
                    <li class="bg-secondary"><a href="#">Review</a></li>
                </ul>
                    <div class="col-md-12">
                        {!! Form::open(["route" => "user.enrollment.post", 'method' => 'post', 'id' => 'enrollment-form',  'enctype'=>"multipart/form-data"]) !!}
                        @include('items.enrollment-form')
                        {!! Form::close() !!}
                        {!! Form::open(["route" => 'user.enrollment.removeimage', 'method' => 'delete', 'id' => 'removeimageform']) !!}
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

        $(".level").change(function() {
            if ($(this).val() == "5" || $(this).val() == "6") {
                $('#SeniorHigh-details').show();
                $('.track').attr('required', '');
                $('.track').attr('data-error', 'This field is required.');
                $('.strand').attr('required', '');
                $('.strand').attr('data-error', 'This field is required.');
            } else {
                $('#SeniorHigh-details').hide();
                $('.track').removeAttr('required');
                $('.track').removeAttr('data-error');
                $('.strand').removeAttr('required');
                $('.strand').removeAttr('data-error');
            }
        });
        $(".level").trigger("change");

        $(document).ready(function() {
            var i = 0;

            $(".btn-success").click(function(){ 
                if(i < 1){
                    var html = $(".clone").html();
                    $(".increment").after(html);
                }
                i++;
                console.log(i);
                hidebtn();
            });
            

            $("body").on("click",".btn-danger",function(){ 
                $(this).parents(".control-group").remove();
                i--;
                console.log(i);
                hidebtn();
            });
            function hidebtn(){
                if (i >= 1) {
                    $('.btn-success').hide();
                } else $('.btn-success').show();
            }
        });
        
    </script>

</div>
@endsection