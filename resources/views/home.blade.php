@if (Auth::user()->role == 0)
    <script type="text/javascript">  window.location = "{{url('index')}}";</script>
@else 
    <script type="text/javascript">  window.location = "{{url('admin')}}";</script>
@endif
