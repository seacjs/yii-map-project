/**
 * Created by Evgeny on 16.12.2017.
 */

console.log('start render');

/*
*
* - сетка между провами
* - clip страны
* - провинции
* - бакграунд
*
* */


$.ajax({
    url: "/server/check",
    type: "GET",
    //data: {
    //    "id":id
    //},
    dataType: 'json',
    cache: false,
    timeout: 30000,
    async: true,
    success: function(result) {
        console.log('success',result);
    },
    done: function(result) {
        console.log('done',result);
    },
    error: function(result) {
        console.log('error',result);
    }
});


(function poll() {
    setTimeout(function() {
        $.ajax({
            url: "/server/check",
            success: function(data) {
                console.log('end');
                //sales.setValue(data.value);
            },
            dataType: "json",
            complete: poll
        });
    }, 10000);
})();

console.log('end render');



/* --------------------------------------------------------------- */





//var socket = io.connect("http://localhost");
//socket.on('sales', function (data) {
//    //Update your dashboard gauge
//    salesGauge.setValue(data.value);
//
//    socket.emit('profit', { my: 'data' });
//});