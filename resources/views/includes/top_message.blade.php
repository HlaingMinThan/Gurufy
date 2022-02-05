<style type="text/css">
    .top-message{
        display: block;
    }
</style>

@if (session('message'))
<div class="top-message text-center alert bg-primary text-white alert-dismissible alert-message fade show" role="alert" id="top-message">
    <i class="fas fa-info"></i> 
    {{ session('message') }}
    <i class="fas fa-times float-end cursor-pointer" data-bs-dismiss="alert"></i>
</div>
@endif
@if (session('secondary_message'))
<div class="top-message text-center alert bg-secondary text-white alert-dismissible alert-message fade show" role="alert" id="top-message">
    <i class="fas fa-info"></i> 
    {{ session('secondary_message') }}
    <i class="fas fa-times float-end cursor-pointer" data-bs-dismiss="alert"></i>
</div>
@endif
@if (session('success_message'))
<div class="top-message text-center alert bg-success text-white alert-dismissible alert-message fade show" role="alert" id="top-message">
    <i class="far fa-check-square"></i> 
    {{ session('success_message') }}
    <i class="fas fa-times float-end cursor-pointer" data-bs-dismiss="alert"></i>
</div>
@endif
@if (session('error_message'))
<div class="top-message text-center alert bg-danger text-white alert-dismissible alert-message fade show" role="alert" id="top-message">
    <i class="fas fa-exclamation-triangle"></i> 
    {{ session('error_message') }}
    <i class="fas fa-times float-end cursor-pointer" data-bs-dismiss="alert"></i>
</div>
@endif
@if (session('warning_message'))
<div class="top-message text-center alert bg-warning text-white alert-dismissible alert-message fade show" role="alert" id="top-message">
    <i class="fas fa-exclamation-triangle"></i> 
    {{ session('warning_message') }}
    <i class="fas fa-times float-end cursor-pointer" data-bs-dismiss="alert"></i>
</div>
@endif
@if (session('info_message'))
<div class="top-message text-center alert bg-info text-white alert-dismissible alert-message fade show" role="alert" id="top-message">
    <i class="fas fa-info"></i> 
    {{ session('info_message') }}
    <i class="fas fa-times float-end cursor-pointer" data-bs-dismiss="alert"></i>
</div>
@endif
@if (session('light_message'))
<div class="top-message text-center alert bg-light text-white alert-dismissible alert-message fade show" role="alert" id="top-message">
    <i class="fas fa-info"></i> 
    {{ session('light_message') }}
    <i class="fas fa-times float-end cursor-pointer" data-bs-dismiss="alert"></i>
</div>
@endif
@if (session('dark_message'))
<div class="top-message text-center alert bg-dark text-white alert-dismissible alert-message fade show" role="alert" id="top-message">
    <i class="fas fa-info"></i> 
    {{ session('dark_message') }}
    <i class="fas fa-times float-end cursor-pointer" data-bs-dismiss="alert"></i>
</div>
@endif



<script type="text/javascript">
	setTimeout(function(){
		// document.getElementById("top-message").remove();
	}, 5000);
</script>