<h1 class="text-uppercase mt-2 mb-4" id="dashusers">Statistics <i class="fa fa-users"></i></h1>

<div class="col-md-3">

    <div class="stat-card-admin">
        <a href="{{ route('admin.users') }}">
            <div class="row">
                <div class="col">
                    <div class="status-card">

                        <div class="stat-card__content">
                            <p class="text-uppercase md-1 text-muted">Admin</p>

                            <h1 class="total">{{ $admins }}</h1>
                        </div>
                        <div class="stat-card__icon--info">
                            <div class="stat-card__icon-circle">
                                <i class="fa fa-user"></i>
                            </div>
                        </div>

                    </div>
                </div>        
            </div>
           

            <div class="clicktoview">
                <p>Click to View</p>
            </div>
        </a>
    </div>

</div>

<div class="col-md-3">

    <div class="stat-card-staff">
        <div class="row">
            <div class="col">
                <div class="status-card">

                    <div class="stat-card__content">
                        <p class="text-uppercase md-1 text-muted">Normal Users</p>

                        <h1 class="total">{{$normalusers}}</h1>
                    </div>
                    <div class="stat-card__icon--success">
                        <div class="stat-card__icon-circle">
                            <i class="fa fa-user"></i>
                        </div>
                    </div>

                </div>
            </div>        
        </div>

        <div class="clicktoview">
            <p><a href="{{ route('admin.users') }}">Click to View </a></p>
        </div>
    </div>

</div>

<div class="col-md-3">

    <div class="stat-card-teacher">
        <div class="row">
            <div class="col">
                <div class="status-card">

                    <div class="stat-card__content">
                        <p class="text-uppercase md-1 text-muted">Enrolees</p>

                        <h1 class="total">{{$enroleesCount}}</h1>
                    </div>
                    <div class="stat-card__icon--warning">
                        <div class="stat-card__icon-circle">
                            <i class="fa fa-user"></i>
                        </div>
                    </div>

                </div>
            </div>        
        </div>

        <div class="clicktoview">
            <p><a href="{{ route('admin.enrolees') }}">Click to View </a></p>
        </div>
    </div>

</div>

<div class="col-md-3">
    <div class="stat-card-student">
        <div class="row">
            <div class="col">
                <div class="status-card">

                    <div class="stat-card__content">
                        <p class="text-uppercase md-1 text-muted">Enrolled</p>

                        <h1 class="total">{{$enrolleds}}</h1>
                    </div>
                    <div class="stat-card__icon--danger">
                        <div class="stat-card__icon-circle">
                            <i class="fa fa-user"></i>
                        </div>
                    </div>

                </div>
            </div>        
        </div>
    
        <div class="clicktoview">
            <p><a href="{{ route('admin.enrolled') }}">Click to View </a></p>
        </div>
    </div>
</div>

<div class="col-md-3">
    <div class="stat-card-teachers">
        <div class="row">
            <div class="col">
                <div class="status-card">
                    <div class="stat-card__content">
                        <p class="text-uppercase md-1 text-muted">Teacher</p>

                        <h1 class="total">{{$teachers}}</h1>
                    </div>
                    <div class="stat-card__icon--danger">
                        <div class="stat-card__icon-circle"  style="background-color: #f7a9db;">
                            <i class="fa fa-user"></i>
                        </div>
                    </div>

                </div>
            </div>        
        </div>
       
        <div class="clicktoview">
            <p><a href="{{ route('admin.teachers') }}">Click to View </a></p>
        </div>
    </div>

</div>

<div class="col-md-3">
    <div class="stat-card-teachers sections--">
        <div class="row">
            <div class="col">
                <div class="status-card">
                    <div class="stat-card__content">
                        <p class="text-uppercase md-1 text-muted">Subjects</p>

                        <h1 class="total">{{$subjects}}</h1>
                    </div>
                    <div class="stat-card__icon--danger">
                        <div class="stat-card__icon-circle"  style="background-color: #ffbd91;">
                            <i class="fas fa-book"></i>
                        </div>
                    </div>

                </div>
            </div>        
        </div>
        
        <div class="clicktoview">
            <p><a href="{{ route('admin.subjects') }}">Click to View </a></p>
        </div>
    </div>

</div>

<div class="col-md-3">
    <div class="stat-card-teachers subjects--">
        <div class="row">
            <div class="col">
                <div class="status-card">
                    <div class="stat-card__content">
                        <p class="text-uppercase md-1 text-muted">Sections</p>

                        <h1 class="total">{{$sections}}</h1>
                    </div>
                    <div class="stat-card__icon--danger">
                        <div class="stat-card__icon-circle"  style="background-color: #f38181;">
                            <i class="fa fa-school"></i>
                        </div>
                    </div>

                </div>
            </div>        
        </div>
       
        <div class="clicktoview">
            <p><a href="{{ route('admin.sections') }}">Click to View </a></p>
        </div>
    </div>

</div>

<div class="col-md-3">
    <div class="stat-card-teachers">
        <div class="row">
            <div class="col">
                <div class="status-card">
                    <div class="stat-card__content">
                        <p class="text-uppercase md-1 text-muted">Classes</p>

                        <h1 class="total">{{$classes}}</h1>
                    </div>
                    <div class="stat-card__icon--danger">
                        <div class="stat-card__icon-circle"  style="background-color: #f7a9db;">
                            <i class="fa fa-book-reader"></i>
                        </div>
                    </div>

                </div>
            </div>        
        </div>
       
        <div class="clicktoview">
            <p><a href="{{ route('admin.classes') }}">Click to View </a></p>
        </div>
    </div>

</div>