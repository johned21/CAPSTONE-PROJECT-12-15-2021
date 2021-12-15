<div class="row">
    <div class="col-md-12 mb-2">
        <h1 class="mt-4" style="color: green;">Dashboard</h1>
        <div class="card mt-3">
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
                                        <h5>S.Y. {{ \App\Models\SchoolYear::CurrentYear() }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>   
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <h5>Name: <span style="color: rgb(61, 133, 61)">{{auth()->user()->firstName}} {{substr(auth()->user()->middleName, 0, 1)}}. {{auth()->user()->lastName}}</span></h5>
                    </div>
                    <div class="col-md-4">
                        <h5>Level: <span style="color: rgb(61, 133, 61)"></span></h5>
                    </div>
                    <div class="col-md-4">
                        <h5>Student Type: <span style="color: rgb(61, 133, 61)"></span></h5>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-4">
                        <h5>Tracks: <span style="color: rgb(61, 133, 61)"></span></h5>
                    </div>
                    <div class="col-md-4">
                        <h5>Strand: <span style="color: rgb(61, 133, 61)"></span></h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center mt-4">
            <div class="col">
                <div>
                    
                    <div>
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>

                    @if (auth()->user()->email_verified_at == null)
                    <div class="alert alert-warning d-flex align-items-center" role="alert" id="alertbtn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                        </svg>
                        <div>
                            Your email is not verified yet.
                        </div>    
                    </div>
                    @endif

                    @if (auth()->user()->student()->exists())
                       
                            
                    @else
                    <div>
                        <div class="alert alert-warning d-flex align-items-center" role="alert" id="alertbtn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                            </svg>
                            <div>
                                You still didn't have fill up your personal information
                            </div>    
                        </div>

                        <a href="{{ route('user.personalinfo') }}" class="btn btn-primary">Click here to Fill up.</a>

                    </div>    
                    @endif
                                                    
                </div>
            </div>
        </div>

        
    </div>
</div>