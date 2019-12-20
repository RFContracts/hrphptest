$('.ajax-price').on('click', function () {
    let input = $(this).find('input[name=price]');
    input.attr('type', 'text');
    input.prop('disabled', false);
    $(this).find('.price-value').addClass('hidden');
    $('input[name=price]').focus();
});

$('input[name=price]').on('focusout', function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(this).attr('type', 'hidden');
    $(this).prop('disabled', true);
    $(this).next('.price-value').removeClass('hidden');
    let id = parseInt($(this).parent('td').parent('tr').find('th').text());
    let price = parseInt($(this).val());
    restSetPrice(id, price);
});

function restSetPrice(id, price) {
    $.ajax({
        type: "POST",
        url: "/product/ajaxPrice",
        data: {
            'id': id,
            'price': price
        },
        success: function(data) {
            $('.price-'+id).html(price + ' ₽');
        }
    });
}