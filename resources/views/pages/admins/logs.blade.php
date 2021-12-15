@section('mytitle', '| Logs Table')
    
@extends('layouts.app')

@section('content')

<div class="wrapper">
	
    @include('component.sidebar')

    <div class="dashboard-content">
        <div class="text">
            <div class="container-fluid">
                <h1 class="fw-light" id="dashusers"><i class="fad fa-file-alt"></i> User Log</h1>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-12 offset-md-0 mb-5 p-5 card-table">
                            <table id="example" class="table table-striped table-hover table-bordered display nowrap" cellspacing="0" width="100%";>
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>User</th>
                                        <th>Activity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($logs as $log)
                                        <tr>
                                            <td>{{$log->created_at}}</td>
                                            <td>{{$log->user()->first()->username}}</td>
                                            <td>{{$log->log_entry}}</td>
                                           
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Date</th>
                                        <th>User</th>
                                        <th>Activity</th>
                                        
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
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

        jQuery(document).ready(function($) {
        $('#example').DataTable({
            responsive: true,
            "order": [],
        });
        $(document).on('click', '#example tbody tr button', function() {       
            $("#modaldata tbody tr").html("");
            $("#modaldata tbody tr").html($(this).closest("tr").html());
            $("#exampleModal").modal("show");
        });
        } );    
    </script>

</div>
@endsection