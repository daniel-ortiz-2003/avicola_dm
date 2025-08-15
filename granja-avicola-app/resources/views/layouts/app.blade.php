<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestión Avícola Pro</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Styles -->
    <style>
        body { font-family: 'Figtree', sans-serif; background-color: #f3f4f6; color: #1f2937; margin: 0; }
        .app-container { display: flex; min-height: 100vh; }
        .sidebar { width: 220px; background-color: #ffffff; padding: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
        .main-content { flex-grow: 1; }
        .header { display: flex; justify-content: space-between; align-items: center; padding: 1rem 2rem; border-bottom: 1px solid #e5e7eb; background-color: #fff; }
        .header h1 { font-size: 1.5rem; font-weight: 600; }
        .nav a { margin-left: 1rem; color: #4b5563; text-decoration: none; }
        .nav a:hover { text-decoration: underline; }
        .content-area { padding: 2rem; }
        .grid { display: grid; grid-template-columns: repeat(1, minmax(0, 1fr)); gap: 1.5rem; }
        @media (min-width: 768px) { .grid { grid-template-columns: repeat(3, minmax(0, 1fr)); } }
        .card { background-color: #fff; border-radius: 0.5rem; padding: 1.5rem; box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1); }
        .card-title { font-size: 1rem; font-weight: 600; color: #374151; }
        .card-metric { font-size: 2.25rem; font-weight: 700; margin-top: 0.5rem; }
        .alert-card { border-left: 4px solid #ef4444; padding: 1rem; background-color: #fee2e2; }
        .alert-title { font-weight: 600; color: #b91c1c; }
        .chart-container { margin-top: 2rem; }
    </style>
</head>
<body>
    <div class="app-container">
        @include('partials.sidebar')

        <div class="main-content">
            @include('partials.navbar')

            <main class="content-area">
                @yield('content')
            </main>
        </div>
    </div>
    @stack('scripts')

    {{-- Script para notificaciones en vivo con Laravel Echo --}}
    @if(auth()->check())
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script> {{-- Simulación de importación --}}
    <script>
        // Esta sección se incluiría en un archivo JS compilado (ej. app.js)
        // con la configuración de Laravel Echo.

        // 1. Configuración (esto iría en resources/js/bootstrap.js en un proyecto real)
        /*
        window.Pusher = Pusher;

        window.Echo = new Echo({
            broadcaster: 'pusher',
            key: import.meta.env.VITE_PUSHER_APP_KEY,
            cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
            forceTLS: true
        });
        */

        // 2. Escuchar en el canal privado del usuario autenticado
        // Se asume que el usuario tiene un ID.
        const userId = {{ auth()->user()->id }};
        const channelName = `App.Models.User.${userId}`; // Canal por defecto de notificaciones de Laravel

        // window.Echo.private(channelName)
        //     .notification((notification) => {
        //         console.log(notification);
        //         // Aquí la lógica para mostrar la notificación en la UI
        //         alert(`¡Nueva Notificación!\n${notification.title}\n${notification.body}`);
        //     });

        console.log(`Simulación: Escuchando notificaciones en el canal privado: ${channelName}`);

        // Ejemplo de cómo se vería una notificación recibida
        function showExampleNotification() {
            const exampleNotification = {
                title: '¡Alerta de Mortalidad Alta!',
                body: "Alerta: Mortalidad alta detectada en el lote 'Lote Engorde 01'.",
                url: '#'
            };
            alert(`EJEMPLO DE NOTIFICACIÓN:\n${exampleNotification.title}\n${exampleNotification.body}`);
        }
        // Descomentar para ver un ejemplo al cargar la página:
        // showExampleNotification();

    </script>
    @endif
</body>
</html>
