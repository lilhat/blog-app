<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-light bg-white shadow-sm" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                @if(Request::is('admin*'))
                <div class="sb-sidenav-menu-heading">Home</div>
                <a class="nav-link  {{ Request::is('admin/dashboard') ? 'active':'' }}" href="{{ url('admin/dashboard') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <div class="sb-sidenav-menu-heading">Sections</div>

                <a class="nav-link {{ Request::is('admin/category') || Request::is('admin/add-category') || Request::is('admin/edit-category/*') ? 'collapse active':'collapsed' }}" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Category
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse {{ Request::is('admin/category') || Request::is('admin/add-category') || Request::is('admin/edit-category/*') ? 'show':'' }}" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link  {{ Request::is('admin/add-category') ? 'active':'' }}" href="{{ url('admin/add-category') }}">Add Category</a>
                        <a class="nav-link {{ Request::is('admin/category') || Request::is('admin/edit-category/*') ? 'active':'' }}" href="{{ url('admin/category') }}">View Category</a>
                    </nav>
                </div>

                <a class="nav-link {{ Request::is('admin/posts') || Request::is('admin/add-post') || Request::is('admin/edit-post/*') ? 'collapse active':'collapsed' }}" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePost" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Post
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse {{ Request::is('admin/posts') || Request::is('admin/add-post') || Request::is('admin/edit-post/*') ? 'show':'' }}" id="collapsePost" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link {{ Request::is('admin/add-post') ? 'active':'' }}" href="{{ url('admin/add-post') }}">Add Post</a>
                        <a class="nav-link {{ Request::is('admin/posts') || Request::is('admin/edit-post/*') ? 'active':'' }}" href="{{ url('admin/posts') }}">View Posts</a>
                    </nav>
                </div>

                <a class="nav-link {{ Request::is('admin/users') ? 'active':'' }}" href="{{ url('admin/users') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Users
                </a>
                @endif
                @if(Request::is('author*'))
                <div class="sb-sidenav-menu-heading">Home</div>
                <a class="nav-link  {{ Request::is('author/dashboard') ? 'active':'' }}" href="{{ url('author/dashboard') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <div class="sb-sidenav-menu-heading">Sections</div>

                <a class="nav-link {{ Request::is('author/category') ? 'collapse active':'collapsed' }}" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Category
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse {{ Request::is('author/category') ? 'show':'' }}" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link {{ Request::is('author/category') ? 'active':'' }}" href="{{ url('author/category') }}">View Category</a>
                    </nav>
                </div>

                <a class="nav-link {{ Request::is('author/posts') || Request::is('author/add-post') || Request::is('author/edit-post/*') ? 'collapse active':'collapsed' }}" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePost" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Post
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse {{ Request::is('author/posts') || Request::is('author/add-post') || Request::is('author/edit-post/*') ? 'show':'' }}" id="collapsePost" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link {{ Request::is('author/add-post') ? 'active':'' }}" href="{{ url('author/add-post') }}">Add Post</a>
                        <a class="nav-link {{ Request::is('author/posts') || Request::is('author/edit-post/*') ? 'active':'' }}" href="{{ url('author/posts') }}">View Posts</a>
                    </nav>
                </div>
                @endif
                <div class="sb-sidenav-menu-heading">Website</div>
                <a class="nav-link" href="{{ url('/') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Go To Website
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            {{ Auth::user()->name }}
        </div>
    </nav>
</div>
