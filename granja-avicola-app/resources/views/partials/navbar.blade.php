<header class="header">
    <h1>🐔 Granja Avícola Pro</h1>
    <nav class="nav">
        <a href="{{ route('dashboard') }}">Dashboard</a>
        <a href="{{ route('flocks.index') }}">Lotes</a>

        {{-- Enlace solo para Administradores --}}
        @if(auth()->check() && auth()->user()->role === 'admin')
            <a href="{{ route('admin.employees.index') }}">Gestionar Empleados</a>
        @endif

        {{-- Espacio para el nombre de usuario y logout --}}
        <div style="margin-left: 2rem;">
            @if(auth()->check())
                <span>{{ auth()->user()->name }}</span>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="margin-left: 1rem;">Logout</a>
                <form id="logout-form" action="#" method="POST" style="display: none;">
                    @csrf
                </form>
            @else
                <a href="#">Login</a>
            @endif
        </div>
    </nav>
</header>
