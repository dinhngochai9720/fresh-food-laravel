@php
    $general_setting = \App\Models\GeneralSetting::first();
@endphp

<footer class="main-footer">
    <div class="footer-left">
        {{ $general_setting->copyright }}
    </div>
    <div class="footer-right">
    </div>
</footer>
