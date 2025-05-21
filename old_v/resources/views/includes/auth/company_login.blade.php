<div class="form-group">
<label for="company_id">Company ID</label>
<input type="text" class="form-control form-control-lg"  id="company_id" name="company_id" placeholder="enter your company id" required>
</div>
<div class="form-group">

<label for="company_id">Domain</label>
<input type="text" class="form-control form-control-lg"  id="domain" name="domain" placeholder="enter your domain" required>
</div>

<div class="form-group">

<label for="email">Username</label>
<input type="text" class="form-control form-control-lg"  id="email" name="user_name" placeholder="enter your username" required>
</div>

<div class="form-group">

<label for="password">Password</label>
<div class="password-input">
    <input type="password" class="form-control form-control-lg"  name="password" id="password" placeholder="************" required>

</div>
</div>
@php
    $host = request()->getHost();
@endphp
<script>
    const companyInput = document.getElementById('company_id');
    const domainInput = document.getElementById('domain');

    companyInput.addEventListener('input', function() {
        domainInput.value = companyInput.value ? companyInput.value +'.'+ '{{ $host}}' : '';
    });
</script>
<div class="form-group text-center mt-2">
    <div class="col-xs-12 p-b-20">
        <button type="submit" class="btn btn-block btn-lg btn-info">{{ __('general.submit') }}</button>
    </div>
</div>
