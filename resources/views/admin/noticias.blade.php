@extends('layouts.admin')

@section('title', 'Gestión de Noticias')

@section('content')
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="page-header">
    <h1>Gestión de Noticias</h1>
    <p>Administra todas las noticias de la facultad</p>
    
    <div class="page-actions">
        <a href="{{ route('admin.noticias.crear') }}" class="btn-primary-admin">
            <i class="bi bi-plus-circle"></i>
            Nueva Noticia
        </a>
    </div>
</div>

<div class="data-table-wrapper">
    <div class="table-header">
        <h3>Todas las Noticias</h3>

        <form method="GET" action="{{ route('admin.noticias') }}" id="filtrosForm" class="d-flex gap-2">
            <input 
                type="text" 
                name="busqueda" 
                class="form-control-admin" 
                placeholder="Buscar..." 
                value="{{ $busqueda }}"
                style="max-width: 250px;"
            >

            <select name="estado" class="form-control-admin" style="max-width: 150px;" id="filtroEstado">
                <option value="todas" {{ $estadoFiltro == 'todas' ? 'selected' : '' }}>Todas</option>
                <option value="publicada" {{ $estadoFiltro == 'publicada' ? 'selected' : '' }}>Publicadas</option>
                <option value="borrador" {{ $estadoFiltro == 'borrador' ? 'selected' : '' }}>Borradores</option>
            </select>

            <button type="submit" class="btn-primary-admin" style="padding: 0.75rem 1.2rem;">
                <i class="bi bi-search"></i>
            </button>

            @if($busqueda != '' || $estadoFiltro != 'todas')
                <a href="{{ route('admin.noticias') }}" class="btn-secondary-admin" style="padding: 0.75rem 1.2rem;" title="Limpiar filtros">
                    <i class="bi bi-x-circle"></i>
                </a>
            @endif
        </form>
    </div>
    
    @if($busqueda != '' || $estadoFiltro != 'todas')
        <div style="padding: 1rem 1.5rem; background-color: #f8f9fa; border-bottom: 1px solid #e0e0e0;">
            <small class="text-muted">
                <i class="bi bi-funnel"></i> Filtros activos: 
                @if($busqueda != '')
                    <strong>Búsqueda:</strong> "{{ $busqueda }}"
                @endif
                @if($estadoFiltro != 'todas')
                    @if($busqueda != '') | @endif
                    <strong>Estado:</strong> {{ ucfirst($estadoFiltro) }}
                @endif
            </small>
        </div>
    @endif
    
    <div class="table-responsive">
        @if($noticias->count() > 0)
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Categoría</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($noticias as $noticia)
                    <tr>
                        <td>#{{ $noticia['id'] }}</td>
                        <td>
                            <strong>{!! strip_tags($noticia->titulo) !!}</strong>
                        </td>
                        <td>{{ $noticia['categoria'] }}</td>
                        <td>{{ $noticia['fecha'] }}</td>
                        <td>
                            <span class="badge-status {{ strtolower($noticia['estado']) == 'publicada' ? 'publicada' : 'borrador' }}">
                                {{ $noticia['estado'] }}
                            </span>
                        </td>
                        {{-- En el <tbody>, reemplaza el bloque de acciones --}}
                        <td>
                            <div class="d-flex gap-2">
                                <button class="btn-action" title="Ver" onclick="verNoticia({{ $noticia['id'] }})">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button
                                    class="btn-action destacar-btn {{ $noticia->destacada ? 'destacada-activa' : '' }}"
                                    title="{{ $noticia->destacada ? 'Quitar Noticia Destacada' : 'Destacar Noticia' }}"
                                    onclick="toggleDestacar({{ $noticia['id'] }}, this)"
                                    style="{{ $noticia->destacada ? 'color: #f59e0b; border-color: #f59e0b;' : '' }}"
                                >
                                    <i class="bi {{ $noticia->destacada ? 'bi-star-fill' : 'bi-star' }}"></i>
                                </button>
                                <button class="btn-action" title="Editar" onclick="editarNoticia({{ $noticia['id'] }})">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="btn-action delete" title="Eliminar" onclick="eliminarNoticia({{ $noticia['id'] }}, '{{ $noticia['titulo'] }}')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div style="padding: 3rem; text-align: center;">
                <i class="bi bi-inbox" style="font-size: 4rem; color: var(--uts-gray); opacity: 0.3;"></i>
                <h4 class="mt-3" style="color: var(--uts-gray);">No se encontraron noticias</h4>
                <p class="text-muted">
                    @if($busqueda != '' || $estadoFiltro != 'todas')
                        Intenta ajustar los filtros de búsqueda
                    @else
                        Comienza creando tu primera noticia
                    @endif
                </p>
            </div>
        @endif
    </div>
    
    @if($noticias->count() > 0)
        <div style="padding: 1.5rem; border-top: 1px solid #e0e0e0;">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <span class="text-muted">
                    Mostrando {{ $noticias->firstItem() ?? 0 }}-{{ $noticias->lastItem() ?? 0 }} de {{ $noticias->total() }} noticias
                </span>
                @if($noticias->hasPages())
                    <nav>
                        <ul class="pagination mb-0">
                            {{-- Botón Anterior --}}
                            @if($noticias->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link"><i class="bi bi-chevron-left"></i> Anterior</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $noticias->previousPageUrl() }}" rel="prev">
                                        <i class="bi bi-chevron-left"></i> Anterior
                                    </a>
                                </li>
                            @endif

                            {{-- Números de página --}}
                            @foreach($noticias->getUrlRange(1, $noticias->lastPage()) as $page => $url)
                                @if($page == $noticias->currentPage())
                                    <li class="page-item active">
                                        <span class="page-link">{{ $page }}</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endif
                            @endforeach

                            {{-- Botón Siguiente --}}
                            @if($noticias->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $noticias->nextPageUrl() }}" rel="next">
                                        Siguiente <i class="bi bi-chevron-right"></i>
                                    </a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <span class="page-link">Siguiente <i class="bi bi-chevron-right"></i></span>
                                </li>
                            @endif
                        </ul>
                    </nav>
                @endif
            </div>
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('filtroEstado').addEventListener('change', function() {
        document.getElementById('filtrosForm').submit();
    });

    function verNoticia(id) {
        window.location.href = '/admin/noticias/' + id;
    }

    function editarNoticia(id) {
        window.location.href = '/admin/noticias/' + id + '/edit';
    }

    function eliminarNoticia(id, titulo) {
        if (confirm('¿Estás seguro de que deseas eliminar la noticia:\n\n"' + titulo + '"?\n\nEsta acción no se puede deshacer.')) {

            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '/admin/noticias/' + id;
            

            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = '{{ csrf_token() }}';
            form.appendChild(csrfInput);
            

            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'DELETE';
            form.appendChild(methodInput);
            
            document.body.appendChild(form);
            form.submit();
        }
    }

    function toggleDestacar(id, btn) {
        const icon   = btn.querySelector('i');
        const activa = btn.classList.contains('destacada-activa');

        fetch(`/admin/noticias/${id}/destacar`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(res => res.json().then(data => ({ status: res.status, data })))
        .then(({ status, data }) => {
            if (status === 422) {
                mostrarToast(data.message, 'warning');
                return;
            }
            if (data.success) {
                if (data.destacada) {
                    btn.classList.add('destacada-activa');
                    btn.style.color       = '#f59e0b';
                    btn.style.borderColor = '#f59e0b';
                    btn.title = 'Quitar del carrusel';
                    icon.className = 'bi bi-star-fill';
                } else {
                    btn.classList.remove('destacada-activa');
                    btn.style.color       = '';
                    btn.style.borderColor = '';
                    btn.title = 'Destacar en carrusel';
                    icon.className = 'bi bi-star';
                }
                mostrarToast(data.message, 'success');
            }
        })
        .catch(() => mostrarToast('Error al procesar la solicitud.', 'error'));
    }

    function mostrarToast(mensaje, tipo) {
        const colores = {
            success: '#198754',
            warning: '#f59e0b',
            error:   '#dc3545'
        };
        const toast = document.createElement('div');
        toast.textContent = mensaje;
        Object.assign(toast.style, {
            position:     'fixed',
            bottom:       '2rem',
            right:        '2rem',
            background:   colores[tipo] || '#333',
            color:        '#fff',
            padding:      '0.85rem 1.4rem',
            borderRadius: '8px',
            fontSize:     '0.9rem',
            fontWeight:   '500',
            boxShadow:    '0 4px 12px rgba(0,0,0,0.2)',
            zIndex:       '9999',
            transition:   'opacity 0.4s ease'
        });
        document.body.appendChild(toast);
        setTimeout(() => { toast.style.opacity = '0'; }, 2800);
        setTimeout(() => toast.remove(), 3300);
    }
</script>
@endpush
