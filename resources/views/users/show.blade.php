@extends('layouts.app')

@section('title', 'Mi Perfil')

@section('content')

<div class="container mx-auto px-4 py-6 max-w-4xl">
    <!-- Header -->
    <div class="text-center mb-8">
        <h1 class="text-4xl font-bold text-base-content mb-2">Mi Perfil</h1>
        <p class="text-base-content/70 text-lg">Gestiona tu información personal y revisa tu historial</p>
    </div>

    <!-- Mensajes de éxito/error -->
    @if(isset($viewData['success']))
    <div class="alert alert-success shadow-lg mb-6">
        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span>{{ $viewData['success'] }}</span>
    </div>
    @endif

    @if(isset($viewData['error']))
    <div class="alert alert-error shadow-lg mb-6">
        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span>{{ $viewData['error'] }}</span>
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Información del Usuario -->
        <div class="lg:col-span-2">
            <div class="card bg-base-100 shadow-lg border border-neutral/20">
                <div class="card-header bg-gradient-to-r from-primary to-accent text-primary-content p-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div class="avatar placeholder">
                                <div class="bg-neutral text-neutral-content rounded-full w-16 h-16">
                                    <span class="text-2xl font-bold">
                                        {{ substr($viewData['user']->getName(), 0, 1) }}
                                    </span>
                                </div>
                            </div>
                            <div>
                                <h2 class="text-2xl font-bold">{{ $viewData['user']->getName() }}</h2>
                                <p class="text-primary-content/80">Usuario desde {{ $viewData['user']->getCreatedAt()->format('d/m/Y') }}</p>
                            </div>
                        </div>
                        <a href="{{ route('users.edit') }}" class="btn btn-ghost btn-sm text-primary-content hover:bg-white/20">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Editar Perfil
                        </a>
                    </div>
                </div>

                <div class="card-body p-6">
                    <!-- Información Personal -->
                    <div class="space-y-6">
                        <div>
                            <h3 class="text-lg font-semibold text-base-content mb-4 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Información Personal
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Nombre -->
                                <div class="form-control">
                                    <label class="label">
                                        <span class="label-text font-medium">Nombre Completo</span>
                                    </label>
                                    <div class="input input-bordered flex items-center bg-base-200">
                                        <span class="text-base-content">{{ $viewData['user']->getName() }}</span>
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="form-control">
                                    <label class="label">
                                        <span class="label-text font-medium">Correo Electrónico</span>
                                    </label>
                                    <div class="input input-bordered flex items-center bg-base-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-base-content/60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                        </svg>
                                        <span class="text-base-content">{{ $viewData['user']->getEmail() }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Información de Contacto -->
                        <div>
                            <h3 class="text-lg font-semibold text-base-content mb-4 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Información de Contacto
                            </h3>
                            
                            <!-- Dirección -->
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text font-medium">Dirección</span>
                                </label>
                                <div class="textarea textarea-bordered bg-base-200 min-h-[4rem] flex items-start p-3">
                                    @if($viewData['user']->getAddress())
                                        <span class="text-base-content">{{ $viewData['user']->getAddress() }}</span>
                                    @else
                                        <span class="text-base-content/40 italic">No se ha registrado una dirección</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Información de Pago -->
                        <div>
                            <h3 class="text-lg font-semibold text-base-content mb-4 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                </svg>
                                Información de Pago
                            </h3>
                            
                            <!-- Datos de Tarjeta -->
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text font-medium">Datos de Tarjeta</span>
                                </label>
                                <div class="input input-bordered bg-base-200 flex items-center">
                                    @if($viewData['user']->getCardData())
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-success" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span class="text-base-content">•••• •••• •••• ••••</span>
                                        <span class="badge badge-success badge-sm ml-auto">Verificada</span>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-warning" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                        </svg>
                                        <span class="text-base-content/40 italic">No se han registrado datos de pago</span>
                                        <span class="badge badge-warning badge-sm ml-auto">Pendiente</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Botón de Actualización usando PATCH -->
                        <div class="card-actions pt-6 border-t border-neutral/20">
                            <form action="{{ route('users.update') }}" method="POST" class="w-full">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-primary w-full lg:w-auto px-8" 
                                        onclick="return confirm('¿Deseas continuar con la actualización de tu perfil?')">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                    </svg>
                                    Actualizar Perfil
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar con Estadísticas y Acciones Rápidas -->
        <div class="space-y-6">
            <!-- Estadísticas -->
            <div class="card bg-base-100 shadow-lg border border-neutral/20">
                <div class="card-body p-6">
                    <h3 class="text-lg font-semibold text-base-content mb-4 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        Estadísticas
                    </h3>
                    
                    <div class="space-y-4">
                        <!-- Total de Órdenes -->
                        <div class="stat bg-primary/10 rounded-lg p-4">
                            <div class="stat-figure text-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14a1 1 0 011 1v9a1 1 0 01-1 1H5a1 1 0 01-1-1v-9a1 1 0 011-1z" />
                                </svg>
                            </div>
                            <div class="stat-title text-base-content/70">Total Órdenes</div>
                            <div class="stat-value text-primary">{{ count($viewData['orders']) }}</div>
                        </div>

                        <!-- Monto Total Gastado -->
                        <div class="stat bg-success/10 rounded-lg p-4">
                            <div class="stat-figure text-success">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                                </svg>
                            </div>
                            <div class="stat-title text-base-content/70">Total Gastado</div>
                            <div class="stat-value text-success">
                                ${{ number_format($viewData['orders']->sum('totalAmount'), 0, ',', '.') }}
                            </div>
                        </div>

                        <!-- Estado de la Cuenta -->
                        <div class="stat bg-info/10 rounded-lg p-4">
                            <div class="stat-figure text-info">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </div>
                            <div class="stat-title text-base-content/70">Estado</div>
                            <div class="stat-value text-info">Activa</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Acciones Rápidas -->
            <div class="card bg-base-100 shadow-lg border border-neutral/20">
                <div class="card-body p-6">
                    <h3 class="text-lg font-semibold text-base-content mb-4 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                        Acciones Rápidas
                    </h3>
                    
                    <div class="space-y-3">
                        <a href="{{ route('users.edit') }}" class="btn btn-outline btn-sm w-full justify-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Editar Información
                        </a>
                        
                        <a href="{{ route('supplements.index') }}" class="btn btn-outline btn-sm w-full justify-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14a1 1 0 011 1v9a1 1 0 01-1 1H5a1 1 0 01-1-1v-9a1 1 0 011-1z" />
                            </svg>
                            Ver Suplementos
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Historial de Órdenes Recientes -->
    @if(count($viewData['orders']) > 0)
        <div class="mt-8">
            <div class="card bg-base-100 shadow-lg border border-neutral/20">
                <div class="card-body p-6">
                    <h3 class="text-xl font-semibold text-base-content mb-6 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        Órdenes Recientes
                    </h3>
                    
                    <div class="overflow-x-auto">
                        <table class="table table-zebra w-full">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Estado</th>
                                    <th>Total</th>
                                    <th>Fecha</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($viewData['orders']->take(5) as $order)
                                    <tr>
                                        <td class="font-mono">#{{ str_pad($order->getId(), 4, '0', STR_PAD_LEFT) }}</td>
                                        <td>
                                            <span class="badge 
                                                @if($order->getStatus() == 'completed') badge-success 
                                                @elseif($order->getStatus() == 'pending') badge-warning
                                                @else badge-error @endif">
                                                {{ ucfirst($order->getStatus()) }}
                                            </span>
                                        </td>
                                        <td class="font-semibold">${{ number_format($order->getTotalAmount(), 0, ',', '.') }}</td>
                                        <td>{{ $order->getCreatedAt()->format('d/m/Y') }}</td>
                                        <td>
                                            <button class="btn btn-ghost btn-sm" onclick="alert('Ver detalles de orden #{{ $order->getId() }}')">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    @if(count($viewData['orders']) > 5)
                        <div class="text-center mt-4">
                            <button class="btn btn-ghost btn-sm" onclick="alert('Ver todas las órdenes')">
                                Ver todas las órdenes ({{ count($viewData['orders']) }})
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif
</div>

<style>
/* Animaciones y estilos adicionales */
.card:hover {
    transform: translateY(-2px);
    transition: transform 0.2s ease-in-out;
}

.stat {
    transition: all 0.2s ease-in-out;
}

.stat:hover {
    transform: scale(1.02);
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .grid-cols-1.md\\:grid-cols-2 {
        grid-template-columns: 1fr;
    }
}

/* Avatar gradient */
.avatar .rounded-full {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}
</style>

@endsection