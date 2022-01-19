<!-- jQuery  -->
<script src="{{asset('manager/js/jquery.min.js')}}"></script>
<script src="{{asset('manager/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('manager/js/metisMenu.min.js')}}"></script>
<script src="{{asset('manager/js/waves.min.js')}}"></script>
<script src="{{asset('manager/js/jquery.slimscroll.min.js')}}"></script>
<script src="{{ asset('manager/js/jquery.core.js') }}"></script>

<!-- App js -->
<script src="{{asset('manager/js/app.js')}}"></script>
<script>
        @if(Session::has('message'))
                var type="{{Session::get('alert-type','info')}}"
                
                
                switch(type){
                case 'info':
                toastr.info("{{ Session::get('message') }}");
                break;
                case 'success':
                toastr.success("{{ Session::get('message') }}");
                break;
                case 'warning':
                toastr.warning("{{ Session::get('message') }}");
                break;
                case 'error':
                toastr.error("{{ Session::get('message') }}");
                break;
                }
                @endif
</script>