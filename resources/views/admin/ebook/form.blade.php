<x-app-layout>
    <div class="nk-content-wrap">
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h3 class="nk-block-title page-title">
                        @if(isset($ebook))
                            Editar e-book
                        @else
                            Cadastrar e-book
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
                <form action="{{ isset($ebook) ? route('ebooks.update', $ebook->id) : route('ebooks.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @isset($ebook)
                        @method('PUT')
                    @endisset
                    <div class="row">
                        <x-admin.forms.input id="title" title="Título" :value="isset($ebook) ? $ebook->title : null" :mandatory="true"/>
                        <x-admin.forms.input id="author" title="Autor" :value="isset($ebook) ? $ebook->author : null" :mandatory="true" cols="6"/>
                        <x-admin.forms.input id="publication_date" title="Data de publicação" :value="isset($ebook) ? $ebook->publication_date : null" type="date" :mandatory="true" cols="6"/>
                        <div class="col-md-6 mb-3 d-flex align-items-end">
                            <div class="form-group w-100">
                                <label class="form-label" for="customFileLabel">
                                    E-book
                                    <span class="text-danger fw-bold">*</span>
                                </label>
                                <div class="form-control-wrap">
                                    <div class="form-file">
                                        <input type="file" accept="application/pdf" class="form-file-input" id="customFile" name="ebook">
                                        <label class="form-file-label" for="customFile">Selecione o arquivo</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <x-admin.forms.input id="highlight" title="Capa do e-book" :value="isset($highlight) ? $highlight->path : null" type="highlight" cols="6"/>
                        <x-admin.forms.input id="resume" title="Resumo" :value="isset($ebook) ? $ebook->resume : null" type="summernote" :mandatory="true"/>
                        <x-admin.forms.input id="status" switchLabel="Marque para ativar" :value="isset($ebook) ? $ebook->status : null" type="switch"/>
                    </div>
                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-lg btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @section('style')
        @parent
        <link rel="stylesheet" href="{{ url('theme/src/assets/css/editors/summernote.css') }}">
    @endsection

    @section('script')
        @parent
        <script src="{{ url('theme/src/assets/js/libs/editors/summernote.js') }}"></script>
        <script src="{{ url('theme/src/assets/js/editors.js') }}"></script>

        <script defer>
            $(document).ready(function() {
                $('#summernote').summernote({
                    height: 150
                });
            });


            const ebook = @json($ebook ?? null);
            let highlight = @json($highlight ?? false);

            const selectFile = document.querySelector('#select-file');
            const inputHighlight = document.querySelector('#highlight');
            const imageHighlight = document.querySelector('#image-highlight');
            const removeHighlight = document.querySelector('#remove-highlight');

            selectFile.onclick = () => {
                inputHighlight.click();
            }

            inputHighlight.onchange = () => {
                if (inputHighlight.files[0]) {
                    const reader = new FileReader();
                    reader.onload = () => {
                        imageHighlight.src = reader.result;
                    }
                    reader.readAsDataURL(inputHighlight.files[0]);
                    removeHighlight.classList.remove('d-none');
                }
            }

            removeHighlight.addEventListener('click', async _ => {
                if(ebook && highlight){
                    resultado = await myFetch('/admin/delete-highlight', 'POST', {
                        "id": ebook.id,
                        "column": 'ebook_id'
                    });
                    highlight = false;
                }
                imageHighlight.src = window.location.origin + '/assets/images/sem-imagem.jpg';
                removeHighlight.classList.add('d-none');
            });
        </script>
    @endsection
</x-app-layout>
