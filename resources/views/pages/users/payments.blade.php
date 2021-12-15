@section('mytitle', '| Payments Form')
    
@extends('layouts.app')

@section('content')

<div class="wrapper">
	
    @include('component.user-sidebar')

    <div class="dashboard-content">
        <div class="text">
            <div class="container-fluid">
                <div class="row">
                <h1 class="mt-3 enrollment-title">Payments Page</h1>
                <ul class="crumb1">
                    <li class="" ><a href="{{route('user.enrollment')}}">Enrollment</a></li>
                    <li class="disabled"><a href="#">Payment</a></li>
                    <li class="bg-secondary disabled"><a href="#">Review</a></li>
                </ul>
                    <div class="col-md-12">
                        {!! Form::open(["route" => "user.payment.post", 'method' => 'post', 'id' => 'payment-form',  'enctype'=>"multipart/form-data"]) !!}
                        @include('items.payments-form')
                        {!! Form::close() !!}
                        {!! Form::open(["route" => 'user.payment.removeimage', 'method' => 'delete', 'id' => 'removepaymentimageform']) !!}
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


        //payments upload 
        $('input[type="file"][name="file_img"]').val('');

        $('input[type="file"][name="file_img"]').on('change', function(){
            var img_path = $(this)[0].value;
            var img_holder = $('.img-holder');
            var extension = img_path.substring(img_path.lastIndexOf('.')+1).toLowerCase();

            if(extension == 'jpeg' || extension == 'jpg' || extension == 'png'){
                if(typeof(FileReader) != 'undefined'){
                    img_holder.empty();
                    var reader = new FileReader();
                    reader.onload = function(e){
                        $('<img/>', {'src':e.target.result,'class':'img-fluid','style':'max-width:150px;margin-bottom:10px;'}).
                        appendTo(img_holder);
                    }
                    img_holder.show();
                    reader.readAsDataURL($(this)[0].files[0]);
                }else{
                    $(img_holder).html('This browser does not support FileReader');
                }
            }else{
                $(img_holder).empty();
            }
        })
    </script>

</div>
@endsection