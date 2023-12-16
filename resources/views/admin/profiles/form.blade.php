<x-app-layout>
    <div class="nk-content-wrap">
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h3 class="nk-block-title page-title">
                        @if(isset($role))
                            Editar postagem
                        @else
                            Cadastrar postagem
                        @endif
                    </h3>
                    <div class="nk-block-des text-soft">
                        <p>Preencha os campos do formulário com as informações.</p>
                    </div>
                </div>
                <div class="nk-block-head-content">

                </div>
            </div>
            <x-admin.forms.alert/>
        </div>

        <div class="card card-bordered">
            <div class="card-inner">
                <form action="{{ isset($role) ? route('profiles.update', $role->id) : route('profiles.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @isset($role)
                        @method('PUT')
                    @endisset
                    <div class="row">
                        <x-admin.forms.input id="name" title="Nome" :value="isset($role) ? $role->name : null" :mandatory="true"/>

                        <div class="d-flex align-items-center mt-4 mb-3 justify-content-between">
                            <h6>Permissões do Perfil</h6>
                            <button type="button" id="checkAll" class="btn btn-primary btn-sm">Marcar Todas</button>
                        </div>
                        <table class="table mx-2">
                            <thead>
                            <tr>
                                <th scope="col">
                                    Módulo
                                </th>
                                <th scope="col">
                                    Listar
                                    <input type="checkbox" id="listAll" />
                                </th>
                                <th scope="col">
                                    Cadastrar
                                    <input type="checkbox" id="createAll" />
                                </th>
                                <th scope="col">
                                    Editar
                                    <input type="checkbox" id="editAll" />
                                </th>
                                <th scope="col">
                                    Deletar
                                    <input type="checkbox" id="deleteAll" />
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($resources as $resource)
                                <tr>
                                    <td>{{ $resource->name }}</td>
                                    <td>
                                        <div class="form-check m-2 list">
                                            <x-admin.forms.input id="{{ $resource->slug }}.index"
                                                value='{{ isset($role) ? $role->hasPermissionTo("$resource->slug.index") : 0 }}' type="checkbox"/>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check m-2 create">
                                            <x-admin.forms.input id="{{ $resource->slug }}.create"
                                                value='{{ isset($role) ? $role->hasPermissionTo("$resource->slug.create") : 0 }}' type="checkbox"/>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check m-2 edit">
                                            <x-admin.forms.input id="{{ $resource->slug }}.edit"
                                                value='{{ isset($role) ? $role->hasPermissionTo("$resource->slug.edit") : 0 }}' type="checkbox"/>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check m-2 delete">
                                            <x-admin.forms.input id="{{ $resource->slug }}.destroy"
                                                 value='{{ isset($role) ? $role->hasPermissionTo("$resource->slug.destroy") : 0 }}' type="checkbox"/>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-lg btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @section('script')
        @parent
        <script src="{{ url('assets/js/checkAll.js') }}"></script>
    @endsection
</x-app-layout>
