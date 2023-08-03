<!-- Main Footer -->
<footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
        @if(config('admin.show_environment'))
            <strong>Env</strong>&nbsp;&nbsp; {!! config('app.env') !!}
        @endif

        &nbsp;&nbsp;&nbsp;&nbsp;

        @if(config('admin.show_version'))
        <strong>Version</strong>&nbsp;&nbsp; {!! \Ezadev\Admin\Admin::VERSION !!}
        @endif

    </div>
    <!-- Default to the left -->
    @if(!empty(config('admin.footer')))
        <strong>{{ config('admin.footer') }}</strong> <a href="{{ config('admin.footer_link') }}">{{ config('admin.footer_author') }}</a>
    @endif
</footer>