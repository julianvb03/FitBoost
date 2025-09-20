@extends('layouts.app')

@section('title', 'Editar Perfil')

@section('content')

<div class="container mx-auto px-4 py-6 max-w-6xl">
    <!-- Header -->
    <div class="text-center mb-8">
        <h1 class="text-4xl font-bold text-base-content mb-2">Editar Mi Perfil</h1>
        <p class="text-base-content/70 text-lg">Actualiza tu información personal y configuración de cuenta</p>
    </div>

    <!-- Breadcrumb -->
    <div class="text-sm breadcrumbs mb-6">
        <ul>
            <li>
                <a href="{{ route('users.show') }}" class="text-primary hover:text-primary-focus">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Mi Perfil
                </a>
            </li>
            <li>
                <span class="text-base-content/70">Editar</span>
            </li>
        </ul>
    </div>

    <!-- Mensajes de éxito/error -->
    @if(session('success'))
        <div class="alert alert-success mb-6 shadow-lg">
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error mb-6 shadow-lg">
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    <form action="{{ route('users.update') }}" method="POST">
        @csrf
        @method('PATCH')
        
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Formulario Principal -->
            <div class="lg:col-span-3 space-y-6">
                
                <!-- 1. INFORMACIÓN PERSONAL -->
                <div class="card bg-base-100 shadow-lg border border-neutral/20">
                    <div class="card-header bg-gradient-to-r from-primary to-secondary text-primary-content p-6">
                        <h2 class="text-xl font-bold flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Información Personal
                        </h2>
                        <p class="text-primary-content/80 mt-2">Actualiza tu nombre y correo electrónico</p>
                    </div>

                    <div class="card-body p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nombre -->
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text font-semibold text-base">
                                        <span class="text-error">*</span> Nombre Completo
                                    </span>
                                </label>
                                <input 
                                    type="text" 
                                    name="name" 
                                    value="{{ old('name', $viewData['user']->getName()) }}"
                                    placeholder="Ingresa tu nombre completo" 
                                    class="input input-bordered input-lg focus:input-primary"
                                    required
                                />
                                @error('name')
                                    <label class="label">
                                        <span class="label-text-alt text-error">{{ $message }}</span>
                                    </label>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text font-semibold text-base">
                                        <span class="text-error">*</span> Correo Electrónico
                                    </span>
                                </label>
                                <input 
                                    type="email" 
                                    name="email" 
                                    value="{{ old('email', $viewData['user']->getEmail()) }}"
                                    placeholder="correo@ejemplo.com" 
                                    class="input input-bordered input-lg focus:input-primary"
                                    required
                                />
                                @error('email')
                                    <label class="label">
                                        <span class="label-text-alt text-error">{{ $message }}</span>
                                    </label>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 2. CAMBIO DE CONTRASEÑA -->
                <div class="card bg-base-100 shadow-lg border border-neutral/20">
                    <div class="card-header bg-gradient-to-r from-secondary to-accent text-secondary-content p-6">
                        <h2 class="text-xl font-bold flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            Cambiar Contraseña
                        </h2>
                        <p class="text-secondary-content/80 mt-2">Deja en blanco si no deseas cambiar la contraseña</p>
                    </div>

                    <div class="card-body p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nueva Contraseña -->
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text font-semibold text-base">Nueva Contraseña</span>
                                </label>
                                <div class="relative">
                                    <input 
                                        type="password" 
                                        id="password"
                                        name="password" 
                                        placeholder="••••••••" 
                                        class="input input-bordered input-lg focus:input-secondary w-full pr-12"
                                        minlength="6"
                                    />
                                    <button type="button" onclick="togglePassword('password')" 
                                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-base-content/60 hover:text-base-content">
                                        <svg id="password-eye" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                </div>
                                @error('password')
                                    <label class="label">
                                        <span class="label-text-alt text-error">{{ $message }}</span>
                                    </label>
                                @enderror
                            </div>

                            <!-- Confirmar Contraseña -->
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text font-semibold text-base">Confirmar Contraseña</span>
                                </label>
                                <div class="relative">
                                    <input 
                                        type="password" 
                                        id="confirm_password"
                                        name="confirm_password" 
                                        placeholder="••••••••" 
                                        class="input input-bordered input-lg focus:input-secondary w-full pr-12"
                                        minlength="6"
                                    />
                                    <button type="button" onclick="togglePassword('confirm_password')" 
                                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-base-content/60 hover:text-base-content">
                                        <svg id="confirm_password-eye" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                </div>
                                @error('confirm_password')
                                    <label class="label">
                                        <span class="label-text-alt text-error">{{ $message }}</span>
                                    </label>
                                @enderror
                            </div>
                        </div>

                        <!-- Indicador de fortaleza de contraseña -->
                        <div class="mt-6">
                            <div class="text-sm font-medium text-base-content mb-3">Fortaleza de la contraseña:</div>
                            <div class="flex space-x-2">
                                <div class="h-3 flex-1 bg-base-300 rounded-full" id="strength-1"></div>
                                <div class="h-3 flex-1 bg-base-300 rounded-full" id="strength-2"></div>
                                <div class="h-3 flex-1 bg-base-300 rounded-full" id="strength-3"></div>
                                <div class="h-3 flex-1 bg-base-300 rounded-full" id="strength-4"></div>
                            </div>
                            <div class="text-sm mt-2 font-medium" id="strength-text">Ingresa una contraseña</div>
                        </div>
                    </div>
                </div>

                <!-- 3. INFORMACIÓN DE CONTACTO -->
                <div class="card bg-base-100 shadow-lg border border-neutral/20">
                    <div class="card-header bg-gradient-to-r from-info to-primary text-info-content p-6">
                        <h2 class="text-xl font-bold flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Información de Contacto
                        </h2>
                        <p class="text-info-content/80 mt-2">Actualiza tu dirección de envío</p>
                    </div>

                    <div class="card-body p-6">
                        <!-- Dirección -->
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-semibold text-base">Dirección de Envío</span>
                            </label>
                            <textarea 
                                name="address" 
                                placeholder="Ingresa tu dirección completa para envíos..."
                                class="textarea textarea-bordered textarea-lg focus:textarea-info h-32 resize-none"
                            >{{ old('address', $viewData['user']->getAddress()) }}</textarea>
                            @error('address')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                            <label class="label">
                                <span class="label-text-alt text-base-content/60 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Esta dirección será utilizada para los envíos de tus pedidos
                                </span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- 4. INFORMACIÓN DE PAGO -->
                <div class="card bg-base-100 shadow-lg border border-neutral/20">
                    <div class="card-header bg-gradient-to-r from-warning to-error text-warning-content p-6">
                        <h2 class="text-xl font-bold flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                            </svg>
                            Información de Pago
                        </h2>
                        <p class="text-warning-content/80 mt-2">Datos de tu tarjeta para procesar pagos</p>
                    </div>

                    <div class="card-body p-6">
                        <!-- Datos de Tarjeta -->
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-semibold text-base">Datos de Tarjeta</span>
                            </label>
                            <input 
                                type="text" 
                                name="card_data" 
                                value="{{ old('card_data', $viewData['user']->getCardData() ? '•••• •••• •••• ••••' : '') }}"
                                placeholder="Ingresa los datos de tu tarjeta de crédito/débito" 
                                class="input input-bordered input-lg focus:input-warning"
                            />
                            @error('card_data')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                            <label class="label">
                                <span class="label-text-alt text-base-content/60 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                    Esta información está cifrada y es segura
                                </span>
                            </label>
                        </div>

                        <!-- Aviso de Seguridad -->
                        <div class="alert alert-info mt-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <h3 class="font-bold text-lg">Información Segura</h3>
                                <div class="text-sm mt-1">Todos los datos de pago son cifrados y almacenados de forma segura. Nunca compartimos tu información financiera.</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Botones de Acción -->
                <div class="flex flex-col sm:flex-row gap-4 justify-end pt-8">
                    <a href="{{ route('users.show') }}" class="btn btn-ghost btn-lg px-8">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary btn-lg px-8">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Guardar Cambios
                    </button>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Avatar Preview -->
                <div class="card bg-base-100 shadow-lg border border-neutral/20">
                    <div class="card-body p-6 text-center">
                        <h3 class="text-lg font-semibold text-base-content mb-4">Vista Previa</h3>
                        <div class="avatar placeholder mb-4">
                            <div class="bg-gradient-to-br from-primary to-secondary text-primary-content rounded-full w-20 h-20">
                                <span class="text-3xl font-bold" id="avatar-preview">
                                    {{ substr($viewData['user']->getName(), 0, 1) }}
                                </span>
                            </div>
                        </div>
                        <p class="text-base-content font-medium text-lg" id="name-preview">
                            {{ $viewData['user']->getName() }}
                        </p>
                        <p class="text-base-content/60" id="email-preview">
                            {{ $viewData['user']->getEmail() }}
                        </p>
                    </div>
                </div>

                <!-- Consejos de Seguridad -->
                <div class="card bg-base-100 shadow-lg border border-neutral/20">
                    <div class="card-body p-6">
                        <h3 class="text-lg font-semibold text-base-content mb-4 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-success" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            Consejos de Seguridad
                        </h3>
                        
                        <div class="space-y-4 text-sm">
                            <div class="flex items-start gap-3">
                                <div class="badge badge-success badge-xs mt-1.5"></div>
                                <div>
                                    <p class="font-medium text-base-content">Contraseña Segura</p>
                                    <p class="text-base-content/60">Usa al menos 8 caracteres con mayúsculas, minúsculas y números</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start gap-3">
                                <div class="badge badge-info badge-xs mt-1.5"></div>
                                <div>
                                    <p class="font-medium text-base-content">Email Verificado</p>
                                    <p class="text-base-content/60">Usa un email al que tengas acceso para recibir notificaciones</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start gap-3">
                                <div class="badge badge-warning badge-xs mt-1.5"></div>
                                <div>
                                    <p class="font-medium text-base-content">Información Actualizada</p>
                                    <p class="text-base-content/60">Mantén tu dirección actualizada para envíos correctos</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Estadísticas de Cuenta -->
                <div class="card bg-base-100 shadow-lg border border-neutral/20">
                    <div class="card-body p-6">
                        <h3 class="text-lg font-semibold text-base-content mb-4 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                            Tu Cuenta
                        </h3>
                        
                        <div class="space-y-3">
                            <div class="flex justify-between items-center">
                                <span class="text-base-content/70">Miembro desde:</span>
                                <span class="font-medium">{{ $viewData['user']->getCreatedAt()->format('M Y') }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-base-content/70">Estado:</span>
                                <span class="badge badge-success badge-sm">Activa</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-base-content/70">Última actualización:</span>
                                <span class="font-medium">{{ $viewData['user']->getUpdatedAt()->format('d/m/Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- JavaScript para funcionalidades interactivas -->
<script>
    // Toggle password visibility
    function togglePassword(inputId) {
        const input = document.getElementById(inputId);
        const eye = document.getElementById(inputId + '-eye');
        
        if (input.type === 'password') {
            input.type = 'text';
            eye.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L8.05 8.05m1.828 1.828l4.242 4.242M12 3c.866 0 1.724.134 2.55.395M21 21l-3-3m0 0l-7.5-7.5" />
            `;
        } else {
            input.type = 'password';
            eye.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            `;
        }
    }

    // Password strength checker
    function checkPasswordStrength(password) {
        let strength = 0;
        if (password.length >= 8) strength++;
        if (/[a-z]/.test(password)) strength++;
        if (/[A-Z]/.test(password)) strength++;
        if (/[0-9]/.test(password)) strength++;
        if (/[^A-Za-z0-9]/.test(password)) strength++;
        return Math.min(strength, 4);
    }

    function updatePasswordStrength() {
        const password = document.getElementById('password').value;
        const strength = checkPasswordStrength(password);
        const strengthTexts = ['Muy débil', 'Débil', 'Regular', 'Fuerte', 'Muy fuerte'];
        const strengthColors = ['bg-error', 'bg-warning', 'bg-info', 'bg-success', 'bg-success'];
        
        // Reset all bars
        for (let i = 1; i <= 4; i++) {
            const bar = document.getElementById(`strength-${i}`);
            bar.className = 'h-3 flex-1 bg-base-300 rounded-full';
        }
        
        // Fill bars based on strength
        for (let i = 1; i <= strength; i++) {
            const bar = document.getElementById(`strength-${i}`);
            bar.className = `h-3 flex-1 rounded-full ${strengthColors[strength - 1]}`;
        }
        
        // Update text
        const strengthText = document.getElementById('strength-text');
        if (password.length === 0) {
            strengthText.textContent = 'Ingresa una contraseña';
            strengthText.className = 'text-sm mt-2 font-medium';
        } else {
            strengthText.textContent = strengthTexts[strength - 1] || 'Muy débil';
            strengthText.className = `text-sm mt-2 font-medium ${strength >= 3 ? 'text-success' : strength >= 2 ? 'text-warning' : 'text-error'}`;
        }
    }

    // Update preview as user types
    function updatePreview() {
        const nameInput = document.querySelector('input[name="name"]');
        const emailInput = document.querySelector('input[name="email"]');
        
        if (nameInput) {
            nameInput.addEventListener('input', function() {
                const namePreview = document.getElementById('name-preview');
                const avatarPreview = document.getElementById('avatar-preview');
                
                const newName = this.value || '{{ $viewData["user"]->getName() }}';
                namePreview.textContent = newName;
                avatarPreview.textContent = newName.charAt(0).toUpperCase();
            });
        }
        
        if (emailInput) {
            emailInput.addEventListener('input', function() {
                const emailPreview = document.getElementById('email-preview');
                emailPreview.textContent = this.value || '{{ $viewData["user"]->getEmail() }}';
            });
        }
    }

    // Initialize when DOM is loaded
    document.addEventListener('DOMContentLoaded', function() {
        const passwordInput = document.getElementById('password');
        if (passwordInput) {
            passwordInput.addEventListener('input', updatePasswordStrength);
        }
        
        updatePreview();
        
        // Smooth scroll to form sections
        const cards = document.querySelectorAll('.card');
        cards.forEach(card => {
            card.addEventListener('click', function() {
                this.scrollIntoView({ behavior: 'smooth', block: 'center' });
            });
        });
    });

    // Form validation before submit
    document.querySelector('form').addEventListener('submit', function(e) {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirm_password').value;
        
        // Check if passwords match when both are filled
        if (password && password !== confirmPassword) {
            e.preventDefault();
            
            // Show error alert
            const errorAlert = document.createElement('div');
            errorAlert.className = 'alert alert-error mb-6 shadow-lg';
            errorAlert.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Las contraseñas no coinciden. Por favor verifica e intenta nuevamente.</span>
            `;
            
            // Insert error at top of form
            const form = document.querySelector('form');
            form.insertBefore(errorAlert, form.firstChild);
            
            // Scroll to error
            errorAlert.scrollIntoView({ behavior: 'smooth', block: 'start' });
            
            // Remove error after 5 seconds
            setTimeout(() => {
                errorAlert.remove();
            }, 5000);
            
            return false;
        }
        
        // Check password length if provided
        if (password && password.length < 6) {
            e.preventDefault();
            
            const errorAlert = document.createElement('div');
            errorAlert.className = 'alert alert-error mb-6 shadow-lg';
            errorAlert.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>La contraseña debe tener al menos 6 caracteres.</span>
            `;
            
            const form = document.querySelector('form');
            form.insertBefore(errorAlert, form.firstChild);
            
            errorAlert.scrollIntoView({ behavior: 'smooth', block: 'start' });
            
            setTimeout(() => {
                errorAlert.remove();
            }, 5000);
            
            return false;
        }

        // Show loading state on submit button
        const submitBtn = document.querySelector('button[type="submit"]');
        const originalContent = submitBtn.innerHTML;
        
        submitBtn.disabled = true;
        submitBtn.innerHTML = `
            <svg class="animate-spin h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Guardando...
        `;
        
        // Reset button after 30 seconds (in case of slow response)
        setTimeout(() => {
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalContent;
        }, 30000);
    });

    // Add auto-save draft functionality (optional)
    let autoSaveTimeout;
    const formInputs = document.querySelectorAll('input, textarea');
    
    formInputs.forEach(input => {
        input.addEventListener('input', function() {
            // Clear existing timeout
            clearTimeout(autoSaveTimeout);
            
            // Set new timeout for auto-save (3 seconds after user stops typing)
            autoSaveTimeout = setTimeout(() => {
                saveDraft();
            }, 3000);
        });
    });

    function saveDraft() {
        // Save form data to localStorage as draft
        const formData = new FormData(document.querySelector('form'));
        const draftData = {};
        
        for (let [key, value] of formData.entries()) {
            // Don't save password fields for security
            if (!key.includes('password')) {
                draftData[key] = value;
            }
        }
        
        localStorage.setItem('profile_draft', JSON.stringify(draftData));
        
        // Show brief save indicator
        showSaveIndicator();
    }

    function showSaveIndicator() {
        const indicator = document.createElement('div');
        indicator.className = 'toast toast-top toast-end';
        indicator.innerHTML = `
            <div class="alert alert-info">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Borrador guardado</span>
            </div>
        `;
        
        document.body.appendChild(indicator);
        
        setTimeout(() => {
            indicator.remove();
        }, 2000);
    }

    // Load draft on page load
    function loadDraft() {
        const draftData = localStorage.getItem('profile_draft');
        if (draftData) {
            try {
                const draft = JSON.parse(draftData);
                
                Object.keys(draft).forEach(key => {
                    const input = document.querySelector(`[name="${key}"]`);
                    if (input && input.value === '') {
                        input.value = draft[key];
                        
                        // Trigger change event for preview updates
                        if (key === 'name' || key === 'email') {
                            input.dispatchEvent(new Event('input'));
                        }
                    }
                });
            } catch (e) {
                // Invalid draft data, remove it
                localStorage.removeItem('profile_draft');
            }
        }
    }

    // Clear draft after successful submit
    window.addEventListener('beforeunload', function() {
        // Only clear draft if form was actually submitted successfully
        // This would need to be implemented based on your success response handling
    });

    // Initialize draft loading
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(loadDraft, 500); // Small delay to ensure form is fully rendered
    });
</script>

<style>
/* Animaciones suaves */
.card {
    transition: all 0.3s ease-in-out;
}

.card:hover {
    transform: translateY(-4px);
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

/* Focus styles mejorados */
.input:focus, .textarea:focus, .select:focus {
    transform: scale(1.02);
    transition: all 0.2s ease-in-out;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

/* Avatar gradient animation */
.avatar .rounded-full {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    animation: gradient-shift 4s ease-in-out infinite;
}

@keyframes gradient-shift {
    0%, 100% { 
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); 
    }
    33% { 
        background: linear-gradient(135deg, #764ba2 0%, #f093fb 100%); 
    }
    66% { 
        background: linear-gradient(135deg, #f093fb 0%, #667eea 100%); 
    }
}

/* Password strength bars animation */
.h-3 {
    transition: all 0.4s ease-in-out;
    transform-origin: left center;
}

/* Card headers gradient animations */
.card-header {
    position: relative;
    overflow: hidden;
}

.card-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s;
}

.card-header:hover::before {
    left: 100%;
}

/* Form sections spacing and responsiveness */
@media (max-width: 768px) {
    .container {
        padding-left: 1rem;
        padding-right: 1rem;
    }
    
    .grid-cols-1.md\\:grid-cols-2 {
        grid-template-columns: 1fr;
    }
    
    .card-header {
        padding: 1.5rem;
    }
    
    .card-body {
        padding: 1.5rem;
    }
    
    .input-lg, .textarea-lg, .btn-lg {
        height: 3rem;
        font-size: 1rem;
        line-height: 1.5rem;
    }
    
    .textarea-lg {
        min-height: 6rem;
    }
}

/* Smooth scrolling for long forms */
html {
    scroll-behavior: smooth;
}

/* Loading state animations */
@keyframes spin {
    to {
        transform: rotate(360deg);
    }
}

.animate-spin {
    animation: spin 1s linear infinite;
}

/* Button hover effects */
.btn {
    transition: all 0.2s ease-in-out;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.btn:active {
    transform: translateY(0);
}

/* Toast notifications */
.toast {
    position: fixed;
    z-index: 1000;
}

.toast-top {
    top: 1rem;
}

.toast-end {
    right: 1rem;
}

/* Enhanced form field styles */
.form-control {
    margin-bottom: 0.5rem;
}

.label-text {
    font-weight: 600;
    color: hsl(var(--bc) / 0.8);
}

/* Custom scrollbar for textarea */
.textarea::-webkit-scrollbar {
    width: 8px;
}

.textarea::-webkit-scrollbar-track {
    background: hsl(var(--b2));
    border-radius: 4px;
}

.textarea::-webkit-scrollbar-thumb {
    background: hsl(var(--bc) / 0.3);
    border-radius: 4px;
}

.textarea::-webkit-scrollbar-thumb:hover {
    background: hsl(var(--bc) / 0.5);
}

/* Loading state for submit button */
.btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none;
}

.btn:disabled:hover {
    transform: none;
    box-shadow: none;
}

/* Enhanced alert styles */
.alert {
    border-radius: 12px;
    border: 1px solid;
    animation: slideIn 0.3s ease-out;
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Breadcrumb hover effects */
.breadcrumbs a:hover {
    color: hsl(var(--p));
    text-decoration: underline;
    text-underline-offset: 4px;
}
</style>

@endsection