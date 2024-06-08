<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="index.html">
                <i class="bi bi-grid"></i>
                <span>Home</span>
            </a>
        </li>

        @can('manager')
            <li class="nav-item">
                <a class="nav-link " href="{{ route('performanceEvaluations.managerlist') }}">
                    <i class="bi bi-x-diamond-fill"></i>
                    <span>Avaliação de Desenpenho</span>
                </a>
            </li>
        @endcan

		<li class="nav-item">
            <a class="nav-link " href="index.html">
                <i class=" ri-command-fill"></i>
                <span>Feedback 360</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Acompanhamentos</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="components-alerts.html">
                        <i class="bi bi-circle"></i><span>Metodologia SCI</span>
                    </a>
                </li>
                <li>
                    <a href="components-accordion.html">
                        <i class="bi bi-circle"></i><span>Plano de Desenvolvimento</span>
                    </a>
                </li>
            </ul>
        </li>

        @can('admin')

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#performanceEvaluations-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-x-diamond-fill"></i><span>Avaliação de Desenpenho</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="performanceEvaluations-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('performanceEvaluations.store') }}">
                        <i class="bi bi-circle"></i><span>Cadastros</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('performanceEvaluations.listagem') }}">
                        <i class="bi bi-circle"></i><span>Registros</span>
                    </a>
                </li>
            </ul>
        </li>


        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Cadastros</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('user.listagem') }}">
                        <i class="bi bi-circle"></i><span>Usuários</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('departament.listagem') }}">
                        <i class="bi bi-circle"></i><span>Setores</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('office.listagem') }}">
                        <i class="bi bi-circle"></i><span>Cargos</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('skill.listagem') }}">
                        <i class="bi bi-circle"></i><span>Skills</span>
                    </a>
                </li>
            </ul>
        </li>
        @endcan


        <li class="nav-heading">Pages</li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="users-profile.html">
                <i class="bi bi-person"></i>
                <span>Perfil</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="pages-faq.html">
                <i class="bi bi-question-circle"></i>
                <span>F.A.Q</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="pages-contact.html">
                <i class="bi bi-envelope"></i>
                <span>Contato</span>
            </a>
        </li>

    </ul>

</aside>
