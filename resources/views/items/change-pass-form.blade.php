
<div class="card mb-5 mt-2" id="cardss">
    <div class="card-header" style="height:65px;">
        <h3><i class="fas fa-key"></i> Change Password</h3>
    </div>
    <div class="card-body">
        <div class="mb-3 form-group @error('old_password') has-error @enderror">
            {!! Form::label('old_password','Current Password',[],false) !!}
            {!! Form::password('old_password', ['class'=>($errors->has('old_password') ? 'form-control is-invalid' : 'form-control')]) !!}
            <span class="errspan" id="errspan">{{ $errors->first('old_password') }}</span>
        </div>
        <div class="mb-3 form-group @error('new_password') has-error @enderror">
            {!! Form::label('new_password','New Password',[],false) !!}
            {!! Form::password('new_password', ['class'=>($errors->has('new_password') ? 'form-control is-invalid' : 'form-control')]) !!}
            <span class="errspan" id="errspan">{{ $errors->first('new_password') }}</span>
        </div>

        <div class="mb-3 form-group @error('password_confirmation') has-error @enderror">
            {!! Form::label('password_confirmation','Confirm New Password',[],false) !!}
            {!! Form::password('password_confirmation', ['class'=>($errors->has('password_confirmation') ? 'form-control is-invalid' : 'form-control')]) !!}
            <span class="errspan" id="errspan">{{ $errors->first('password_confirmation') }}</span>
        </div>

        <div class="form-group">
            <button class="btn btn-primary form-control" type="submit"><i class="fas fa-check"></i> Save</button> 
        </div>
        <div class="form-group">
            <a href="{{route('user.myprofile')}}" class="btn btn-secondary form-control" type="submit"> Cancel</a> 
        </div>
    </div>
</div>


