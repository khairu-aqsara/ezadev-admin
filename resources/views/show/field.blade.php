<div class="form-group ">
    <label class="col-sm-{{$width['label']}} control-label">{{ $label }}</label>
    <div class="col-sm-{{$width['field']}}">
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
    </div>
</div>
