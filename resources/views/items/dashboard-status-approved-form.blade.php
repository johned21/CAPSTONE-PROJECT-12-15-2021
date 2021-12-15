<div class="row">
    <div class="col-md-12">

        <h1 class="mt-2">Dashboard</h1>

        <div class="card mt-3 mb-2">
            <div class="card-header" style="height: auto;">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group justify-content-between"> 
                            <div class="col-md-9 float-start">
                                <div class="row">
                                    <div class="col-md-1">
                                        <img src="{{asset('img/headerlogo.png')}}" alt="" style="width:90px; height:90px; margin-left:-20px;">
                                    </div>
                                    <div class="col-md-11 dashhead" style="margin-top: 10px;">
                                        <h3>SALUS INSTITUTE OF TECHNOLOGY, INC.</h3>
                                        <h5>ONLINE ENROLLMENT SYSTEM</h5>
                                        <h5>S.Y. {{\App\Models\SchoolYear::currentYear()}}</h5>
                                    </div>
                                </div>
                            </div>
                            @isset($enroll->status)
                            <div class="col-md-3 float-end">
                                <h2 class="status">Status: <span style="color: green"> <i class="fas fa-check-circle"></i> {{ $enroll->status }}</span></h2>
                            </div>
                            @endisset
                        </div>
                    </div>
                    
                </div>

            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Name: <span style="color: rgb(61, 133, 61)">{{auth()->user()->student()->first()->firstName}} {{substr(auth()->user()->student()->first()->middleName, 0, 1)}}. {{auth()->user()->student()->first()->lastName}}</span></h5>
                    </div>
                    <div class="col-md-6">
                        <h5>Level: <span style="color: rgb(61, 133, 61)">{{ $enroll->level()->first()->level }}</span></h5>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <h5>Tracks: <span style="color: rgb(61, 133, 61)">{{ $enroll->track ?? 'N/A' }}</span></h5>
                    </div>
                    <div class="col-md-6">
                        <h5>Strand: <span style="color: rgb(61, 133, 61)">{{ $enroll->strand ?? 'N/A' }}</span></h5>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <h5>Section: <span style="color: rgb(61, 133, 61)">{{ $enroll->section()->first()->name }}</span></h5>
                    </div>
                </div>
                <div class="row mt-5">
                    <h2>Subjects:</h2>
                    <table class="table table-success table-striped table-hover"> 
                        <thead>
                            <tr>
                              <th scope="col">Subject</th>
                              <th scope="col">Time</th>
                              <th scope="col">Schedule</th>
                              <th scope="col">Teacher</th>
                            </tr>
                          </thead>
                        <tbody>
                            @foreach ($enroll->classenrolls()->get() as $subject)
                              <tr>
                                <th scope="row">{{$subject->session()->first()->subject()->first()->subjectName}}</th>
                                <td>{{date("h:i A", strtotime($subject->session()->first()->schedTimeStart))}} - {{date("h:i A", strtotime($subject->session()->first()->schedTimeEnd))}}</td>
                                <td>{{$subject->session()->first()->schedDay}}</td>
                                <td>{{$subject->session()->first()->teacher()->first()->firstName}} {{$subject->session()->first()->teacher()->first()->lastName}}</td>
                              </tr>
                            @endforeach
  
                          </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>