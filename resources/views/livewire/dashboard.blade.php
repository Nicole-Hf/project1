<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <div class="nav-wrapper position-relative end-0">
                            <ul class="nav nav-pills nav-fill p-1" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link mb-0 px-0 py-1 @if ($option) active @endif"
                                    wire:click="$set('option', true)" data-bs-toggle="tab" role="tab" aria-controls="projects" aria-selected="true">
                                        Mis proyectos
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mb-0 px-0 py-1 @if (!$option) active @endif" data-bs-toggle="tab"
                                    wire:click="$set('option', false)" role="tab" aria-controls="dashboard"
                                        >
                                        Mis colaboraciones
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-5 my-auto text-end">
                        @if ($option)
                        <button class="btn btn-primary mb-0" wire:click="$set('modalCreate', true)">Crear
                            proyecto</button>
                        @else
                        <button class="btn btn-secondary mb-0" wire:click="$set('modalUnirse', true)">Unirse a
                            un proyecto</button>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach ($projects as $project)
                    <div class="col-sm-3 mb-3 mb-sm-0">
                        <div class="card" style="width: 17rem; height: 15rem">
                            <img src="{{ asset('assets/img/boardback.png') }}" class="card-img-top" width="20"
                                height="100" alt="...">
                            <div class="card-header" style="padding: 0.7rem;">
                                <div class="row">
                                    <div class="col-10">
                                        <blockquote class="blockquote text-white mb-0">
                                            <p class="text-dark ms-3">{{ $project->title }}</p>
                                            <footer class="blockquote-footer text-info text-sm ms-3">
                                                {{ $project->user->name }}</footer>
                                        </blockquote>
                                    </div>
                                    @if ($option)
                                    <div class="col-2 my-auto text-end">
                                        <div class="dropdown float-lg-end pe-4">
                                            <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <i class="fa fa-ellipsis-v text-secondary"></i>
                                            </a>
                                            <ul class="dropdown-menu px-2 py-3 ms-sm-n4 ms-n5"
                                                aria-labelledby="dropdownTable">
                                                <li><a class="dropdown-item border-radius-md"
                                                        wire:click="showProject('{{ $project->id }}')">Ver
                                                        Participantes</a></li>
                                                <li><a class="dropdown-item border-radius-md"
                                                        wire:click="modalEdit('{{ $project->id }}')">Renombrar</a></li>
                                                <li>@if ($option)
                                                    <a class="dropdown-item border-radius-md"
                                                        wire:click="shareProject('{{ $project->code }}')">Compartir</a>
                                                    @endif
                                                </li>
                                                <li><a class="dropdown-item border-radius-md" style="color:#FF0000"
                                                        wire:click="modalEdit('{{ $project->id }}')">Eliminar
                                                        Proyecto</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body">
                                <a class="card-link"
                                href="http://localhost:8080/model-c4?room={{ $project->code }}&username={{ auth()->user()->token }}">Seguir editando</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @if ($modalCreate)
    <div class="modald">
        <div class="modald-contenido">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel">Crear proyecto</h4>
                    </div>
                    <div class="modal-body">
                        <h6>Nombre:</h6>
                        <input type="text" wire:model="title" class="form-control">
                        @if ($modalError)
                        <small class="text-danger">Campo Requerido</small>
                        @endif
                        <h6>Descripción:</h6>
                        <input type="text" wire:model="description" class="form-control">
                        @if ($modalError)
                        <small class="text-danger">Campo Requerido</small>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="cancel()">Cancelar</button>
                        <button type="button" class="btn btn-primary" wire:click="storeProject()">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if ($modalEdit)
    <div class="modald">
        <div class="modald-contenido">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel">Editar proyecto</h4>
                    </div>
                    <div class="modal-body">
                        <h6>Nombre:</h6>
                        <input type="text" wire:model="nombre" class="form-control">
                        @if ($modalError)
                        <small class="text-danger">Campo Requerido</small>
                        @endif
                        <h6>Descripción:</h6>
                        <input type="text" wire:model="descripcion" class="form-control">
                        @if ($modalError)
                        <small class="text-danger">Campo Requerido</small>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="cancel()">Cancelar</button>
                        <button type="button" class="btn btn-primary" wire:click="updateProject()">Actualizar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if ($modalDestroy)
    <div class="modald">
        <div class="modald-contenido">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="card-header">
                        <div class="d-flex align-items-center text-center justify-content-center">
                            <h5>¿Eliminar este proyecto?</h5>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div align="center">
                            <button type="button" class="btn btn-secondary btn-sm my-2 mx-2"
                                wire:click="cancel()">Cancelar</button>
                            <button wire:click="destroyProject()"
                                class="btn btn-danger btn-sm my-2 mx-2">Eliminar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if ($modalUsers)
    <div class="modald">
        <div class="modald-contenido">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel"><b>Usuarios Agregados</b></h4>
                    </div>
                    <div class="modal-body">
                        @foreach ($users as $user)
                        <div class="row my-2">
                            <div class="col-8">
                                <h5>- {{ $user->name }}</h5>
                            </div>
                            <div align="right" class="col-4">
                                <button wire:click="destroyProyectouser('{{ $user->id }}','{{ $user->project_id }}')"
                                    class="boton">
                                    <img class="img" src="{{ asset('img/salir.png') }}">
                                </button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="cancel()">Volver</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if ($modalJoin)
    <div class="modald">
        <div class="modald-contenido">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Unirse a un proyecto</h5>
                    </div>
                    <div class="modal-body">
                        <h4>Código del proyecto:</h4>
                        <input type="text" wire:model="code" placeholder="Ingresa el código del proyecto"
                            class="form-control">
                        @if ($modalError)
                        <small class="text-danger">
                            @if ($registered)
                            Ya formas parte de este proyecto.
                            @else
                            Campo Requerido.
                            @endif
                        </small>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="cancel()">Cancelar</button>
                        <button type="button" class="btn btn-primary" wire:click="joinProject()">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if ($modalShare)
    <div class="modald">
        <div class="modald-contenido">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Código del proyecto</h5>
                        <button type="button" class="btn-close" wire:click="cancel()"></button>
                    </div>
                    <div class="modal-body">
                        <div class="m-0 row justify-content-center">
                            <div class="col-8 text-center">
                                <p id="joinLink" style="width: 100%" wire:model="code" class="form-control">
                                    {{ $code }}</p>
                            </div>
                            <div class="col-auto text-center">
                                <input type="button" class="btn btn-primary" onclick="copyLink()" data-toggle="tooltip"
                                    title="Copy to Clipboard" value="Copy Link" readonly />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <script>
        function copyLink() {
            let copyText1 = document.getElementById("joinLink")
            console.log(copyText1);
            var selection = window.getSelection();
            var range = document.createRange();
            range.selectNodeContents(copyText1);
            selection.removeAllRanges();
            selection.addRange(range);
            document.execCommand('copy');
        }
    </script>
</main>
