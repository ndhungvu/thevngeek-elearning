<div class="jsMessage">
    @if(Session::has('flashInfo'))
    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('flashInfo') }}</p>
    @elseif(Session::has('flashSuccess'))
    <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('flashSuccess') }}</p>
    @elseif(Session::has('flashWarning'))
    <p class="alert {{ Session::get('alert-class', 'alert-warning') }}">{{ Session::get('flashWarning') }}</p>
    @elseif(Session::has('flashError'))
    <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('flashError') }}</p>
    @endif
    <p class="alert" style="display: none;"></p>
    <script type="text/javascript">
        var wait;
        $(document).ready(function () {
            clearTimeout(wait);
            wait = setTimeout(function () {
                $('.jsMessage p').hide();
            }, 5000);
        });
    </script>
</div>
