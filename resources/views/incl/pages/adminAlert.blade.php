@if(session()->has('success'))
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{ session('success') }}
    </div>
@endif

@if(session()->has('failed'))
    <div class="alert alert-error">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{ session('failed') }}
    </div>
@endif

@if(session()->has('error'))
    <div class="alert alert-error">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{ session('error') }}
    </div>
@endif
