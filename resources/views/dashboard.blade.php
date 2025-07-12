@extends('layouts.admin')

@section('title', 'Dashboard - Sistema de Gestión Escolar')

@section('content')
<div class="container-fluid">
    <!-- Header del Dashboard -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="dashboard-header">
                <div class="welcome-section">
                    <h1 class="welcome-title">¡Bienvenido, {{ Auth::user()->name }}!</h1>
                    <p class="welcome-subtitle">Panel de control del Sistema de Gestión Escolar</p>
                    <div class="user-info">
                        <span class="user-role">{{ Auth::user()->getRoleNames()->first() ?? 'Usuario' }}</span>
                        <span class="current-date">{{ now()->format('l, d \d\e F Y') }}</span>
                    </div>
                </div>
                <div class="quick-actions">
                    <a href="{{ route('nota.seleccionar') }}" class="btn btn-primary">
                        <i class="fas fa-clipboard-list"></i> Registrar Notas
                    </a>
                    <a href="{{ route('matricula.index') }}" class="btn btn-success">
                        <i class="fas fa-id-card"></i> Nueva Matrícula
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Cards de Estadísticas -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card">
                <div class="stat-card-body">
                    <div class="stat-card-icon bg-primary">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-card-content">
                        <h3 class="stat-card-number">{{ \App\Models\User::where('tipo', 'estudiante')->count() }}</h3>
                        <p class="stat-card-label">Estudiantes</p>
                        <div class="stat-card-trend positive">
                            <i class="fas fa-arrow-up"></i> +12% este mes
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card">
                <div class="stat-card-body">
                    <div class="stat-card-icon bg-success">
                        <i class="fas fa-chalkboard"></i>
                    </div>
                    <div class="stat-card-content">
                        <h3 class="stat-card-number">{{ \App\Models\Curso::count() }}</h3>
                        <p class="stat-card-label">Cursos Activos</p>
                        <div class="stat-card-trend positive">
                            <i class="fas fa-arrow-up"></i> +3 este año
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card">
                <div class="stat-card-body">
                    <div class="stat-card-icon bg-warning">
                        <i class="fas fa-book"></i>
                    </div>
                    <div class="stat-card-content">
                        <h3 class="stat-card-number">{{ \App\Models\Materia::count() }}</h3>
                        <p class="stat-card-label">Materias</p>
                        <div class="stat-card-trend neutral">
                            <i class="fas fa-minus"></i> Sin cambios
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card">
                <div class="stat-card-body">
                    <div class="stat-card-icon bg-info">
                        <i class="fas fa-clipboard-check"></i>
                    </div>
                    <div class="stat-card-content">
                        <h3 class="stat-card-number">{{ \App\Models\Nota::count() }}</h3>
                        <p class="stat-card-label">Notas Registradas</p>
                        <div class="stat-card-trend positive">
                            <i class="fas fa-arrow-up"></i> +45 esta semana
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contenido Principal -->
    <div class="row">
        <!-- Accesos Rápidos -->
        <div class="col-lg-8 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">
                        <i class="fas fa-bolt"></i> Accesos Rápidos
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <a href="{{ route('nota.seleccionar') }}" class="quick-access-item">
                                <div class="quick-access-icon bg-primary">
                                    <i class="fas fa-clipboard-list"></i>
                                </div>
                                <div class="quick-access-content">
                                    <h6>Registro de Notas</h6>
                                    <p>Gestionar calificaciones de estudiantes</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6 mb-3">
                            <a href="{{ route('matricula.index') }}" class="quick-access-item">
                                <div class="quick-access-icon bg-success">
                                    <i class="fas fa-id-card"></i>
                                </div>
                                <div class="quick-access-content">
                                    <h6>Gestión de Matrículas</h6>
                                    <p>Administrar inscripciones de estudiantes</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6 mb-3">
                            <a href="{{ route('curso.index') }}" class="quick-access-item">
                                <div class="quick-access-icon bg-warning">
                                    <i class="fas fa-chalkboard"></i>
                                </div>
                                <div class="quick-access-content">
                                    <h6>Gestión de Cursos</h6>
                                    <p>Administrar cursos y asignaciones</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6 mb-3">
                            <a href="{{ route('asignacion.index') }}" class="quick-access-item">
                                <div class="quick-access-icon bg-info">
                                    <i class="fas fa-user-tie"></i>
                                </div>
                                <div class="quick-access-content">
                                    <h6>Asignaciones Docentes</h6>
                                    <p>Gestionar asignación de materias</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actividad Reciente -->
        <div class="col-lg-4 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">
                        <i class="fas fa-clock"></i> Actividad Reciente
                    </h5>
                </div>
                <div class="card-body">
                    <div class="activity-list">
                        <div class="activity-item">
                            <div class="activity-icon bg-success">
                                <i class="fas fa-plus"></i>
                            </div>
                            <div class="activity-content">
                                <h6>Nueva matrícula registrada</h6>
                                <p>Estudiante: María González</p>
                                <small>Hace 2 horas</small>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon bg-primary">
                                <i class="fas fa-edit"></i>
                            </div>
                            <div class="activity-content">
                                <h6>Notas actualizadas</h6>
                                <p>Curso: 10° A - Matemáticas</p>
                                <small>Hace 4 horas</small>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon bg-warning">
                                <i class="fas fa-user-plus"></i>
                            </div>
                            <div class="activity-content">
                                <h6>Nuevo docente registrado</h6>
                                <p>Prof. Carlos Rodríguez</p>
                                <small>Hace 1 día</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Información del Sistema -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">
                        <i class="fas fa-info-circle"></i> Información del Sistema
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="info-item">
                                <strong>Año Lectivo:</strong>
                                <span>{{ \App\Models\AnioLectivo::where('activo', true)->first()->anio ?? 'No configurado' }}</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-item">
                                <strong>Período Actual:</strong>
                                <span>{{ \App\Models\Periodo::latest()->first()->nombre ?? 'No configurado' }}</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-item">
                                <strong>Total Grados:</strong>
                                <span>{{ \App\Models\Grado::count() }}</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-item">
                                <strong>Docentes Activos:</strong>
                                <span>{{ \App\Models\User::where('tipo', 'docente')->count() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Estilos adicionales específicos para el dashboard */
.quick-access-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    border-radius: 0.75rem;
    text-decoration: none;
    color: inherit;
    transition: all 0.2s;
    border: 1px solid #e5e7eb;
}

.quick-access-item:hover {
    background: #f8fafc;
    border-color: #2563eb;
    transform: translateX(4px);
    text-decoration: none;
    color: inherit;
}

.quick-access-icon {
    width: 50px;
    height: 50px;
    border-radius: 0.75rem;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.2rem;
}

.quick-access-content h6 {
    margin: 0;
    font-weight: 600;
    color: #1f2937;
}

.quick-access-content p {
    margin: 0.25rem 0 0 0;
    font-size: 0.85rem;
    color: #6b7280;
}

.activity-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.activity-item {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1rem;
    border-radius: 0.75rem;
    background: #f8fafc;
    transition: all 0.2s;
}

.activity-item:hover {
    background: #f1f5f9;
}

.activity-icon {
    width: 40px;
    height: 40px;
    border-radius: 0.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 0.9rem;
    flex-shrink: 0;
}

.activity-content h6 {
    margin: 0;
    font-weight: 600;
    color: #1f2937;
    font-size: 0.9rem;
}

.activity-content p {
    margin: 0.25rem 0;
    font-size: 0.8rem;
    color: #6b7280;
}

.activity-content small {
    color: #9ca3af;
    font-size: 0.75rem;
}

.info-item {
    padding: 1rem;
    background: #f8fafc;
    border-radius: 0.5rem;
    text-align: center;
}

.info-item strong {
    display: block;
    color: #374151;
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
}

.info-item span {
    color: #2563eb;
    font-weight: 600;
    font-size: 1.1rem;
}

@media (max-width: 768px) {
    .dashboard-header {
        flex-direction: column;
        text-align: center;
    }
    
    .user-info {
        justify-content: center;
    }
    
    .quick-actions {
        justify-content: center;
    }
    
    .stat-card-body {
        flex-direction: column;
        text-align: center;
    }
}
</style>
@endsection
