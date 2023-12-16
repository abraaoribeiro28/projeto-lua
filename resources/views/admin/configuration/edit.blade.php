<x-app-layout>
    <div class="nk-content-wrap">
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h3 class="nk-block-title page-title">Configurações do site</h3>
                    <div class="nk-block-des text-soft">
                        <p>Preencha os campos do formulário com as informações.</p>
                    </div>
                </div>
                <div class="nk-block-head-content">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link @if(old('tab') == 'tab-info' || empty(old('tab'))) active @endif"
                               data-bs-toggle="tab" href="#tab-info">
                                <i class="icon bi bi-info-circle"></i>
                                <span>Informações</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(old('tab') == 'tab-incorp') active @endif"
                               data-bs-toggle="tab" href="#tab-incorp">
                                <i class="icon bi bi-code-slash"></i>
                                <span>Incorporação</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(old('tab') == 'tab-img') active @endif"
                               data-bs-toggle="tab" href="#tab-img">
                                <i class="icon bi bi-images"></i>
                                <span>Imagens</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(old('tab') == 'tab-option') active @endif"
                               data-bs-toggle="tab" href="#tab-option">
                                <i class="icon bi bi-gear"></i>
                                <span>Opções</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <x-admin.forms.alert/>
        </div>

        <div class="card card-bordered">
            <div class="card-inner">
                <form action="{{ route('configurations.update', 1) }}" method="POST" enctype="multipart/form-data" class="gy-3">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="tab" id="input-tab" value="{{ old('tab') ?? 'tab-info'}}">
                    <div class="tab-content">
                        <div class="tab-pane @if(old('tab') == 'tab-info' || empty(old('tab'))) active @endif" id="tab-info">
                            <x-admin.forms.configuration.input-text id="titulo" :dataArray="$config['titulo']" :mandatory="true"/>
                            <x-admin.forms.configuration.textarea id="descricao" :dataArray="$config['descricao']" :mandatory="true"/>
                            <x-admin.forms.configuration.input-text id="copyright" :dataArray="$config['copyright']" :mandatory="true"/>
                            <x-admin.forms.configuration.input-text id="email" :dataArray="$config['email']" :mandatory="true"/>
                            <x-admin.forms.configuration.input-text id="telefone" :dataArray="$config['telefone']" mask="phone"/>
                        </div>
                        <div class="tab-pane @if(old('tab') == 'tab-incorp') active @endif" id="tab-incorp">
                            <x-admin.forms.configuration.textarea id="incorporacao_cabecalho" :dataArray="$config['incorporacao_cabecalho']"/>
                            <x-admin.forms.configuration.textarea id="incorporacao_rodape" :dataArray="$config['incorporacao_rodape']"/>
                        </div>
                        <div class="tab-pane @if(old('tab') == 'tab-img') active @endif" id="tab-img">
                            <x-admin.forms.configuration.input-file id="logo" :dataArray="$config['logo']"/>
                            <x-admin.forms.configuration.input-file id="favicon" :dataArray="$config['favicon']"/>
                            <x-admin.forms.configuration.input-file id="logo_radape" :dataArray="$config['logo_radape']"/>
                        </div>
                        <div class="tab-pane @if(old('tab') == 'tab-option') active @endif" id="tab-option">
                            <x-admin.forms.configuration.input-switch id="manutencao" :dataArray="$config['manutencao']"/>
                            <x-admin.forms.configuration.input-switch id="exibir_versao" :dataArray="$config['exibir_versao']"/>
                            <x-admin.forms.configuration.input-text  id="cor_principal" :dataArray="$config['cor_principal']" :haveColor="true" :mandatory="true"/>
                            <x-admin.forms.configuration.input-text  id="cor_titulos" :dataArray="$config['cor_titulos']" :haveColor="true" :mandatory="true"/>
                            <x-admin.forms.configuration.input-text  id="cor_botoes" :dataArray="$config['cor_botoes']" :haveColor="true" :mandatory="true"/>
                            <x-admin.forms.configuration.input-text  id="cor_fundo" :dataArray="$config['cor_fundo']" :haveColor="true" :mandatory="true"/>
                        </div>
                    </div>

                    <div class="form-group mt-2">
                        <button type="submit" class="btn btn-lg btn-primary">Atualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @section('script')
        @parent
        <script>
            // Salvando último tab clicado
            const tabs = document.querySelectorAll('.nav-tabs .nav-link');
            const inputTab = document.querySelector('#input-tab');

            tabs.forEach(element => element.onclick = () => {
                inputTab.value = element.getAttribute('href').replace('#', '');
            })

            // exibindo imagem selecionada
            const inputsFile = document.querySelectorAll('.form-file-input');

            inputsFile.forEach(element => {
                element.onchange = () => {
                    const file = element.files[0];
                    const reader = new FileReader();

                    reader.onload = () => {
                        const img = document.getElementById('image-' + element.id);
                        img.src = reader.result;
                    }

                    reader.readAsDataURL(file);
                }
            });
        </script>
    @endsection
</x-app-layout>
