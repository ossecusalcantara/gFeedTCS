$('.select2').select2({
    theme:'bootstrap-5'
});

$(document).ready(function () {
    
    $('#btnAdicionar').click(function () {
        valor = $('[name="skill"]').val();
        container = $('#skillsInputBase');
        descricao = $('[name="skill"] option:selected').text();
        if(container.hasClass('d-none')) {
            container.find('label').text(descricao);
            container.find('[name="skill_id[]"]').val(valor);
            container.removeClass('d-none');
        } else {
            clone = container.clone();
            clone.find('label').text(descricao);
            clone.find('[name="skill_id[]"]').val(valor);
            clone.removeAttr('id');
            clone.find('[name="pontuation[]"]').val(5);
            $('#skillsContainer').append(clone);
        }
    });

});