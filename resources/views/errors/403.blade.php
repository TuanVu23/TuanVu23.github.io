@extends('layouts.main')
@section('content')
<div class="w3_content_agilleinfo_inner">
  <div class="agile_featured_movies">
    <div class="inner-agile-w3l-part-head">
      <h3 class="w3l-inner-h-title">403 Forbidden Error</h3>
      <p style="color: #fe423f;" class="w3ls_head_para">{{ $exception->getMessage() }}</p>
    </div>
  </div>
</div>
@endsection