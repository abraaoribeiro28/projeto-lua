<x-app-layout>
    <div class="nk-content-wrap">
        <div class="nk-block nk-block-lg">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Menus do site</h3>
                        <div class="nk-block-des text-soft">
                            <p>Listagem dos registros de menus do site.</p>
                        </div>
                    </div>
                    <div class="nk-block-head-content">
                        <div class="toggle-wrap nk-block-tools-toggle">
                            @can('menus.create')
                                <a href="{{ route('menus.create') }}" class="btn btn-primary">
                                    <i class="icon bi bi-plus me-1"></i>
                                    Novo Menu
                                </a>
                            @endcan
                        </div>
                    </div>
                </div>
                <x-admin.forms.alert/>
            </div>

            <div class="card card-bordered card-preview">
                <div class="card-inner">
                     @include('components.admin.menu-list', ['menus' => $menus, 'level' => 0])
                </div>
            </div>
        </div>
    </div>

    <div class="preloader d-none">
        <div class="spinner"></div>
    </div>

@section('script')
        @parent
        <script defer src="{{ asset('assets/modules/sortable/sortable.min.js') }}"></script>
        <script defer src="{{ asset('assets/js/menu.js') }}"></script>

        <script>
            async function confirmDelete(id){
                const item = document.querySelector('#item-'+id);

                Swal.fire({
                    title: 'Tem certeza?',
                    text: "Você não poderá reverter isso!",
                    icon: 'warning',
                    cancelButtonText: 'Cancelar',
                    showCancelButton: true,
                    confirmButtonText: 'Sim, exclua-o!',
                    showLoaderOnConfirm: true,
                    preConfirm: async function preConfirm() {
                        const response = await myFetch('/admin/menus/delete', 'POST', {
                            "id": id
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
                        item.remove();
                        Swal.fire('Excluído!', 'O registro foi excluído.', 'success');
                    }
                });
            }
        </script>
    @endsection
</x-app-layout>
