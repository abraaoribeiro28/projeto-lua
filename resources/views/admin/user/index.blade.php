<x-app-layout>
    <div class="nk-content-wrap">
        <div class="nk-block nk-block-lg">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Usuários</h3>
                        <div class="nk-block-des text-soft">
                            <p>Listagem dos registros de usuários.</p>
                        </div>
                    </div>
                    <div class="nk-block-head-content">
                        <div class="toggle-wrap nk-block-tools-toggle">
                            @can('usuarios.create')
                                <a href="{{ route('users.create') }}" class="btn btn-primary">
                                    <i class="icon bi bi-plus me-1"></i>
                                   Novo usuário
                                </a>
                            @endcan
                        </div>
                    </div>
                </div>
                <x-admin.forms.alert/>
            </div>


            <div class="card card-bordered card-preview">
                <div class="card-inner">
                    <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                        <thead>
                            <tr class="nk-tb-item nk-tb-head">
                                <th class="nk-tb-col nk-tb-col-check">
                                    <div class="custom-control custom-control-sm custom-checkbox notext">
                                        <input type="checkbox" class="custom-control-input" id="uid">
                                        <label class="custom-control-label" for="uid"></label>
                                    </div>
                                </th>
                                <th class="nk-tb-col"><span class="sub-text">Usuário</span></th>
                                <th class="nk-tb-col"><span class="sub-text">Perfis</span></th>
                                <th class="nk-tb-col tb-col-mb"><span class="sub-text">Último login</span></th>
                                <th class="nk-tb-col tb-col-md"><span class="sub-text">Status</span></th>
                                @canany(['usuarios.edit', 'usuarios.destroy'])
                                    <th class="nk-tb-col tb-col-md nk-tb-col-tools text-center">Ações</th>
                                @endcanany
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr class="nk-tb-item" id="item-{{$user->id}}">
                                    <td class="nk-tb-col nk-tb-col-check">
                                        <div class="custom-control custom-control-sm custom-checkbox notext">
                                            <input type="checkbox" class="custom-control-input" id="{{ $user->id }}">
                                            <label class="custom-control-label" for="{{ $user->id }}"></label>
                                        </div>
                                    </td>
                                    <td class="nk-tb-col">
                                        <div class="user-card">
                                            <div class="user-avatar bg-primary">
                                                <span>
                                                    {{ getProfileInitials($user->name) }}
                                                </span>
                                            </div>
                                            <div class="user-info">
                                                <span class="tb-lead">{{ $user->name }}<span class="dot dot-success d-md-none ms-1"></span></span>
                                                <span>{{ $user->email }}</span>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="nk-tb-col tb-col-mb">
                                        @foreach($user->getRoleNames() as $role)
                                            <span class="badge bg-secondary">{{ $role }}</span>
                                        @endforeach
                                    </td>

                                    <td class="nk-tb-col tb-col-mb">
                                        @if($user->last_login)
                                            <span>{{ date('d/m/Y', strtotime($user->last_login)) }}</span>
                                        @else
                                            <span>{{ 'Nenhum login encontrado' }}</span>
                                        @endif
                                    </td>

                                    <td class="nk-tb-col tb-col-md">
                                        <span class="tb-status">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input switch" id="status-{{$user->id}}"
                                                       value="{{$user->id}}" @if($user->status) checked @endif
                                                       @cannot('usuarios.edit') disabled @endcannot>
                                                <label class="custom-control-label" for="status-{{$user->id}}"
                                                       @cannot('usuarios.edit') style="cursor: not-allowed;" @endcannot>
                                                </label>
                                            </div>
                                        </span>
                                    </td>

                                    @canany(['usuarios.edit', 'usuarios.destroy'])
                                        <td class="nk-tb-col tb-col-md text-center">
                                            <div class="dropdown">
                                                <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown" data-offset="-8,0" aria-expanded="false">
                                                    <em class="icon ni ni-more-h"></em>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs" style="">
                                                    <ul class="link-list-plain">
                                                        @can('usuarios.edit')
                                                            <li><a href="{{ route('users.edit', $user->id) }}" class="text-primary">Editar</a></li>
                                                        @endcan
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    @endcanany
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @section('script')
        @parent
        <script>
            const switchElement = document.querySelectorAll('.switch');

            switchElement.forEach(element => {
                 element.onchange = () => {
                     element.checked
                         ? toggleUserActiveState(element.value, 1, element)
                         : toggleUserActiveState(element.value, 0, element);
                 };
            });

            async function toggleUserActiveState(id, status, element){
                const item = document.querySelector(`#item-${id}`);

                Swal.fire({
                    title: status ? 'Ativar usuário?' : 'Inativar usuário?',
                    text: "Você poderá reverter isso!",
                    icon: 'warning',
                    cancelButtonText: 'Cancelar',
                    showCancelButton: true,
                    confirmButtonText: status ? 'Sim, ative-o!' : 'Sim, desative-o!',
                    showLoaderOnConfirm: true,
                    preConfirm: async function preConfirm() {
                        const response = await myFetch('/admin/users/state', 'POST', {
                            "id": id,
                            "status": status,
                        });
                        if (response !== 1){
                            Swal.showValidationMessage("Ocorreu um erro inesperado. Por favor, tente novamente.");
                        }
                    },
                    allowOutsideClick: function allowOutsideClick() {
                        return !Swal.isLoading();
                    }
                }).then(function (response) {
                    if (response.isConfirmed) {
                        status
                            ? Swal.fire('Ativado!', 'O usuário poderá efetuar login.', 'success')
                            : Swal.fire('Desativado!', 'O usuário não poderá efetuar login.', 'success');
                    }else{
                        element.checked = !status;
                    }
                });
            }
        </script>
    @endsection
</x-app-layout>
