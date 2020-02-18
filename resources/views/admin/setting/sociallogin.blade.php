<div class="row">
	<div class="col-md-6">
		<div class="panel panel-primary">
		  	<div class="panel-heading">
		    	<h3 class="panel-title"><i class="fa fa-facebook"></i> Facebook Login Setting</h3>
		  	</div>
		  	<div class="panel-body">
		  		<form action="{{ route('sl.fb') }}" method="POST">
		  			@csrf
		  			
			  		<label for="">Client ID:</label>
			  		<input type="text" placeholder="enter client ID" class="form-control" name="FACEBOOK_CLIENT_ID" value="{{ $env_files['FACEBOOK_CLIENT_ID'] }}">
			  		<br>

			  		<div class="row">
			  			<div class="col-md-11">
			  				<label for="">Client Secret Key:</label>
			  				<input type="password" placeholder="enter secret key" class="form-control" id="fb_secret" name="FACEBOOK_CLIENT_SECRET" value="{{ $env_files['FACEBOOK_CLIENT_SECRET'] }}">
			  			</div>

			  			<div class="col-md-1">
			  				<br>
		                    <span toggle="#fb_secret" class="fa fa-fw fa-eye field-icon toggle-password2 display-inline-flex"></span>
		                </div>
			  		</div>
			  		
					<br>
			  		<label for="">Callback URL:</label>
			  		<input type="text" placeholder="https://yoursite.com/public/login/facebook/callback" name="FACEBOOK_CALLBACK_URL" value="{{ $env_files['FACEBOOK_CALLBACK_URL'] }}" class="form-control">
			  		<br>
					<label for=""><i class="fa fa-facebook-square"></i> Enable Facebook Login: </label>
					&nbsp;&nbsp;
					<input {{ $gsetting->fb_login_enable==1 ? 'checked' : '' }} class="tgl tgl-skewed" name="fb_enable" id="fb_enable" type="checkbox"/>
		    		<label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="fb_enable"></label>
					<br>
				
					
					<button type="submit" class="btn btn-md btn-primary"><i class="fa fa-save"></i> Save Setting</button>
				
		  		</form>
		  	</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="panel panel-warning">
		  	<div class="panel-heading">
		    <h3 class="panel-title"><i class="fa fa-google-plus"></i> Google Login Setting</h3>
		</div>
		<div class="panel-body">
		  	<form action="{{ route('sl.gl') }}" method="POST">
	  			@csrf

		  		<label for="">Client ID:</label>
		  		<input name="GOOGLE_CLIENT_ID" type="text" placeholder="enter client ID" class="form-control" value="{{ $env_files['GOOGLE_CLIENT_ID'] }}">
		  		<br>

		  		<div class="row">
		  			<div class="col-md-11">
		  				<label for="">Client Secret Key:</label>
		  				<input type="password" name="GOOGLE_CLIENT_SECRET" value="{{ $env_files['GOOGLE_CLIENT_SECRET'] }}" placeholder="enter secret key" class="form-control" id="gsecret">
		  			</div>

		  			<div class="col-md-1">
		  				<br>
	                    <span toggle="#gsecret" class="fa fa-fw fa-eye field-icon toggle-password3 display-inline-flex"></span>
	                </div>
		  		</div>
	  		
				<br>
		  		<label for="">Callback URL:</label>
		  		<input type="text" placeholder="https://yoursite.com/login/public/google/callback" name="GOOGLE_CALLBACK_URL" value="{{ $env_files['GOOGLE_CALLBACK_URL'] }}" class="form-control">
		  		<br>
			    <label for=""><i class="fa fa-google-plus-square"></i> Enable Google Login: </label>
				&nbsp;&nbsp;
				<input name="google_enable" {{ $setting->google_login_enable ==1 ? 'checked' : "" }} class="tgl tgl-skewed" id="ggl_enable" type="checkbox"/>
				<label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="ggl_enable"></label>
				<br>
		
				
				<button type="submit" class="btn btn-md btn-primary"><i class="fa fa-save"></i> Save Setting</button>
			
			</form>
		  </div>
		</div>
	</div>

	<div class="col-md-6">
		<div class="panel panel-warning">
		  <div class="panel-heading">
		    <h3 class="panel-title"><i class="fa fa-gitlab"></i> GitLab Login Setting</h3>
		  </div>
		  <div class="panel-body">
		  	<form action="{{ route('sl.git') }}" method="POST">
	  			@csrf

		  		<label for="">GitLab Client ID:</label>
		  		<input name="GITLAB_CLIENT_ID" type="text" placeholder="enter client ID" class="form-control" value="{{ $env_files['GITLAB_CLIENT_ID'] }}" input=>
		  		<br>

		  		<div class="row">
		  			<div class="col-md-11">
		  				<label for="">GitLab Client Secret Key:</label>
		  				<input type="password" name="GITLAB_CLIENT_SECRET" value="{{ $env_files['GITLAB_CLIENT_SECRET'] }}" placeholder="enter secret key" class="form-control" id="tsecret">
		  			</div>

		  			<div class="col-md-1">
		  				<br>
	                    <span toggle="#tsecret" class="fa fa-fw fa-eye field-icon toggle-password4 display-inline-flex"></span>
	                </div>
		  		</div>
	  		
				<br>
		  		<label for="">GitLab Callback URL:</label>
		  		<input type="text" placeholder="https://yoursite.com/login/public/google/callback" name="GITLAB_CALLBACK_URL" value="{{ $env_files['GITLAB_CALLBACK_URL'] }}" class="form-control">
		  		<br>
			    <label for=""><i class="fa fa-google-plus-square"></i> Enable GitLab Login: </label>
				&nbsp;&nbsp;
				<input name="gitlab_enable" {{ $setting->gitlab_login_enable ==1 ? 'checked' : "" }} class="tgl tgl-skewed" id="git_enable" type="checkbox"/>
				<label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="git_enable"></label>
				<br>
		
				
				<button type="submit" class="btn btn-md btn-primary"><i class="fa fa-save"></i> Save Setting</button>
			
			</form>
		  </div>
		</div>
	</div>
</div>

