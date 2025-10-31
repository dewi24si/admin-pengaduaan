<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h2 class="h4 mb-0">
            @yield('page_title', ucfirst(str_replace('-', ' ', request()->segment(1) ?? 'Dashboard')))
        </h2>
        @hasSection('page_subtitle')
            <div class="text-muted small">@yield('page_subtitle')</div>
        @endif
    </div>
    <div>
        @hasSection('page_actions')
            @yield('page_actions')
        @endif
    </div>
</div>
