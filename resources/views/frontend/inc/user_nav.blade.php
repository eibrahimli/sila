<link rel="stylesheet" href="{{ asset('frontend/css/user.css') }}" />

<nav class="profile_nav">
    <ul class="profile_nav_list">
        <li class="profile_nav_list_item">
            <a class="{{ route('user.dashboard', ['user' => auth()->id()]) == url()->current() ? 'active' : null }}" 
                href="{{ route('user.dashboard', ['user' => auth()->id()]) }}">İdarə Paneli</a>
        </li>
        <li class="profile_nav_list_item">
            <a class="{{ route('user.orders', ['user' => auth()->id()]) == url()->current() ? 'active' : null }}" 
                href="{{ route('user.orders', ['user' => auth()->id()]) }}">Sifarişlərim</a></li>
        <li class="profile_nav_list_item">
            <a href="#">Profil ayarları</a>
        </li>
        <li class="profile_nav_list_item">
            <a style="cursor: pointer" role="button" class="u-header-topbar__nav-link" onclick="document.getElementById('formLogOut').submit()">Çıxış</a>

            <form style="display: none" id="formLogOut" action="{{ route('logout') }}" method="POST">
                @csrf
            </form>
        </li>
    </ul>

</nav>
