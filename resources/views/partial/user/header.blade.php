<header>
    <div class="header-menu-logo">
        <div class="header-item-logo">
            <p class="header-item-text">Favvert App</p>
        </div>
    </div>
    <div class="header-menu-group">
        <div class="header-item">
            <a class="header-item-text" href="{{route('admin.dashboard')}}">
                Admin
            </a>
        </div>
        <div class="header-item">
            <p class="header-item-text">Storage</p>
        </div>
        <div class="header-item">
            <a class="header-item-text" href="{{ route('user.services.yandex') }}">
                Services
            </a>
        </div>
    </div>
    <div class="header-menu-profile">
        <button onclick="showHeaderMenuProfile()" class="header-item-profile">{{ isset($user) ? $user->name : 'Unknown' }}</button>
        <div id="header-item-dropdown" class="header-item-dropdown-content">
            <a class="header-item-text" href="">Settings</a>
            <a class="header-item-text" href="{{ route('auth.logout') }}">Logout</a>
        </div>
    </div>
</header>
