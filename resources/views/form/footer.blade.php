<div class="box-footer">

    {{ csrf_field() }}

    <div class="col-md-{{$width['label']}}">
    </div>

    <div class="col-md-{{$width['field']}}">
        <div class="btn-group pull-left">
          @if(in_array('submit', $buttons))
            <button type="submit" class="btn btn-primary">{{ trans('admin.submit') }}</button>
          @endif
          @if(in_array('reset', $buttons))
          <button type="reset" class="btn btn-warning">{{ trans('admin.reset') }}</button>
          @endif
        </div>
    </div>
</div>
