$(document).ready(function () {
    $('#formLogin').on('submit', function (e) {
        e.preventDefault();
        let formulario = $(this);
        let btnEnviar = formulario.find("button[type='submit']");
        let originalButtonHtml = btnEnviar.html();

        btnEnviar.html('<div class="button-with-icon d-flex justify-content-center"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> <p class="button-text" style="text-transform: capitalize;">Iniciando Sesión...</p></div>');

        $.ajax({
            url: formulario.attr('action'),
            method: 'post',
            data: formulario.serialize(),
            beforeSend: function () {
                btnEnviar.prop('disabled', true);
                $('#alertContainer').html(''); // Limpiar las alertas anteriores
            },
            success: function (data) {
                if (data.success === true) {
                    window.location.href = data.url;
                } else {
                    btnEnviar.prop('disabled', false).html(originalButtonHtml);

                    // Construir alertas de error con el diseño específico
                    let errorMessages = data.message;
                    let alertHtml = `
                        <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
                            <symbol id="exclamation-triangle-fill" viewBox="0 0 16 16">
                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                            </symbol>
                        </svg>
                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                            <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:" style="width: 1em; height: 1em;">
                                <use xlink:href="#exclamation-triangle-fill" />
                            </svg>
                            <div>`;

                    // Añadir mensajes de error a la alerta
                    for (let key in errorMessages) {
                        if (errorMessages.hasOwnProperty(key)) {
                            alertHtml += `<span>${errorMessages[key].join(", ")}</span>`;
                        }
                    }

                    alertHtml += `<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>`;

                    // Mostrar alerta
                    $('#alertContainer').html(alertHtml);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                btnEnviar.prop('disabled', false).html(originalButtonHtml);

                let alertHtml = `
                    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
                        <symbol id="exclamation-triangle-fill" viewBox="0 0 16 16">
                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                        </symbol>
                    </svg>
                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                        <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:" style="width: 1em; height: 1em;">
                            <use xlink:href="#exclamation-triangle-fill" />
                        </svg>
                        <div>
                            Ha ocurrido un error inesperado: ${textStatus}
                        </div>
                    </div>`;

                $('#alertContainer').html(alertHtml);
                console.log('Error: ', jqXHR, textStatus, errorThrown);
            }
        });
    });
});
