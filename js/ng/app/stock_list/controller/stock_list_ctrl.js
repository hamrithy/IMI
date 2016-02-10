app.controller(
    'stock_list_ctrl', [
        '$scope'
        , 'Restful'
        , 'Services'
        , function ($scope, Restful, Services){
            'use strict';
            $scope.service = new Services();
            var url = 'api/ProductList/';
            $scope.init = function(params){
                Restful.get(url, params).success(function(data){
                    $scope.stockList = data;console.log(data);
                    $scope.totalItems = data.count;
                });
            };
            $scope.init();
            $scope.search = function(id){
                params.name = $scope.name;
                params.barcode = $scope.barcode;
                params.id = $scope.id;
                $scope.init(params);
            };
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

            $scope.edit = function(params){
                $scope.params = angular.copy(params);
                $scope.product_name = $scope.params.product_name;
                $scope.detail = $scope.params.detail;
                $scope.product_type = $scope.params.product_type;
                $scope.barcode = $scope.params.barcode;
                $scope.id = $scope.params.id;
                $('#stock-list-popup').modal('show');
            };
            $scope.disable = true;
            $scope.save = function(){
                var data = {
                    product_name: $scope.product_name,
                    detail: $scope.detail,
                    product_type: $scope.product_type,
                    barcode: $scope.barcode,
                };
                $scope.disable = false;
                if($scope.id) {console.log($scope.id);
                    Restful.put( url + $scope.id, data).success(function (data) {
                        $scope.init();
                        $scope.service.alertMessage('<strong>Success: </strong>', 'Update Success.', 'success');
                        $('#stock-list-popup').modal('hide');
                        clear();
                        $scope.disable = true;
                    });
                }else {
                    Restful.save( url , data).success(function (data) {
                        $scope.init();
                        $('#stock-list-popup').modal('hide');
                        clear();
                        $scope.service.alertMessage('<strong>Success: </strong>', 'Save Success.', 'success');
                        $scope.disable = true;
                    });
                }
            };

            $scope.remove = function(id){
                if (confirm('Are you sure you want to delete this product?')) {
                    console.log(url + id );
                    Restful.delete(url + id ).success(function(data){console.log(data);
                        $scope.init();
                        $scope.service.alertMessage('<strong>Success: </strong>', 'Delete Success.', 'success');
                    });
                }
            };

            function clear(){
                $scope.disable = true;
                $scope.product_name = '';
                $scope.detail = '';
                $scope.product_type = '';
                $scope.barcode = '';
                $scope.id = '';
            };
        }
    ]);