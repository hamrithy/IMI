app.controller(
    'products_type_ctrl', [
        '$scope'
        , 'Restful'
        , 'Services'
        , function ($scope, Restful, Services){
            'use strict';
            $scope.service = new Services();
            var url = 'api/ProductType/';
            $scope.init = function(params){
                Restful.get(url, params).success(function(data){
                    $scope.productsType = data;console.log(data);
                    $scope.totalItems = data.count;
                });
            };
            $scope.init();
            /**
             * start functionality pagination
             */
            var params = {};
            $scope.currentPage = 1;
            //get another portions of data on page changed
            $scope.pageChanged = function() {
                $scope.pageSize = 10 * ( $scope.currentPage - 1 );
                params.start = $scope.pageSize;
                $scope.init(params);
            };

            $scope.search = function(id){
                params.name = $scope.search_name;
                params.id = $scope.search_id;
                $scope.init(params);
            };

            $scope.edit = function(params){
                $scope.params = angular.copy(params);
                $scope.name = $scope.params.name;
                $scope.description = $scope.params.description;
                $scope.id = $scope.params.id;
                $('#products-type-popup').modal('show');
            };
            $scope.disable = true;
            $scope.save = function(){
                var data = {name: $scope.name, description: $scope.description};
                $scope.disable = false;
                console.log(data);
                if($scope.id) {
                    Restful.put( url + $scope.id, data).success(function (data) {
                        $scope.init();
                        $scope.service.alertMessage('<strong>Success: </strong>', 'Update Success.', 'success');
                        $('#products-type-popup').modal('hide');
                        clear();
                        $scope.disable = true;
                    });
                }else {
                    Restful.save( url , data).success(function (data) {
                        $scope.init();console.log(data);
                        $('#products-type-popup').modal('hide');
                        clear();
                        $scope.service.alertMessage('<strong>Success: </strong>', 'Save Success.', 'success');
                        $scope.disable = true;
                    });
                }
            };

            $scope.remove = function(id){
                if (confirm('Are you sure you want to delete this product type?')) {
                    console.log(url + id );
                    Restful.delete(url + id ).success(function(data){console.log(data);
                        $scope.service.alertMessage('<strong>Success: </strong>', 'Delete Success.', 'success');
                        $scope.init();
                    });
                }
            };

            function clear(){
                $scope.disable = true;
                $scope.name = '';
                $scope.detail = '';
                $scope.id = '';
            };
        }
    ]);