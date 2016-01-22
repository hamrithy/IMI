app.service("Services", [
    'Restful'
	, function(Restful) {
        var services = function(){
            var self = this;
        };
        services.prototype.message = function(title, message, type){
            return $.notify({
                title: '<strong>' + title + '</strong>',
                message: message
            }, {
                type: type
            });
        };

        return services;
        
 	}
]);