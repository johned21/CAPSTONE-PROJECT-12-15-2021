
<div class="card" id="user-card">
    <div class="card-header" id="user-card-header">
        <a class="btn btn-outline-primary mb-2 float-end" href="{{route('admin.enrolees.view', ['enrolee' => "$enrolee->id"])}}"><i class='bx bx-arrow-back'></i> Back</a>
    </div>
    <div class="card-body" id="user-card-body">
        <div class="card-header" id="enrollment-header">
            <h1>Section</h1>
        </div>
        <div class="info mt-4">
            <div class="row justify-content-center">
                <div class="col">
                    <div class="row">
                        <div class="col-md-12 mt-2">
                            <div class="mb-3 form-group @error('section_id') has-error @enderror">
                                {!! Form::label('section_id','Section',[],false) !!}
                                {{Form::select('section_id', \App\Models\Section::list(), null, ['class'=>'form-control form-select', 'id'=>'modal-input-section'])}}
                                <span class="errspan" id="errspan">{{ $errors->first('section_id') }}</span>
                            </div>
                        </div>
                    </div>  

                </div>
            </div>
        </div>

        <div class="card-header mb-5" id="enrollment-header">
            <h1>Subjects</h1>
        </div>
        <div class="info mt-4">
            <div class="row justify-content-center">
                <div class="col">
                    <div class="row">
                        <div class="col-md-12 offset-md-0 mb-5">
                            <div class="form-inline">
                                <div class="form-group mb-2">
                                    No. of selected: &nbsp;<span id="total"></span>
                                </div>
                            </div>
                            <table id="example" class="table table-striped table-hover table-bordered display nowrap" cellspacing="0" width="100%";>
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width:40px">
                                            <input style="width:1.1em; height:1.1em;" type="checkbox" class="check_uncheck"
                                            data-toggle="tooltipcheck" data-placement="top" title="Check/Uncheck All">
                                        </th>
                                        <th>Name</th>
                                        <th>Time</th>
                                        <th>Schedule</th>
                                        <th>Teacher</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($classes as $class)
                                    <tr class="data-row">
                                        <td class="text-center checkbox-td" style="width:40px">
                                            <input style="width:1.1em; height:1.1em;" class="chkbx" type="checkbox" name="subjects[]" value="{{$class->id}}">
                                        </td>
                                        <td>{{$class->subject->subjectName}}</td>
                                        <td>{{date("h:i A", strtotime($class->schedTime))}}</td>
                                        <td>{{$class->schedDay}}</td>
                                        <td>{{$class->teacher->firstName}} {{$class->teacher->lastName}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>&nbsp;</th>
                                        <th>Name</th>
                                        <th>Time</th>
                                        <th>Schedule</th>
                                        <th>Teacher</th>
                                    </tr>
                                </tfoot>
                               
                            </table>
                            <span class="errspan" id="errspan">@error('subjects') <i class="fas fa-exclamation-circle"></i> @enderror{{ $errors->first('subjects') }}</span>
                            <span class="errspan" id="errspan">@error('subjects.*') <i class="fas fa-exclamation-circle"></i> @enderror{{ $errors->first('subjects.*') }}</span>
                        </div>
                    </div>  
                </div>
            </div>
        </div>

        <hr>

        <div class="form-group justify-content-between"> 
            <div class="col-md-2 float-end mt-1">
                <button class="btn btn-primary form-control" type="submit"><i class="fas fa-check"></i> Finish</button> 
            </div>   
        </div>
    </div>
</div>
