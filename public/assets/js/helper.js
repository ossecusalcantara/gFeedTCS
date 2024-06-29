/*--------------------------------------------------------------
# General
--------------------------------------------------------------*/

$('.data-table').DataTable({
    language: {
        url:"https://cdn.datatables.net/plug-ins/1.13.4/i18n/pt-BR.json"
      }
});

$('.cpf').mask('000.000.000-00', {reverse: true});

$('.phone').mask(function (val) {
  return val.length === 14 ? '(00) 0000-0000' : '(00) 00000-0000';
});
