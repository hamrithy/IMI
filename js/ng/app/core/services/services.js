app.service("Services", [
    'Restful'
	, function(Restful) {
        var services = function(){
            var self = this;
        };

        services.prototype.alertMessage = function(title, message, type){
            $.notify({
                title: title,
                message: message
            },{
                type: type
            });
        };

        return services;
        
 	}
]);