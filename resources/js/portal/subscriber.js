document.addEventListener('DOMContentLoaded', function() {
    const emailInput = document.querySelector('#email');
    const form = document.querySelector('#email-form');
    const submitButton = form.querySelector('button[type="submit"]');

    form.onsubmit = async event => {
        event.preventDefault();
        submitButton.disabled = true;

        if(validateEmail(emailInput.value)){
            try {
                const data = { email: emailInput.value };
                const response = await myFetch('/ajax-subscribe', 'POST', data);

                if(response.success){
                    createToast(response.success)
                    const toast = new bootstrap.Toast('.toast', {
                        animation: true,
                        delay: 5000
                    });
                    toast.show();
                    emailInput.value = '';
                }else if (response.warning){
                    simpleAlert(
                        response.warning,
                        'Este e-mail já está inscrito para receber nossas mensagens semanais.',
                        'info'
                    );
                }else{
                    simpleAlert(
                        'Oops! Algo deu errado...',
                        'Por favor, tente novamente. Se o problema persistir, entre em contato com o suporte.'
                    );
                }
            } catch (error) {
                console.error('Erro ao enviar o email:', error);
                simpleAlert(
                    'Oops! Algo deu errado...',
                    'Por favor, tente novamente. Se o problema persistir, entre em contato com o suporte.'
                );
            }
        }else{
            simpleAlert('E-mail inválido!', 'Digite um e-mail válido!');
        }

        submitButton.disabled = false;
    }
});
