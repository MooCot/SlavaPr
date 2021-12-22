<div class="sidebar">
    <ul class="nav">
        <li>
            <a class="sidebar-link" href="{{ route('home') }}">
                <i class="sidebar-icon sidebar-icon-user tim-icons icon-chart-pie-36"></i>
                <p class="sidebar-text">{{ __('Пользователи') }}</p>
            </a>
        </li>
        <li>
            <a class="sidebar-link" href="{{ route('admins') }}">
                <i class="sidebar-icon sidebar-icon-admin tim-icons icon-single-02"></i>
                <p class="sidebar-text">{{ __('Администраторы') }}</p>
            </a>
        </li>
        <li>
            <a class="sidebar-link" href="{{ route('tasks') }}">
                <i class="sidebar-icon sidebar-icon-task tim-icons icon-single-02"></i>
                <p class="sidebar-text">{{ __('История задач') }}</p>
            </a>
        </li>
    </ul>
</div>