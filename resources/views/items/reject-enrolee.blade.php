<!-- Modal -->
<div class="modal fade" id="rejectEnroleeModal" tabindex="-1" role="dialog" aria-labelledby="rejectEnroleeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm text-center" role="document">
        <div class="modal-content">
            <div class="float-right pt-2 pr-3">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        
        {!! Form::open(["route" => "admin.enrolee.reject", 'method' => 'post', 'class' => 'mb-2']) !!}

            {!! Form::hidden('enrolee_id', $enrolee->id, ['class'=>'form-control']) !!}

            <p class=""><i style="font-size: 5em;" class="fal fa-times-circle text-danger"></i></p>
            <h5 style="margin-top:-2%; color: rgb(46, 46, 46)">Reject Enrolee</h5>
            <p class="container">
                Are you sure you want to reject this enrolee?
                {{$enrolee->student()->first()->firstName}} {{substr($enrolee->student()->first()->middleName, 0, 1)}}. {{$enrolee->student()->first()->lastName}}
            </p>
            <div class="d-inline mt-1">
                <button type="submit" class="btn btn-danger px-4 mr-2">YES</button>
                <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-info px-4 ml-2 text-white">NO</button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
<script>
    $(document).ready(function() {
        $(document).on('click', "#reject-enrolee", function() {
            $(this).addClass('delete-user-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.

            var options = {
            'backdrop': 'static'
            };
            $('#rejectEnroleeModal').modal(options)
        })
    })
</script>
<style>
.modal-header {
    border-bottom: 0 none;
}

.modal-footer {
    border-top: 0 none;
}
</style>