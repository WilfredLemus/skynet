@if (Session::has('success'))
<script type="text/javascript">
    $(document).ready(function(){
        alertify.success("{{ Session::get('success') }}");
    });
</script>
@endif
@if (Session::has('notify'))
<script type="text/javascript">
    $(document).ready(function(){
        alertify.notify("{{ Session::get('notify') }}");
    });
</script>
@endif
@if (Session::has('warning'))
<script type="text/javascript">
    $(document).ready(function(){
        alertify.warning("{{ Session::get('warning') }}");
    });
</script>
@endif
@if (Session::has('error'))
<script type="text/javascript">
    $(document).ready(function(){
        alertify.error("{{ Session::get('error') }}");
    });
</script>
@endif
@if (Session::has('pathPDF'))
<script type="text/javascript">
    var getUrl = window.location;
    var baseUrl = getUrl.protocol + "//" + getUrl.host;
    var win = window.open(baseUrl+"/{{ Session::get('pathPDF') }}", '_blank');
    win.focus();
</script>
{{Session::forget('pathPDF')}}
@endif
