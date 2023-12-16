<section class="main-section bg-cor-fundo">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 col-md-6">
                <h1>O fardo pesado que levas, deságua na força que tens.</h1>
                <p>Você gostaria de receber as nossas mensagens semanais?</p>
                <form id="email-form" action="#" method="post">
                    <input type="email" id="email" name="email" class="text-field-2"
                           placeholder="Digite seu e-mail" required aria-label="Endereço de Email" />
                    <button type="submit">Inscrever-se</button>
                </form>
            </div>
            <div class="col-6 d-none d-md-flex justify-content-center">
{{--                <img src="{{ asset('assets/images/stitch-sorvete.png') }}" alt="logo">--}}
            </div>
        </div>
    </div>
</section>


@section('script')
    @parent
    @vite('resources/js/portal/subscriber.js')
@endsection
