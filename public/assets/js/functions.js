async function myFetch(url, type = 'GET', data = null) {
    try {
        let response;
        if (type.toUpperCase() === 'GET') {
            response = await fetch(url);
        } else {
            response = await fetch(url, {
                headers: {
                    "Content-type": "application/json",
                    "Accept": "application/json, text-plain, */*",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                },
                method: type,
                body: data ? JSON.stringify(data) : '',
            });
        }

        let result = await response.json();

        return result;
    } catch (err) {
        console.log(`Erro: ${err.message}\nRequisição: ${url}\nData: ${data ? data : 'Sem Dados enviados'}\nTipo: ${type}`);
    }
}

function slugify(str) {
    return str.toLowerCase()
        .normalize("NFD")
        .replace(/[\u0300-\u036f]/g, "")
        .split("")
        .map((character) => (/[a-z0-9]/.test(character) ? character : "-"))
        .join("")
        .replace(/-+/g, "-")
        .replace(/^-|-$/g, "");
}

function validateEmail(email) {
    const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    return emailRegex.test(email);
}

function simpleAlert(title, text, icon = 'error'){
    Swal.fire({
        title: title,
        text: text,
        icon: icon,
        confirmButtonText: 'Ok',
    });
}

function createToast(text) {
    const toast = document.createElement('div');
    toast.className = 'toast align-items-center text-bg-primary border-0';
    toast.role = 'alert';
    toast.ariaLive = 'assertive';
    toast.ariaAtomic = 'true';

    const toastBody = document.createElement('div');
    toastBody.className = 'toast-body';
    toastBody.textContent = text;

    const closeButton = document.createElement('button');
    closeButton.type = 'button';
    closeButton.className = 'btn-close btn-close-white me-2 m-auto';
    closeButton.dataset.bsDismiss = 'toast';
    closeButton.ariaLabel = 'Close';

    const dFlex = document.createElement('div');
    dFlex.className = 'd-flex';
    dFlex.appendChild(toastBody);
    dFlex.appendChild(closeButton);

    toast.appendChild(dFlex);

    document.body.appendChild(toast);
}

