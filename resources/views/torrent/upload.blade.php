@extends('layout.default')

@section('title')
<title>Upload - {{ Config::get('other.title') }}</title>
@stop

@section('stylesheets')
<link rel="stylesheet" href="{{ url('files/wysibb/theme/default/wbbtheme.css') }}">
@stop

@section('breadcrumb')
<li>
    <a href="{{ route('torrents') }}" itemprop="url" class="l-breadcrumb-item-link">
        <span itemprop="title" class="l-breadcrumb-item-link-title">Torrents</span>
    </a>
</li>
<li>
    <a href="{{ url('/upload') }}" itemprop="url" class="l-breadcrumb-item-link">
        <span itemprop="title" class="l-breadcrumb-item-link-title">Upload</span>
    </a>
</li>
@stop

@section('content')
@if($user->can_upload == 0)
<div class="container">
  <div class="jumbotron shadowed">
    <div class="container">
      <h1 class="mt-5 text-center">
        <i class="fa fa-times text-danger"></i> Error: Your Upload Rights Have Been Disabled
      </h1>
    <div class="separator"></div>
  <p class="text-center">If You Feel This Is In Error, Please Contact Staff!</p>
</div>
</div>
</div>
@else
  @if(isset($parsedContent))
  <div class="torrent box container">
    <center><h2>Description Preview</h2></center>
    <div class="preview col-md-12"> @emojione($parsedContent) </div><hr>
  </div>
  @endif
<div class="torrent box container">
  <div class="alert alert-info">
  <h2 class="mt-10"><strong>Announce URL:</strong> {{ route('announce', ['passkey' => $user->passkey]) }}</h2>
  <p>Please use the announce URL above when creating a new torrent and set torrent to private.</p>
  </div>
  <br>
<center><p class="text-success">Having Trouble? See Our Guide <a href="{{ url('p/upload-guide.5') }}">HERE</a></p></center>
<center><p class="text-danger">IMDB and or TVDB is required for all uploads! It is used to grab Posters/Backdrops and ExtraInfo!</p></center>
<center><p class="text-danger"><i>MAKE SURE TO FILL IN ALL FIELDS!</i></p></center>

  <div class="upload col-md-12">
    <h3 class="upload-title">Upload A Torrent</h3>
    {{ Form::open(['route' => 'upload', 'files' => true, 'class' => 'upload-form']) }}
    {{ csrf_field() }}
      <div class="form-group">
        <label for="torrent">Torrent File</label>
        <input class="upload-form-file" type="file" name="torrent">
      </div>

      {{--<div class="form-group">
        <label for="nfo">NFO File (Optional)</label>
        <input class="upload-form-file" type="file" name="nfo">
      </div>--}}

            <div class="form-group">
                <label for="name">Title</label>
                <input type="text" name="name" class="form-control">
            </div>

             <div class="form-group">
                <label for="name">IMDB ID (Required)</label>
                <input type="number" name="imdb" value="0" class="form-control">
            </div>

            <div class="form-group">
               <label for="name">TMDB ID </label>
               <input type="number" name="tmdb" value="0" class="form-control">
           </div>

            <div class="form-group">
                <label for="name">TVDB ID </label>
                <input type="number" name="tvdb" value="0" class="form-control">
            </div>

            <div class="form-group">
                <label for="name">MAL ID </label>
                <input type="number" name="mal" value="0" class="form-control">
            </div>

      <div class="form-group">
        <label for="category_id">Category</label>
        <select name="category_id" class="form-control">
          @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
          @endforeach
        </select>
      </div>

      <div class="form-group">
        <label for="type">Type</label>
        <select name="type" class="form-control">
          @foreach($types as $type)
            <option value="{{ $type->name }}">{{ $type->name }}</option>
          @endforeach
        </select>
      </div>

      <!--<div class="form-group">
        <label for="tags">Tags (separated by a comma!)</label>
        <input type="text" name="tags" class="form-control" placeholder="Some tags to identify your torrent">
      </div>-->

      <div class="form-group">
        <label for="description">Description</label>
        <textarea id="upload-form-description" name="description" cols="30" rows="10" class="form-control"></textarea>
      </div>

      <div class="parser"></div>

      <label for="anonymous" class="control-label">Anonymous Upload?</label>
      <div class="radio-inline">
          <label><input type="radio" name="anonymous" value="1">YES</label>
        </div>
      <div class="radio-inline">
          <label><input type="radio" name="anonymous" checked="checked" value="0">NO</label>
      </div>

        <br>

      <label for="stream" class="control-label">Stream Optimized?</label>
        <div class="radio-inline">
            <label><input type="radio" name="stream" value="1">YES</label>
          </div>
        <div class="radio-inline">
            <label><input type="radio" name="stream" checked="checked" value="0">NO</label>
        </div>

        <br>

        <label for="sd" class="control-label">SD Content?</label>
          <div class="radio-inline">
              <label><input type="radio" name="sd" value="1">YES</label>
            </div>
          <div class="radio-inline">
              <label><input type="radio" name="sd" checked="checked" value="0">NO</label>
          </div>

          <br>

      <center>
        <button type="submit" name="preview" value="true" id="preview" class="btn btn-warning">Preview</button>
        <button id="add" class="btn btn-default" disabled>Add MediaInfo Parser</button>
        <button type="submit" name="post" value="true" id="post" class="btn btn-primary">Upload</button>
      </center>
        <br>
    {{ Form::close() }}
  </div>
</div>
@endif
@stop

@section('javascripts')
<script type="text/javascript" src="{{ url('files/wysibb/jquery.wysibb.js') }}"></script>
<script>
$(document).ready(function() {
    var wbbOpt = { }
    $("#upload-form-description").wysibb(wbbOpt);
});
</script>

<script type="text/javascript">
	$('#add').on('click', function(e){
		e.preventDefault();
		var optionHTML = '<div class="form-group"><label for="mediainfo">MediaInfo Parser</label><textarea rows="2" class="form-control" name="mediainfo" cols="50" id="mediainfo" placeholder="Paste MediaInfo Dump Here"></textarea></div>';
		$('.parser').append(optionHTML);
	});
</script>
@endsection
