<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-11 col-md-6 mb-md-0 mb-4">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="row">
                            <div class="col-lg-6 col-7">
                                <h6>Proyectos</h6>
                                {{--<p class="text-sm mb-0">
                                    <i class="fa fa-check text-info" aria-hidden="true"></i>
                                    @php
                                    use App\Models\Project;
                                    $cant_projects = Project::count()->where("user_id", auth()->user()->id);
                                    @endphp
                                    <span class="font-weight-bold ms-1">{{ $cant_projects}} done</span>
                                </p>--}}
                            </div>
                            <div class="col-lg-6 col-5 my-auto text-end">
                                @if ($option)
                                <button class="btn btn-primary btn-lg" wire:click="$set('modalCreate', true)">Crear
                                    proyecto</button>
                                @else
                                <button class="btn btn-secondary btn-lg" wire:click="$set('modalUnirse', true)">Unirse a
                                    un proyecto</button>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($projects as $project)
                            <div class="col-sm-3 mb-3 mb-sm-0">
                                <div class="card" style="width: 17rem; height: 17rem">
                                    <img src="{{ asset('assets/img/boardback.png') }}" class="card-img-top" width="20"
                                        height="100" alt="...">
                                    <div class="card-body">
                                        <figure>
                                            <blockquote class="blockquote">
                                                <p> {{ $project->title }}</p>
                                            </blockquote>
                                            <figcaption class="blockquote-footer">
                                                <cite title="Source Title">{{ $project->user->name }}</cite>
                                            </figcaption>
                                        </figure>

                                        @if ($option)
                                        <button wire:click="showProject('{{ $project->id }}')"
                                            class="btn btn-outline-secondary"
                                            style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem;">
                                            <img class="img" src="{{ asset('assets/img/grupo.png') }}" width="22"
                                                height="22">
                                        </button>
                                        <button wire:click="modalEdit('{{ $project->id }}')"
                                            class="btn btn-outline-secondary">
                                            <img class="img" src="{{ asset('assets/img/lapiz.png') }}" width="22"
                                                height="22">
                                        </button>
                                        <button wire:click="modalDestroy('{{ $project->id }}')"
                                            class="btn btn-outline-secondary">
                                            <img class="img" src="{{ asset('assets/img/delete.png') }}" width="22"
                                                height="22">
                                        </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
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
</main>
