$(document).ready(function() {
    let currentStep = 1;
    const totalSteps = 5;
    
    // // Mettre à jour la barre de progression
    // function updateProgressBar(step) {
    //     const progress = ((step - 1) / totalSteps) * 100;
    //     $('#progress-bar').css('width', progress + '%').attr('aria-valuenow', progress).text(progress + '%');
    // }
    
    // Afficher les erreurs de validation
    function showValidationErrors(errors) {
        $.each(errors, function(field, messages) {
            $('#error-' + field).text(messages[0]).show();
            $('[name="' + field + '"]').addClass('is-invalid');
        });
    }
    
    // Afficher une alerte
    function showAlert(type, message) {
        $('#alert-container').html(`
            <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `);
    }
    
    // // Naviguer vers une étape
    // function goToStep(step) {
    //     $('.form-step').addClass('d-none');
    //     $('#step' + step).removeClass('d-none');
        
    //     // Mettre à jour les indicateurs d'étape
    //     $('.stepper-item').removeClass('active completed');
    //     for (let i = 1; i <= totalSteps; i++) {
    //         if (i < step) {
    //             $('#step-indicator-' + i).addClass('completed');
    //         } else if (i === step) {
    //             $('#step-indicator-' + i).addClass('active');
    //         }
    //     }
        
    //     updateProgressBar(step);
    //     currentStep = step;
    // }
    
    // Gestion du formulaire étape 1
    $('#step1-form').on('submit', function(e) {
        e.preventDefault();
        
        // Réinitialiser les erreurs
        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').text('');
        
        const formData = new FormData(this);
        
        $.ajax({
            url: '{{ route('stepper.step1') }}',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    goToStep(2);
                }
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    showValidationErrors(xhr.responseJSON.errors);
                } else {
                    showAlert('danger', 'Une erreur s\'est produite. Veuillez réessayer.');
                }
            }
        });
    });
    
    // Gestion du formulaire étape 2
    $('#step2-form').on('submit', function(e) {
        e.preventDefault();
        
        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').text('');
        
        const formData = new FormData(this);
        
        $.ajax({
            url: '{{ route('stepper.step2') }}',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    goToStep(3);
                }
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    showValidationErrors(xhr.responseJSON.errors);
                } else {
                    showAlert('danger', 'Une erreur s\'est produite. Veuillez réessayer.');
                }
            }
        });
    });
    
    // Gestion du formulaire étape 3
    $('#step3-form').on('submit', function(e) {
        e.preventDefault();
        
        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').text('');
        
        const formData = new FormData(this);
        
        $.ajax({
            url: '{{ route('stepper.step3') }}',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    // Finaliser le formulaire
                    $.ajax({
                        url: '{{ route('stepper.finish') }}',
                        type: 'POST',
                        data: {_token: '{{ csrf_token() }}'},
                        success: function(response) {
                            if (response.success) {
                                $('.form-step').addClass('d-none');
                                $('#step-final').removeClass('d-none');
                                $('#progress-bar').css('width', '100%').attr('aria-valuenow', 100).text('100%');
                                
                                // Mettre à jour les indicateurs d'étape
                                $('.stepper-item').removeClass('active').addClass('completed');
                            }
                        },
                        error: function() {
                            showAlert('danger', 'Une erreur s\'est produite lors de la finalisation du formulaire.');
                        }
                    });
                }
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    showValidationErrors(xhr.responseJSON.errors);
                } else {
                    showAlert('danger', 'Une erreur s\'est produite. Veuillez réessayer.');
                }
            }
        });
    });
    
    // Boutons précédent
    $('.prev-step').on('click', function() {
        goToStep(currentStep - 1);
    });
    
    // Bouton recommencer
    $('#restart-button').on('click', function() {
        goToStep(1);
    });
});
