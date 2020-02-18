<form action="{{ route('update.mail.set') }}" method="POST">
	{{ csrf_field() }}
	<div class="row">
		<div class="col-md-6">
			
			<label for="">Sender Name:</label>
			<input value="{{ $env_files['MAIL_FROM_NAME'] }}" type="text" name="MAIL_FROM_NAME" placeholder="Enter sender name" class="{{ $errors->has('MAIL_FROM_NAME') ? ' is-invalid' : '' }} form-control">
			@if ($errors->has('email'))
                <span class="text-danger invalid-feedback" role="alert">
                    <strong>{{ $errors->first('MAIL_FROM_NAME') }}</strong>
                </span>
            @endif
            <br>

            <label for=""> MAIL DRIVER: (ex. SMTP,MAIL)</label>
			<input value="{{ $env_files['MAIL_DRIVER'] }}" type="text" name="MAIL_DRIVER" placeholder="Enter mail driver" class="{{ $errors->has('MAIL_DRIVER') ? ' is-invalid' : '' }} form-control">
			@if ($errors->has('MAIL_DRIVER'))
                <span class="text-danger invalid-feedback" role="alert">
                    <strong>{{ $errors->first('MAIL_DRIVER') }}</strong>
                </span>
            @endif
            <br>
            <label for=""> MAIL HOST: (ex. smtp.mailtrap.io)</label> 
			<input value="{{ $env_files['MAIL_HOST'] }}" type="text" name="MAIL_HOST" placeholder="Enter mail host" class="{{ $errors->has('MAIL_HOST') ? ' is-invalid' : '' }} form-control">
			@if ($errors->has('MAIL_HOST'))
                <span class="text-danger invalid-feedback" role="alert">
                    <strong>{{ $errors->first('MAIL_HOST') }}</strong>
                </span>
            @endif

            <br>
            <label for=""> MAIL PORT: (ex. 2525,467)</label>
			<input value="{{ $env_files['MAIL_PORT'] }}" type="text" name="MAIL_PORT" placeholder="Enter mail port" class="{{ $errors->has('MAIL_PORT') ? ' is-invalid' : '' }} form-control">
			@if ($errors->has('MAIL_PORT'))
                <span class="text-danger invalid-feedback" role="alert">
                    <strong>{{ $errors->first('MAIL_PORT') }}</strong>
                </span>
            @endif

        </div>
        <div class="col-md-6">

            <label for=""> MAIL ADDRESS:</label>
            <input value="{{ $env_files['MAIL_FROM_ADDRESS'] }}" type="text" name="MAIL_FROM_ADDRESS" placeholder="Enter mail username" class="{{ $errors->has('MAIL_FROM_ADDRESS') ? ' is-invalid' : '' }} form-control">
            @if ($errors->has('MAIL_USERNAME'))
                <span class="text-danger invalid-feedback" role="alert">
                    <strong>{{ $errors->first('MAIL_FROM_ADDRESS') }}</strong>
                </span>
            @endif

            <br>

            <label for=""> MAIL USERNAME: (ex. info@test.com)</label>
			<input value="{{ $env_files['MAIL_USERNAME'] }}" type="text" name="MAIL_USERNAME" placeholder="Enter mail username" class="{{ $errors->has('MAIL_USERNAME') ? ' is-invalid' : '' }} form-control">
			@if ($errors->has('MAIL_USERNAME'))
                <span class="text-danger invalid-feedback" role="alert">
                    <strong>{{ $errors->first('MAIL_USERNAME') }}</strong>
                </span>
            @endif

            <br>


            <div class="row">
            <div class="col-md-11">
                <label for=""> MAIL PASSWORD: </label>
                <input id="mailpass" value="{{ $env_files['MAIL_PASSWORD'] }}" type="password" name="MAIL_PASSWORD" placeholder="Enter mail password" class="{{ $errors->has('MAIL_PASSWORD') ? ' is-invalid' : '' }} form-control"> 
                </div>

                <div class="col-md-1">
                    <label class="display-none" for="">eye</label>
                    <br>
                    <span toggle="#password-field" class="fa fa-fw fa-eye field_icon toggle-password"></span>
                </div>
            </div>
           
            
			@if($errors->has('MAIL_PASSWORD'))
                <span class="text-danger invalid-feedback form-control" role="alert">
                    <strong>{{ $errors->first('MAIL_PASSWORD') }}</strong>
                </span>
            @endif
                   

            <br>
            
            <label for=""> MAIL ENCRYPTION: (ex. TLS/SSL)</label>
			<input value="{{ $env_files['MAIL_ENCRYPTION'] }}" type="text" name="MAIL_ENCRYPTION" placeholder="Enter mail encryption" class="{{ $errors->has('MAIL_ENCRYPTION') ? ' is-invalid' : '' }} form-control">
			@if ($errors->has('MAIL_ENCRYPTION'))
                <span class="text-danger invalid-feedback" role="alert">
                    <strong>{{ $errors->first('MAIL_ENCRYPTION') }}</strong>
                </span>
            @endif
			<br>
            
		</div>
	</div>
	<br>
	<button type="submit" class="btn btn-md btn-primary"><i class="fa fa-save"></i> Save Setting</button>
</form>


