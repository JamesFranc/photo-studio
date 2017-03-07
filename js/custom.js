$('#confirm-delete').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
});

$(document).on("click", ".open-confirmDialogUser", function () {
     var userid = $(this).data('id');
     $(".modal-body #userid").val( userid );
     var oldHref = $('.modal-footer #deact').attr('href'); // get the data-href of current "fb-comments"
     var newHref = oldHref + '?id='+userid+"&page=user"; // make a new data-href
     $('.modal-footer #deact').attr('href', newHref); // set the data-href here.
});
$(document).on("click", ".open-confirmDialogOrder", function () {
     var orderid = $(this).data('id');
     $(".modal-body #orderid").val( orderid );
     var oldHref = $('.modal-footer #deact').attr('href'); // get the data-href of current "fb-comments"
     var newHref = oldHref + '?id='+orderid+"&page=order"; // make a new data-href
     $('.modal-footer #deact').attr('href', newHref); // set the data-href here.
});
