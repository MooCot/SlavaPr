<div class="sidebar">
    <ul class="nav">
        <li>
            <a class="sidebar-link" href="{{ route('home') }}">
                <i class="sidebar-icon tim-icons icon-chart-pie-36 {{!empty($active) && $active=='user' ? 'checked sidebar-icon-user-fill' : 'sidebar-icon-user' }}"></i>
                <p class="sidebar-text {{!empty($active) && $active=='user' ? 'checked' : '' }}">{{ __('Пользователи') }}</p>
            </a>
        </li>
        <li>
            <a class="sidebar-link" href="{{ route('admins') }}">
                <i class="sidebar-icon tim-icons icon-single-02 {{!empty($active) && $active=='admin' ? 'checked sidebar-icon-admin-fill' : 'sidebar-icon-admin' }}"></i>
                <p class="sidebar-text {{ !empty($active) && $active=='admin' ? 'checked' : '' }}">{{ __('Администраторы') }}</p>
            </a>
        </li>
        <li>
            <a class="sidebar-link" href="{{ route('tasks') }}">
                <i class="sidebar-icon tim-icons icon-single-02 {{!empty($active) && $active=='task' ? 'checked sidebar-icon-task-fill' : 'sidebar-icon-task' }}"></i>
                <p class="sidebar-text {{!empty($active) && $active=='task' ? 'checked' : '' }}">{{ __('История задач') }}</p>
            </a>
        </li>
    </ul>
</div>