<x-app-layout>
    <div class="nk-content-wrap">
        <div class="nk-block nk-block-lg">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">E-books</h3>
                        <div class="nk-block-des text-soft">
                            <p>Listagem dos registros de e-books.</p>
                        </div>
                    </div>
                    <div class="nk-block-head-content">
                        <div class="toggle-wrap nk-block-tools-toggle">
                            @can('ebooks.create')
                                <a href="{{ route('ebooks.create') }}" class="btn btn-primary">
                                    <i class="icon bi bi-plus me-1"></i>
                                   Novo e-book
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
                                <th class="nk-tb-col"><span class="sub-text">Título</span></th>
                                <th class="nk-tb-col"><span class="sub-text">Autor</span></th>
                                <th class="nk-tb-col"><span class="sub-text">Data de publicação</span></th>
                                <th class="nk-tb-col tb-col-md"><span class="sub-text">Status</span></th>
                                @canany(['ebooks.edit', 'ebooks.destroy'])
                                    <th class="nk-tb-col tb-col-md nk-tb-col-tools text-center">Ações</th>
                                @endcanany
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ebooks as $ebook)
                                <tr class="nk-tb-item" id="item-{{$ebook->id}}">
                                    <td class="nk-tb-col nk-tb-col-check">
                                        <div class="custom-control custom-control-sm custom-checkbox notext">
                                            <input type="checkbox" class="custom-control-input" id="{{ $ebook->id }}">
                                            <label class="custom-control-label" for="{{ $ebook->id }}"></label>
                                        </div>
                                    </td>
                                    <td class="nk-tb-col">
                                        <span class="tb-lead">{{ $ebook->title }}</span>
                                    </td>
                                    <td class="nk-tb-col">
                                        <span class="tb-lead">{{ $ebook->author }}</span>
                                    </td>
                                    <td class="nk-tb-col tb-col-md">
                                        <span>{{ convertDateToBR($ebook->publication_date) }}</span>
                                    </td>
                                    <td class="nk-tb-col tb-col-md">
                                        <span class="tb-status">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input switch" id="status-{{$ebook->id}}" value="{{$ebook->id}}" @if($ebook->status) checked @endif>
                                                <label class="custom-control-label" for="status-{{$ebook->id}}"></label>
                                            </div>
                                        </span>
                                    </td>
                                    @canany(['ebooks.edit', 'ebooks.destroy'])
                                        <td class="nk-tb-col tb-col-md text-center">
                                            <div class="dropdown">
                                                <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown" data-offset="-8,0" aria-expanded="false">
                                                    <em class="icon ni ni-more-h"></em>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs" style="">
                                                    <ul class="link-list-plain">
                                                        @can('ebooks.edit')
                                                            <li><a href="{{ route('ebooks.edit', $ebook->id) }}" class="text-primary">Editar</a></li>
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
                    title: status ? 'Ativar e-book?' : 'Inativar e-book?',
                    text: "Você poderá reverter isso!",
                    icon: 'warning',
                    cancelButtonText: 'Cancelar',
                    showCancelButton: true,
                    confirmButtonText: status ? 'Sim, ative-o!' : 'Sim, desative-o!',
                    showLoaderOnConfirm: true,
                    preConfirm: async function preConfirm() {
                        const response = await myFetch('/admin/ebooks/state', 'POST', {
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
                            ? Swal.fire('Ativado!', 'O e-book será exibido no site.', 'success')
                            : Swal.fire('Desativado!', 'O e-book não será exibido no site.', 'success');
                    }else{
                        element.checked = !status;
                    }
                });
            }
        </script>
    @endsection
</x-app-layout>
