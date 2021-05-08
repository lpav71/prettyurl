$('#btn-send').on('click', function(){
    var data = [], id;
    for( id in basket) {
        data.push({
            id: id,
            qty: basket[id]
        });
    }
    $.ajax({
        url: '/order/add', // url куда отправлять
        method: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(data),
        success: function(response){
            // выполнится после успешной отправки
        },
        processData: false
    });
});