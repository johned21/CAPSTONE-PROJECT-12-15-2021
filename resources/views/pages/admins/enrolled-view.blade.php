@section('mytitle', '| Dashboard')
    
@extends('layouts.app')

@section('content')

<div class="wrapper">
	<img src="{{asset('img/dashboard-bg.png')}}" alt="" class="bg">

    @include('component.sidebar')
    @include('component.info_msg')
    <div class="dashboard-content">
        <div class="text">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{route('admin.enrolled')}}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back</a>
                                <div class="card mt-1 mb-2">
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
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h5>Name: <span style="color: rgb(61, 133, 61)">{{$enrolledStudent->student()->first()->firstName}} {{$enrolledStudent->student()->first()->middleName}} {{$enrolledStudent->student()->first()->lastName}}</span></h5>
                                            </div>
                                            <div class="col-md-6">
                                                <h5>Level: <span style="color: rgb(61, 133, 61)">{{ $enrolledStudent->level()->first()->level }}</span></h5>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-6">
                                                <h5>Tracks: <span style="color: rgb(61, 133, 61)">{{ $enrolledStudent->track ?? 'N/A' }}</span></h5>
                                            </div>
                                            <div class="col-md-6">
                                                <h5>Strand: <span style="color: rgb(61, 133, 61)">{{ $enrolledStudent->strand ?? 'N/A' }}</span></h5>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-6">
                                                <h5>Section: <span style="color: rgb(61, 133, 61)">{{ $enrolledStudent->section()->first()->name }}</span></h5>
                                            </div>
                                            <div class="col-md-6">
                                                <h5>Date Enrolled: <span style="color: rgb(61, 133, 61)">{{date("F j, Y, g:i a", strtotime($enrolledStudent->created_at))}}</span></h5>
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
                                                    @foreach ($enrolledStudent->classenrolls()->get() as $subject)
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
                            @if (isset($enrolledStudent->requirement_images))
                            <div class="col-md-12">
                                <div class="card mt-1 mb-2">
                                    <div class="card-body">
                                        <h3>Submitted Requirements:</h3>
                                        <div class="row mt-2">
                                            <div class="col form-group mt-2 gallery">
                                            @foreach(json_decode($enrolledStudent->requirement_images) as $requiredFileImg)
                                           
                                                <a href="{{url("files/$requiredFileImg")}}">
                                                    <img alt="" class="p-1 requirementImages" src='{{url("files/$requiredFileImg")}}' style="width: 300px;"/>
                                                </a>
                                            
                                            @endforeach
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            @endif
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
        
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery-js/1.4.0/js/lightgallery.min.js"></script>
    <script>
        lightGallery(document.querySelector('.gallery'));
    </script>

</div>
@endsection