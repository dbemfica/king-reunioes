<aside class="main-sidebar">
    <section class="sidebar">
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                  <i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MENU</li>
            <li>
                <a href="{{ route('dashboard') }}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('users.index') }}">
                    <i class="fa fa-users"></i> <span>Usuários</span>
                </a>
            </li>
            <li>
                <a href="{{ route('rooms.index') }}">
                    <i class="fa fa-cubes"></i> <span>Salas</span>
                </a>
            </li>
            <li>
                <a href="{{ route('meetings.index') }}">
                    <i class="fa fa-calendar-check-o"></i> <span>Reuniões</span>
                </a>
            </li>
        </ul>
    </section>
</aside>