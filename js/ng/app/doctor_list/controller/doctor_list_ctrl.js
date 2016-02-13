app.controller(
    'doctor_list_ctrl', [
        '$scope'
        , 'Restful'
        , 'Services'
        , function ($scope, Restful, Services){
            'use strict';
            $scope.service = new Services();
            var url = 'api/DoctorList/';
            $scope.init = function(params){
                Restful.get(url, params).success(function(data){
                    $scope.doctorList = data;
                    $scope.totalItems = data.count;
                });
                Restful.get('api/DoctorType').success(function(data){
                    $scope.doctorType = data;
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
                $scope.detail = $scope.params.detail;
                $scope.sex = $scope.params.sex;
                $scope.address = $scope.params.address;
                $scope.phone = $scope.params.phone;
                $scope.doctor_type_id = $scope.params.doctor_type[0].id;
                $scope.id = $scope.params.id;
                $('#doctor-list-popup').modal('show');console.log(params);
            };
            $scope.disable = true;
            $scope.save = function(){
                var data = {
                    name: $scope.name,
                    detail: $scope.detail,
                    phone: $scope.phone,
                    doctor_type_id: $scope.doctor_type_id,
                    address: $scope.address,
                    sex: $scope.sex
                };console.log(data);
                $scope.disable = false;
                if($scope.id) {
                    Restful.put( url + $scope.id, data).success(function (data) {
                        $scope.init();console.log(data);
                        $scope.service.alertMessage('<strong>Success: </strong>', 'Update Success.', 'success');
                        $('#doctor-list-popup').modal('hide');
                        $scope.clear();
                        $scope.disable = true;
                    });
                }else {
                    Restful.save( url , data).success(function (data) {
                        $scope.init();console.log(data);
                        $('#doctor-list-popup').modal('hide');
                        $scope.clear();
                        $scope.service.alertMessage('<strong>Success: </strong>', 'Save Success.', 'success');
                        $scope.disable = true;
                    });
                }
            };

            $scope.remove = function(id){
                if (confirm('Are you sure you want to delete this doctor?')) {
                    console.log(url + id );
                    Restful.delete(url + id ).success(function(data){console.log(data);
                        $scope.service.alertMessage('<strong>Success: </strong>', 'Delete Success.', 'success');
                        $scope.init();
                    });
                }
            };

            $scope.clear = function(){
                $scope.disable = true;
                $scope.name = '';
                $scope.detail = '';
                $scope.sex = '';
                $scope.address = '';
                $scope.phone = '';
                $scope.id = '';
            };
        }
    ]);