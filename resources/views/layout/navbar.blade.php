<nav class="navbar navbar-expand fixed-top navbar-light navbar-custom" role="navigation" id="default-navbar">
    <div class="container-fluid">
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto mb-lg-0">
                <li class="nav-item dropdown hidden-xs">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
                        data-real-target="#projects-quick-list-container" data-act="ajax-request"
                        data-action-url="https://rise.fairsketch.com/projects/show_my_starred_projects/"><i
                            data-feather='grid' class='icon'></i></a>
                    <div class="dropdown-menu dropdown-menu-start w400">
                        <div id="projects-quick-list-container">
                            <div class="list-group">
                                <span class="list-group-item inline-loader p20"></span>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
            <div class="d-flex w-auto">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a id="user-dropdown" href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
                            role="button" aria-expanded="false">
                            <span class="avatar-xs avatar me-1">
                            </span>
                            <span class="user-name ml10">Juliaan</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end w100 user-dropdown-menu">
                            <li><a href="https://rise.fairsketch.com/signin/sign_out" class="dropdown-item"><i class="fa-solid fa-power-off me-2"></i> Sign Out</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div><!--/.nav-collapse -->
    </div>
</nav>
