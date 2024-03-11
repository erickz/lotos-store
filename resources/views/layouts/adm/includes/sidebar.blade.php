@section('sidebar')
    <div class="col-md-2" id="nav-col">
        <section id="col-left">
            <div class="collapse navbar-collapse navbar-ex1-collapse" id="sidebar-nav">
                <ul class="nav nav-pills nav-stacked">
                    <li class="{{ request()->is('admin/dashboard*') ? 'active' : '' }}">
                        <a href="{{ route('adm.dashboard.index') }}">
                            <i class="fa fa-tachometer-alt"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    @permission('read-concursos')
                    <li class="{{ request()->is('admin/concursos*') ? 'active' : '' }}">
                        <a href="#" class="dropdown-toggle">
                            <i class="far fa-star"></i>
                            <span>Concursos</span>
                            <i class="fa fa-chevron-circle-down drop-icon"></i>
                        </a>
                        <ul class="submenu">
                            <li>
                                <a href="{{ route('adm.concursos.index') }}">
                                    Lista de Concursos
                                </a>
                            </li>

                            @permission('create-concursos')
                            <li>
                                <a href="{{ route('adm.concursos.create') }}">
                                    Criar concurso
                                </a>
                            </li>
                            @endpermission

                            <li>
                                <a href="{{ route('adm.concursos.todo') }}">
                                    Concursos à fazer
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endpermission

                    @permission('read-boloes')
                    <li class="{{ request()->is('admin/boloes*') ? 'active' : '' }}">
                        <a href="#" class="dropdown-toggle">
                            <i class="fas fa-newspaper"></i>
                            <span>Bolões</span>
                            <i class="fa fa-chevron-circle-down drop-icon"></i>
                        </a>
                        <ul class="submenu">
                            <li>
                                <a href="{{ route('adm.boloes.index') }}">
                                    Lista de Bolões
                                </a>
                            </li>

                            @permission('create-boloes')
                            <li>
                                <a href="{{ route('adm.boloes.create') }}">
                                    Criar bolão
                                </a>
                            </li>
                            @endpermission
                        </ul>
                    </li>
                    @endpermission

                    @permission('read-loteries')
                    <li class="{{ request()->is('admin/loteries*') ? 'active' : '' }}">
                        <a href="#" class="dropdown-toggle">
                            <i class="fas fa-dollar-sign"></i>
                            <span>Loterias</span>
                            <i class="fa fa-chevron-circle-down drop-icon"></i>
                        </a>
                        <ul class="submenu">
                            <li>
                                <a href="{{ route('adm.loteries.index') }}">
                                    Lista de loterias
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endpermission

                    @permission('read-users')
                    <li class="{{ request()->is('admin/users*') ? 'active' : '' }}">
                        <a href="#" class="dropdown-toggle">
                            <i class="fa fa-users"></i>
                            <span>Users</span>
                            <i class="fa fa-chevron-circle-down drop-icon"></i>
                        </a>
                        <ul class="submenu">
                            <li>
                                <a href="{{ route('adm.users.index') }}">
                                    User list
                                </a>
                            </li>

                            @permission('create-users')
                            <li>
                                <a href="{{ route('adm.users.create') }}">
                                    Create user
                                </a>
                            </li>
                            @endpermission
                        </ul>
                    </li>
                    @endpermission

                    @permission('read-customers')
                    <li class="{{ request()->is('admin/customers*') ? 'active' : '' }}">
                        <a href="#" class="dropdown-toggle">
                            <i class="fa fa-user-alt"></i>
                            <span>Customers</span>
                            <i class="fa fa-chevron-circle-down drop-icon"></i>
                        </a>
                        <ul class="submenu">
                            <li>
                                <a href="{{ route('adm.customers.index') }}">
                                    Customers list
                                </a>
                            </li>
                            @permission('create-users')
                                <li>
                                    <a href="{{ route('adm.customers.create') }}">
                                        Create customer
                                    </a>
                                </li>
                            @endpermission
                            @permission('create-users')
                                <li>
                                    <a href="{{ route('adm.customers.rescue') }}">
                                        Solicitações de saque
                                    </a>
                                </li>
                            @endpermission
                        </ul>
                    </li>
                    @endpermission

                    <li class="{{ request()->is('admin/blog*') ? 'active' : '' }}">
                        <a href="#" class="dropdown-toggle">
                            <i class="fa fa-blog"></i>
                            <span>Blog</span>
                            <i class="fa fa-chevron-circle-down drop-icon"></i>
                        </a>
                        <ul class="submenu">
                            <li>
                                <a href="{{ route('adm.blogs.index') }}">
                                    Blogs list
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('adm.blogs.create') }}">
                                    Create Post
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </section>
    </div>
@show