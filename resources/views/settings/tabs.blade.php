<ul class="nav nav-pills  navtab-bg nav-justified mb-4">
    
    <li class="nav-item mx-0">
        <a href="{{ route ('account-settings.index') }}" aria-expanded="false" class="nav-link {{ Request::path() == 'dashboard/account-settings' ? 'active' : '' }}">
            Account settings
        </a>
    </li>

    <li class="nav-item mx-0">
        <a href="{{ route ('company-settings.index') }}" aria-expanded="false" class="nav-link {{ Request::path() == 'dashboard/company-settings' ? 'active' : '' }} ">
            Company settings
        </a>
    </li>

    <li class="nav-item mx-0">
        <a href="{{ route ('attendence-settings.index') }}" aria-expanded="false" class="nav-link {{ Request::path() == 'dashboard/attendence-settings' ? 'active' : '' }}">
            Attendence settings
        </a>
    </li>

</ul>