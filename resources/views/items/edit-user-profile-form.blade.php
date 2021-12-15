<div class="card mt-3 mb-2" id="cardss">
    <div class="card-body">
        <div class="row">
            
            <div class="col-md-5">
                <div class="mb-5">
                    <div class="row" id="users-img">
                        <div class="col-md-12">
                            <div class="profile " id="userpp">
                                @if ($user->profile_pic != null)
                                    <img src="{{asset("images/". $user->profile_pic)}}" id="users-profile">
                                @else
                                    <img src="{{asset("img/pp.png")}}" id="users-profile">
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-md-6 offset-md-3 mt-2">
                                    <div class="change-pp">
                                        <label for="fileupload">
                                            <span class="links-name text-white"><i class="fad fa-camera" style="font-size: 0.95em"></i>{{isset($student) ? 'Change' : 'Change'}} Photo</span>
                                        </label>
                                        {{-- <input type="file" id="fileupload"> --}}
                                        {!! Form::file('profile_pic', ['id'=>'fileupload', 'accept' => "image/*"]) !!}
                                        <span class="errspan p-info-err-span" id="errspan">{{ $errors->first('profile_pic') }}</span>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-7 mt-2" id="usersinfo">
                <div class="card" >
                    <div class="row userdetails">
                        <h2><i class="fas fa-user"></i> User Details</h2>
                        <div class="details">
                            <ul>
                                <div class="mb-4">
                                    <div class="row">
                                        <div class="col form-group @error('lastName') has-error @enderror">
                                            {!! Form::label('lastName','Last Name',[],false) !!}
                                            {!! Form::text('lastName', $user->lastName, ['class'=>($errors->has('lastName') ? 'form-control is-invalid' : 'form-control'), 'required' => '']) !!}
                                            <span class="errspan" id="errspan">{{ $errors->first('lastName') }}</span>    
                                        </div>
                                        <div class="col form-group @error('firstName') has-error @enderror">
                                            {!! Form::label('firstName','First Name',[],false) !!}
                                            {!! Form::text('firstName', $user->firstName, ['class'=>($errors->has('firstName') ? 'form-control is-invalid' : 'form-control'), 'required' => '']) !!}
                                            <span class="errspan" id="errspan">{{ $errors->first('firstName') }}</span>    
                                        </div>
                                        <div class="col form-group @error('middleName') has-error @enderror">
                                            {!! Form::label('middleName','Middle Name',[],false) !!}
                                            {!! Form::text('middleName', $user->middleName, ['class'=>($errors->has('middleName') ? 'form-control is-invalid' : 'form-control'), 'required' => '']) !!}
                                            <span class="errspan" id="errspan">{{ $errors->first('middleName') }}</span>    
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 form-group @error('username') has-error @enderror">
                                    {!! Form::label('username','Username',[],false) !!}
                                    {!! Form::text('username', $user->username, ['class'=>($errors->has('username') ? 'form-control is-invalid' : 'form-control'), 'required' => '']) !!}
                                    <span class="errspan" id="errspan">{{ $errors->first('username') }}</span>
                                </div>
                                <div class="mb-3 form-group @error('email') has-error @enderror">
                                    {!! Form::label('email','Email Address',[],false) !!}
                                    {!! Form::text('email', $user->email, ['class'=>($errors->has('email') ? 'form-control is-invalid' : 'form-control'), 'required' => '']) !!}
                                    <span class="errspan" id="errspan">{{ $errors->first('email') }}</span>
                                </div>
                                <div class="mb-3 form-group @error('contactNo') has-error @enderror">
                                    {!! Form::label('contactNo','Contact Number',[],false) !!}
                                    {!! Form::text('contactNo', $user->contactNo, ['class'=>($errors->has('contactNo') ? 'form-control is-invalid' : 'form-control'), 'required' => '']) !!}
                                    <span class="errspan" id="errspan">{{ $errors->first('contactNo') }}</span>
                                </div>

                                <div class="form-group justify-content-between"> 
                                    <div class="col-md-3 float-end mb-2">
                                        <button type="submit" class="btn btn-primary form-control"><i class="fas fa-check"></i> Save</button> 
                                    </div>    
                                    <div class="col-md-3 float-start">
                                        <a href="{{route('user.myprofile')}}" class="btn btn-secondary form-control">Cancel</a>
                                    </div>
                                </div>
                                
                            </ul>
                        </div>

                    </div>
                </div>
                
            </div>

        </div>
    </div>
</div>
