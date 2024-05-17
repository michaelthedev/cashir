<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 bg-slate-900 fixed-start " id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand d-flex align-items-center m-0" href=" https://demos.creative-tim.com/corporate-ui-dashboard/pages/dashboard.html " target="_blank">
            <span class="font-weight-bold text-lg">{{config('dashboard.navTitle')}}</span>
        </a>
    </div>
    <div class="collapse navbar-collapse px-4  w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            @foreach(config('dashboard.navs') as $nav)
                <li class="nav-item">
                    <a class="nav-link {{isCurrentRoute($nav['route']) ? 'active' : ''}}" href="{{ route($nav['route']) }}">
                        <div class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                            <x-svg icon="{{ $nav['icon'] }}"/>
                        </div>
                        <span class="nav-link-text ms-1">{{ $nav['name'] }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</aside>
