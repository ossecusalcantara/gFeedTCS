<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="{{ route('user.dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Home</span>
            </a>
        </li>

        @can('manager')
            <li class="nav-item">
                <a class="nav-link " href="{{ route('performanceEvaluations.managerlist') }}">
                    <i class="bi bi-x-diamond-fill"></i>
                    <span>Avaliação de Desempenho</span>
                </a>
            </li>
        @endcan

        
        <li class="nav-item">
            @can('manager')
                <a class="nav-link " href="{{ route('performanceEvaluations.managerlist') }}">
            @endcan
            @can('admin')
                <a class="nav-link " href="{{ route('performanceEvaluations.managerlist') }}">
            @endcan
            @can('user')
                <a class="nav-link " href="{{ route('performanceEvaluations.userlist') }}">
            @endcan
                <i class="bi bi-x-diamond-fill"></i>
                <span>Avaliação de Desempenho</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#feedback-nav" data-bs-toggle="collapse" href="#">
                <i class=" ri-command-fill"></i><span>Feedback 360</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="feedback-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('feedback.index') }}">
                        <i class="bi bi-circle"></i><span>Cadastro</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('feedback.listagem') }}">
                        <i class="bi bi-circle"></i><span>Recebidos</span>
                    </a>
                </li>
            </ul>
        </li>
        
        @can('admin')
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>Gestão de Feedbacks</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('feedback.adminList') }}">
                            <i class="bi bi-circle"></i><span>Feedbacks</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#performanceEvaluations-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-x-diamond-fill"></i><span>Gestão de Avalições</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="performanceEvaluations-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('performanceEvaluations.store') }}">
                            <i class="bi bi-circle"></i><span>Cadastro</span>
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
                    <li>
                        <a href="{{ route('questions.listagem') }}">
                            <i class="bi bi-circle"></i><span>Perguntas</span>
                        </a>
                    </li>
                </ul>
            </li>
        @endcan

        <li class="nav-heading">...</li>

    </ul>

</aside>
