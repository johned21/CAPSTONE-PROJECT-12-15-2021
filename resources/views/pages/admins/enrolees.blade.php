@section('mytitle', '| Enrolees')
    
@extends('layouts.app')

@section('content')

<div class="wrapper">
	
    @include('component.sidebar')
    @include('component.info_msg')
    <div class="dashboard-content">
        <div class="text">  
            <div class="container-fluid">
                <div class="row p-3">
                    <h1 class="fw-light" id="dashusers"><i class="fad fa-users"></i> Enrolees</h1>
                    <div class="col-md-12 offset-md-0 mb-5 p-5 card-table">
                        @include('items.enrolees-table')
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
            initComplete: function () {
            this.api().columns(5).every( function () {
                var column = this;
                var select = $('<select class="form-control form-select"><option value="" selected>All</option></select>')
                    .appendTo( '#selectTriggerFilter' )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
            
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