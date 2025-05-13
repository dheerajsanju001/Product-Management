<div id="left-menu-toggle-mask">
    <div class="sidebar sidebar-off">
        <a class="sidebar-toggle-btn hide" href="#">
            <i data-feather="x" class="icon mt0"></i>
        </a>
        <div id="left-menu-language-dropdown" class="d-block d-sm-none dropdown float-end">
        </div>
            
        <a class="sidebar-brand brand-logo" href="https://rise.fairsketch.com/dashboard"><img class="dashboard-image"
                src="https://rise.fairsketch.com/files/system/default-stie-logo.png" /></a>
        <a class="sidebar-brand brand-logo-mini" href="https://rise.fairsketch.com/dashboard"><img
                class="dashboard-image" src="https://rise.fairsketch.com/assets/images/favicon.png" /></a>

        <div class="sidebar-scroll">
            <ul id="sidebar-menu" class="sidebar-menu">
                <li class="main {{ request()->routeIs('category.*') ? 'active' : '' }}">
                    <a href="{{ route('category.index') }}">
                        <i data-feather="monitor" class="icon"></i>
                        <span class="menu-text">Category</span>
                    </a>
                </li>

                <li class="main {{ request()->routeIs('add.subcategory') ? 'active' : '' }}">
                    <a href="{{ route('add.subcategory') }}">
                        <i data-feather="calendar" class="icon"></i>
                        <span class="menu-text">Sub-Category</span>
                    </a>
                </li>

                <li class="main {{ request()->routeIs('add.size') ? 'active' : '' }}">
                    <a href="{{ route('add.size') }}">
                        <i data-feather="briefcase" class="icon"></i>
                        <span class="menu-text">Size</span>
                    </a>
                </li>

                <li class="main {{ request()->routeIs('add.product') ? 'active' : '' }}">
                    <a href="{{ route('add.product') }}">
                        <i data-feather="command" class="icon"></i>
                        <span class="menu-text">Product</span>
                    </a>
                </li>
                <li class="main {{ request()->routeIs('remaining.stock') ? 'active' : '' }}">
                    <a href="{{ route('remaining.stock') }}">
                        <i data-feather="command" class="icon"></i>
                        <span class="menu-text">Remaining Stock</span>
                    </a>
                </li>
            </ul>
        </div>

    </div>
</div>