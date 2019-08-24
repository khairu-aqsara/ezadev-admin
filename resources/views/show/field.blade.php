<<<<<<< HEAD
<div class="form-group ">
    <label class="col-sm-{{$width['label']}} control-label">{{ $label }}</label>
    <div class="col-sm-{{$width['field']}}">
=======
<style>
.frow {
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  flex-wrap: wrap;
}
.frow > [class*='col-'] {
  display: flex;
  flex-direction: column;
}
</style>

<div class="frow form-group">
    <div class="col-sm-{{$width['label']}}"><b>{{ $label }}</b></div>
    <div style="width:30px">:</div>
    <div class="col-sm-{{$width['field']}}">
        <span>
>>>>>>> origin/local-dev
        @if($wrapped)
            @if($escape)
                {{ $content }}&nbsp;
            @else
                {!! $content !!}&nbsp;
            @endif
        @else
            @if($escape)
                {{ $content }}
            @else
                {!! $content !!}
            @endif
        @endif
<<<<<<< HEAD
=======
        </span>
>>>>>>> origin/local-dev
    </div>
</div>
