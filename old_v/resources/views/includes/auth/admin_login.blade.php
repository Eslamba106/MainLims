<div class="form-group">

<label for="email">{{ __('login.user_name') }}</label>
<input class="form-control form-control-lg  mt-2" type="text" id="email" name="user_name" placeholder="enter your username"
    required>
</div>
<div class="form-group">

<label for="password">{{ __('login.password') }}</label>
<div class="password-input  mt-2">
    <input class="form-control form-control-lg" type="password" name="password" id="password" placeholder="************"
        required>

</div>
</div>

<div class="form-group text-center  mt-2">
    <div class="col-xs-12 p-b-20">
        <button type="submit" class="btn btn-block btn-lg btn-info">{{ __('general.submit') }}</button>
    </div>
</div>
