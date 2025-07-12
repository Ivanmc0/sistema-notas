<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Institución Educativa Liceo Comunitario Nueva Generación</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="icon" href="https://api.dicebear.com/7.x/shapes/svg?seed=school" type="image/svg+xml">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background: linear-gradient(135deg, #e0e7ff 0%, #60a5fa 100%);
            min-height: 100vh;
            margin: 0;
            color: #1e293b;
            display: flex;
            flex-direction: column;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 2rem;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .hero {
            text-align: center;
            margin-bottom: 2.5rem;
        }
        .logo {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            margin-bottom: 1rem;
            box-shadow: 0 4px 24px 0 #3b82f6aa;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .hero-title {
            font-size: 2.2rem;
            font-weight: 700;
            color: #2563eb;
            margin-bottom: 0.5rem;
        }
        .hero-desc {
            font-size: 1.1rem;
            color: #334155;
            margin-bottom: 1.5rem;
        }
        .login-btn {
            background: #2563eb;
            color: #fff;
            padding: 0.9rem 2.2rem;
            border: none;
            border-radius: 0.5rem;
            font-size: 1.1rem;
            font-weight: 600;
            box-shadow: 0 2px 8px 0 #2563eb44;
            cursor: pointer;
            transition: background 0.2s;
            text-decoration: none;
            display: inline-block;
        }
        .login-btn:hover {
            background: #1d4ed8;
        }
        .features {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            justify-content: center;
            margin: 2.5rem 0 2rem 0;
        }
        .feature-card {
            background: #fff;
            border-radius: 1rem;
            box-shadow: 0 2px 12px 0 #3b82f622;
            padding: 1.5rem 1.2rem;
            min-width: 220px;
            max-width: 260px;
            flex: 1 1 220px;
            text-align: center;
        }
        .feature-icon {
            font-size: 2.2rem;
            color: #2563eb;
            margin-bottom: 0.5rem;
        }
        .feature-title {
            font-weight: 700;
            margin-bottom: 0.3rem;
        }
        .feature-desc {
            color: #64748b;
            font-size: 0.98rem;
        }
        footer {
            text-align: center;
            padding: 1.2rem 0 0.5rem 0;
            color: #64748b;
            font-size: 0.98rem;
        }
        @media (max-width: 700px) {
            .container { padding: 1rem; }
            .features { flex-direction: column; gap: 1rem; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="hero">
            <div class="logo">
                <img src="https://api.dicebear.com/7.x/shapes/svg?seed=school" alt="Logo colegio" width="60" height="60">
            </div>
            <div class="hero-title">Institución Educativa<br>Liceo Comunitario Nueva Generación</div>
            <div class="hero-desc">Bienvenido al sistema de gestión de notas y matrículas. Administra calificaciones, estudiantes y reportes de manera fácil y segura.</div>
            <a href="{{ route('login') }}" class="login-btn">Iniciar sesión</a>
        </div>
        <div class="features">
            <div class="feature-card">
                <div class="feature-icon">📊</div>
                <div class="feature-title">Gestión de Notas</div>
                <div class="feature-desc">Registra y consulta calificaciones de los estudiantes por materia y período.</div>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🧑‍🎓</div>
                <div class="feature-title">Matrícula de Estudiantes</div>
                <div class="feature-desc">Administra la inscripción y seguimiento académico de los estudiantes.</div>
            </div>
            <div class="feature-card">
                <div class="feature-icon">📅</div>
                <div class="feature-title">Períodos y Cursos</div>
                <div class="feature-desc">Organiza los cursos, materias y períodos lectivos de manera eficiente.</div>
            </div>
            <div class="feature-card">
                <div class="feature-icon">📑</div>
                <div class="feature-title">Reportes</div>
                <div class="feature-desc">Genera reportes académicos y listados para el control institucional.</div>
            </div>
        </div>
    </div>
    <footer>
        &copy; {{ date('Y') }} Institución Educativa Liceo Comunitario Nueva Generación. Desarrollado para gestión escolar.
    </footer>
</body>
</html>
