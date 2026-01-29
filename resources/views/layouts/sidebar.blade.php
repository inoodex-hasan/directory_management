<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="#">Welcome, {{ Auth::user()->name }}</a>
        </div>
        {{-- <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div> --}}
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="dropdown {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}" class="nav-link"><i
                        class="fas fa-envelope-open-text"></i><span>Dashboard</span></a>
                @if (auth()->check() && auth()->user()->isAdmin())
                    <a href="{{ route('contact-messages') }}" class="nav-link"><i
                            class="fas fa-paper-plane"></i><span>Contact
                            Messages</span></a>
                @endif
            </li>

            @if (auth()->check() && auth()->user()->isAdmin())
                <li class="menu-header">Home</li>
                <li class="dropdown {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                        <span>Category</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="{{ route('admin.categories.create') }}">Add</a></li>
                        <li><a class="nav-link" href="{{ route('admin.categories.index') }}">Manage</a></li>
                    </ul>
                </li>
                <li class="dropdown {{ request()->routeIs('admin.links.*') ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-globe"></i>
                        <span>Link</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="{{ route('admin.links.pending') }}">Pending</a></li>
                        <li><a class="nav-link" href="{{ route('admin.links.processed') }}">Manage</a></li>
                    </ul>
                </li>
                <li class="dropdown {{ request()->routeIs('admin.blogs.*') ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-newspaper"></i>
                        <span>Blog</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="{{ route('admin.blogs.create') }}">Create</a></li>
                        <li><a class="nav-link" href="{{ route('admin.blogs.index') }}">Manage</a></li>
                    </ul>
                </li>
                {{-- <li class="menu-header">Administration</li>
                <li class="dropdown">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-users"></i>
                        <span>Users</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="{{ route('admin.user-roles.index') }}">Manage Roles</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-shield-alt"></i>
                        <span>Roles</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="{{ route('admin.roles.index') }}">Manage</a></li>
                        <li><a class="nav-link" href="{{ route('admin.roles.create') }}">Add New</a></li>
                    </ul>
                </li> --}}
            @endif
            @if (auth()->check() && !auth()->user()->isAdmin())
                <li class="menu-header">Home</li>
                <li class="dropdown {{ request()->routeIs('links.*') ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                        <span>Submit Url</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="{{ route('links.create') }}">Submit</a></li>
                        <li><a class="nav-link" href="{{ route('links.index') }}">Manage</a></li>
                    </ul>
                </li>
            @endif
            <li class="menu-header">Setting</li>
            <li class="dropdown">
                <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </aside>
</div>