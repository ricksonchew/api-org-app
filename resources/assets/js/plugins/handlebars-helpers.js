define(['handlebars', 'moment'], function (Handlebars, moment) {
    Handlebars.registerHelper("debug", function(optionalValue) {
        console.log("Current Context");
        console.log("====================");
        console.log(this);

        if (optionalValue) {
            console.log("Value");
            console.log("====================");
            console.log(optionalValue);
        }
    });

    Handlebars.registerHelper('helperFormatDate', function(dateTime, dateTimeFromFormat, dateTimeToFormat) {
        return moment(dateTime, dateTimeFromFormat).format(dateTimeToFormat);
    });
});