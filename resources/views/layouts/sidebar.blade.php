<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link">
      <span class="brand-text font-weight-light">Sistema Colegio</span>
    </a>
    <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview">
          <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('anio.index') }}" class="nav-link">
              <i class="fas fa-calendar-alt nav-icon"></i>
              <p>Años Lectivos</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('grado.index') }}" class="nav-link">
              <i class="fas fa-layer-group nav-icon"></i>
              <p>Grados</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('curso.index') }}" class="nav-link">
              <i class="fas fa-chalkboard nav-icon"></i>
              <p>Cursos</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('materia.index') }}" class="nav-link">
              <i class="fas fa-book nav-icon"></i>
              <p>Materias</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('periodo.index') }}" class="nav-link">
              <i class="fas fa-clock nav-icon"></i>
              <p>Periodos</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('matricula.index') }}" class="nav-link">
              <i class="fas fa-id-card nav-icon"></i>
              <p>Matrículas</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('asignacion.index') }}" class="nav-link">
              <i class="fas fa-id-card nav-icon"></i>
              <p>Asignaciones</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('nota.seleccionar') }}" class="nav-link">
                <i class="nav-icon fas fa-clipboard-list"></i>
                <p>Registro de Notas</p>
            </a>
        </li>

        </ul>
      </nav>
    </div>
  </aside>
