@extends('layouts.admin')
@section('title', 'Nueva Noticia')
@section('content')
<div class="page-header">
    <h1>Nueva Noticia</h1>
    <p>Crea una nueva noticia para la facultad de Ingeniería de Sistemas</p>
</div>
<form id="noticiaForm" method="POST" action="{{ route('admin.noticias.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="form-card">
                <h3 class="mb-4">Información de la Noticia</h3>

                {{-- TÍTULO --}}
                <div class="form-group-admin" style="border: 1.5px solid #e0e0e0; border-radius: 12px; padding: 1rem; background: #fafafa;">
                    <label for="titulo">Título *</label>
                    <div id="titulo-toolbar" style="border: 1.5px solid #e0e0e0; border-bottom: none; border-radius: 10px 10px 0 0; background: #f8f9fa; padding: 6px 12px; display: flex; gap: 4px; align-items: center;">
                        <button class="ql-bold" title="Negrita"></button>
                        <button class="ql-italic" title="Cursiva"></button>
                        <button class="ql-underline" title="Subrayado"></button>
                        <span style="width:1px; height:22px; background:#ddd; margin: 0 6px;"></span>
                        <select class="ql-color" title="Color de texto"></select>
                    </div>
                    <div id="quill-titulo" style="border: 1.5px solid #e0e0e0; border-radius: 0 0 10px 10px; background: white; font-size: 1.1rem; min-height: 52px; max-height: 52px; overflow: hidden;"></div>
                    <input type="hidden" name="titulo" id="titulo">
                    @error('titulo')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- CATEGORÍA --}}
                <div class="form-group-admin">
                    <label for="categoria">Categoría *</label>
                    <select class="form-control-admin @error('categoria') is-invalid @enderror" id="categoria" name="categoria" required>
                        <option value="">Selecciona una categoría</option>
                        <option value="Actas" {{ old('categoria') == 'Actas' ? 'selected' : '' }}>Actas</option>
                        <option value="Inscripciones" {{ old('categoria') == 'Inscripciones' ? 'selected' : '' }}>Inscripciones</option>
                        <option value="Comité" {{ old('categoria') == 'Comité' ? 'selected' : '' }}>Comité</option>
                        <option value="Estudiantes" {{ old('categoria') == 'Estudiantes' ? 'selected' : '' }}>Estudiantes</option>
                        <option value="Docentes" {{ old('categoria') == 'Docentes' ? 'selected' : '' }}>Docentes</option>
                        <option value="Investigación" {{ old('categoria') == 'Investigación' ? 'selected' : '' }}>Investigación</option>
                        <option value="Capacitación" {{ old('categoria') == 'Capacitación' ? 'selected' : '' }}>Capacitación</option>
                        <option value="Banco de ideas" {{ old('categoria') == 'Banco de ideas' ? 'selected' : '' }}>Banco de ideas</option>
                    </select>
                    @error('categoria')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- DESCRIPCIÓN --}}
                <div class="form-group-admin" style="border: 1.5px solid #e0e0e0; border-radius: 12px; padding: 1rem; background: #fafafa;">
                    <label for="descripcion">Descripción Corta *</label>
                    <div id="descripcion-toolbar" style="border: 1.5px solid #e0e0e0; border-bottom: none; border-radius: 10px 10px 0 0; background: #f8f9fa; padding: 6px 12px; display: flex; gap: 4px; align-items: center;">
                        <button class="ql-bold" title="Negrita"></button>
                        <button class="ql-italic" title="Cursiva"></button>
                        <button class="ql-underline" title="Subrayado"></button>
                        <span style="width:1px; height:22px; background:#ddd; margin: 0 6px;"></span>
                        <select class="ql-color" title="Color de texto"></select>
                    </div>
                    <div id="quill-descripcion" style="border: 1.5px solid #e0e0e0; border-radius: 0 0 10px 10px; background: white; font-size: 1rem; min-height: 90px; max-height: 90px; overflow-y: auto;"></div>
                    <input type="hidden" name="descripcion" id="descripcion">
                    <small class="text-muted">Máximo 200 caracteres</small>
                    @error('descripcion')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- CONTENIDO --}}
                <div class="form-group-admin" style="border: 1.5px solid #e0e0e0; border-radius: 12px; padding: 1rem; background: #fafafa;">
                    <label for="contenido">Contenido Completo *</label>
                    <div id="quill-toolbar" style="border: 1.5px solid #e0e0e0; border-bottom: none; border-radius: 10px 10px 0 0; background: #f8f9fa; padding: 8px 12px; display: flex; flex-wrap: wrap; gap: 4px; align-items: center;">
                        <button class="ql-bold" title="Negrita"></button>
                        <button class="ql-italic" title="Cursiva"></button>
                        <button class="ql-underline" title="Subrayado"></button>
                        <span style="width:1px; height:22px; background:#ddd; margin: 0 6px;"></span>
                        <button class="ql-list" value="ordered" title="Lista numerada"></button>
                        <button class="ql-list" value="bullet" title="Lista con viñetas"></button>
                        <span style="width:1px; height:22px; background:#ddd; margin: 0 6px;"></span>
                        <select class="ql-header" title="Encabezado">
                            <option value="">Normal</option>
                            <option value="1">Título 1</option>
                            <option value="2">Título 2</option>
                            <option value="3">Título 3</option>
                        </select>
                        <span style="width:1px; height:22px; background:#ddd; margin: 0 6px;"></span>
                        <button class="ql-align" value="" title="Izquierda"></button>
                        <button class="ql-align" value="center" title="Centro"></button>
                        <button class="ql-align" value="right" title="Derecha"></button>
                        <button class="ql-align" value="justify" title="Justificado"></button>
                        <span style="width:1px; height:22px; background:#ddd; margin: 0 6px;"></span>
                        <select class="ql-color" title="Color de texto"></select>
                        <select class="ql-background" title="Color de fondo"></select>
                    </div>
                    <div id="quill-editor" style="border: 1.5px solid #e0e0e0; border-radius: 0 0 10px 10px; min-height: 280px; font-size: 1rem; background: white;"></div>
                    <input type="hidden" name="contenido" id="contenido">
                    @error('contenido')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

            </div>
        </div>

        <div class="col-lg-4">
            <div class="form-card mb-4">
                <h3 class="mb-4">Publicación</h3>
                <div class="form-group-admin">
                    <label for="fecha">Fecha de Publicación</label>
                    <input type="date" class="form-control-admin @error('fecha') is-invalid @enderror" id="fecha" name="fecha" value="{{ old('fecha', date('Y-m-d')) }}">
                    @error('fecha')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group-admin">
                    <label for="estado">Estado</label>
                    <select class="form-control-admin @error('estado') is-invalid @enderror" id="estado" name="estado">
                        <option value="borrador" {{ old('estado') == 'borrador' ? 'selected' : '' }}>Borrador</option>
                        <option value="publicada" {{ old('estado') == 'publicada' ? 'selected' : '' }}>Publicar</option>
                    </select>
                    @error('estado')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-grid gap-2 mt-4">
                    <button type="submit" class="btn-primary-admin">
                        <i class="bi bi-check-circle"></i> Guardar Noticia
                    </button>
                    <a href="{{ route('admin.noticias') }}" class="btn-secondary-admin">
                        <i class="bi bi-x-circle"></i> Cancelar
                    </a>
                </div>
            </div>

            <div class="form-card">
                <h3 class="mb-4">Imagen Destacada</h3>
                <div class="form-group-admin">
                    <div class="file-upload" id="fileUploadArea">
                        <input type="file" id="imagen" name="imagen" accept="image/*" style="display: none;" onchange="previewImage(event)">
                        <i class="bi bi-cloud-upload"></i>
                        <p class="mb-2"><strong>Click para subir imagen</strong></p>
                        <p class="text-muted small mb-0">o arrastra y suelta aquí</p>
                        <p class="text-muted small">PNG, JPG o WEBP (Máx. 5MB)</p>
                    </div>
                    @error('imagen')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                    <div id="imagePreview" style="display: none; margin-top: 1rem;">
                        <img id="previewImg" src="" alt="Preview" style="width: 100%; border-radius: 10px;">
                        <button type="button" class="btn-secondary-admin mt-2 w-100" onclick="removeImage()">
                            <i class="bi bi-trash"></i> Eliminar imagen
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection

@push('scripts')
{{-- ══ LIBRERÍAS QUILL ══ --}}
<link href="https://cdnjs.cloudflare.com/ajax/libs/quill/1.3.7/quill.snow.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/quill/1.3.7/quill.min.js"></script>

<style>
    #titulo-toolbar button,
    #descripcion-toolbar button,
    #quill-toolbar button {
        border: none;
        background: transparent;
        border-radius: 6px;
        width: 30px;
        height: 30px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background 0.2s;
        padding: 0;
    }

    #titulo-toolbar button:hover, #titulo-toolbar button.ql-active,
    #descripcion-toolbar button:hover, #descripcion-toolbar button.ql-active,
    #quill-toolbar button:hover, #quill-toolbar button.ql-active {
        background: #e8f5e9 !important;
    }

    #titulo-toolbar .ql-stroke,
    #descripcion-toolbar .ql-stroke,
    #quill-toolbar .ql-stroke { stroke: #444; }

    #titulo-toolbar button:hover .ql-stroke, #titulo-toolbar button.ql-active .ql-stroke,
    #descripcion-toolbar button:hover .ql-stroke, #descripcion-toolbar button.ql-active .ql-stroke,
    #quill-toolbar button:hover .ql-stroke, #quill-toolbar button.ql-active .ql-stroke {
        stroke: var(--uts-dark-green);
    }

    #titulo-toolbar select,
    #descripcion-toolbar select,
    #quill-toolbar select {
        border: 1px solid #ddd;
        border-radius: 6px;
        padding: 2px 4px;
        font-size: 0.85rem;
        background: white;
        cursor: pointer;
        height: 30px;
    }

    .ql-container.ql-snow,
    .ql-toolbar.ql-snow { border: none !important; }

    .ql-editor {
        font-size: 1rem;
        line-height: 1.7;
        padding: 12px 16px;
    }
</style>

<script>
    document.getElementById("fileUploadArea").addEventListener("click", function () {
        document.getElementById("imagen").click();
    });

    function previewImage(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById("previewImg").src = e.target.result;
                document.getElementById("imagePreview").style.display = "block";
                document.getElementById("fileUploadArea").style.display = "none";
            };
            reader.readAsDataURL(file);
        }
    }

    function removeImage() {
        document.getElementById("imagen").value = "";
        document.getElementById("imagePreview").style.display = "none";
        document.getElementById("fileUploadArea").style.display = "block";
    }

    const uploadArea = document.getElementById("fileUploadArea");

    ["dragenter", "dragover", "dragleave", "drop"].forEach((e) => {
        uploadArea.addEventListener(e, (ev) => { ev.preventDefault(); ev.stopPropagation(); }, false);
    });

    ["dragenter", "dragover"].forEach((e) => {
        uploadArea.addEventListener(e, () => {
            uploadArea.style.borderColor = "var(--uts-blue)";
            uploadArea.style.backgroundColor = "#f8f9fa";
        });
    });

    ["dragleave", "drop"].forEach((e) => {
        uploadArea.addEventListener(e, () => {
            uploadArea.style.borderColor = "#e0e0e0";
            uploadArea.style.backgroundColor = "transparent";
        });
    });

    uploadArea.addEventListener("drop", function (e) {
        const files = e.dataTransfer.files;
        if (files.length) {
            document.getElementById("imagen").files = files;
            previewImage({ target: { files } });
        }
    });

    var quillTitulo = new Quill('#quill-titulo', {
        theme: 'snow',
        modules: { toolbar: '#titulo-toolbar' },
        placeholder: 'Escribe el título de la noticia...'
    });

    @if(old('titulo'))
        quillTitulo.root.innerHTML = {!! json_encode(old('titulo')) !!};
    @endif

    var quillDescripcion = new Quill('#quill-descripcion', {
        theme: 'snow',
        modules: { toolbar: '#descripcion-toolbar' },
        placeholder: 'Escribe una descripción breve...'
    });

    @if(old('descripcion'))
        quillDescripcion.root.innerHTML = {!! json_encode(old('descripcion')) !!};
    @endif

    quillDescripcion.on('text-change', function () {
        if (quillDescripcion.getText().length > 201) {
            quillDescripcion.deleteText(200, quillDescripcion.getText().length);
        }
    });

    var quill = new Quill('#quill-editor', {
        theme: 'snow',
        modules: { toolbar: '#quill-toolbar' },
        placeholder: 'Escribe el contenido completo de la noticia...'
    });

    @if(old('contenido'))
        quill.root.innerHTML = {!! json_encode(old('contenido')) !!};
    @endif

    document.getElementById('noticiaForm').addEventListener('submit', function () {
        document.getElementById('titulo').value      = quillTitulo.root.innerHTML;
        document.getElementById('descripcion').value = quillDescripcion.root.innerHTML;
        document.getElementById('contenido').value   = quill.root.innerHTML;
    });
</script>
@endpush
