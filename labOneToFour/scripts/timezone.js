$(document).ready(function () {

    //returns the number of minutes ahead or behind the green which meridian
    var offset = new Date().getTimezoneOffset();

    //return the number of milliseconds since 1970/01/01
    var timestamp = new Date().getTime();

    //Convert to universal time Coordinated
    var utc_timestamp = timestamp + (60000 * offset);

    $('#time_zone_offset').val(offset);
    $('#utc_timestamp').val(utc_timestamp);
    
});