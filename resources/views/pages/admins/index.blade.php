@section('mytitle', '| Dashboard')

@extends('layouts.app')

@section('content')

<div class="wrapper">
	
    @include('component.sidebar')
    @include('component.info_msg')
    <div class="dashboard-content">
        <div class="text">
            {{-- <h4>Hi ADMIN: {{ auth()->user()->firstName }}</h4> --}}
            <div class="container-fluid">
                <div class="row ml-3 mr-3">
                    @include('items.overview-users')
                </div>

                <div class="row ml-3 mr-3">
                    @include('items.overview-students')
                </div>
<br><br>
                <div class="row ml-3 mr-3">
                    <h1 class="fw-light" id="dashusers"><i class="fad fa-users"></i> Enrolees</h1>
                    <div class="col-md-12 offset-md-0 mb-5 p-5 card-table">

                        @include('items.enrolees-table')
<br><br><br>
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

        jQuery(document).ready(function($) {
        $('#example').DataTable();
        $(document).on('click', '#example tbody tr button', function() {       
            $("#modaldata tbody tr").html("");
            $("#modaldata tbody tr").html($(this).closest("tr").html());
            $("#exampleModal").modal("show");
        });
        } );        
    </script>

</div>
@endsection