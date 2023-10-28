<x-app-layout>
    <div class="nk-content-wrap">
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h3 class="nk-block-title page-title">
                        @if(isset($category))
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
                <form action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @isset($category)
                        @method('PUT')
                    @endisset
                    <div class="row">
                        <x-admin.forms.input id="name" title="Nome" :value="isset($category) ? $category->name : null" :mandatory="true"/>
                        <x-admin.forms.input id="status" switchLabel="Marque para ativar" :value="isset($category) ? $category->status : null" type="switch"/>
                    </div>
                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-lg btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
