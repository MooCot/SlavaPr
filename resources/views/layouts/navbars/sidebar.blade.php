<div class="sidebar">
    <ul class="nav">
        <li>
            <a href="{{ route('home') }}">
                <i class="tim-icons icon-chart-pie-36"></i>
                <p>{{ __('Users') }}</p>
            </a>
        </li>
        <li>
            <a href="{{ route('admins') }}">
                <i class="tim-icons icon-single-02"></i>
                <p>{{ __('Admins') }}</p>
            </a>
        </li>
        <li>
            <a href="{{ route('tasks') }}">
                <i class="tim-icons icon-single-02"></i>
                <p>{{ __('HistoryTask') }}</p>
            </a>
        </li>
    </ul>
</div>