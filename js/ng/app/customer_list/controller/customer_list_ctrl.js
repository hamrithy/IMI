app.controller(
    'customer_list_ctrl', [
        '$scope'
        , 'Restful'
        , 'Services'
        , function ($scope, Restful, Services){
            'use strict';
            $scope.service = new Services();
            var url = 'api/CustomerList/';
            $scope.init = function(params){
                Restful.get(url, params).success(function(data){
                    $scope.totalItems = data.count;
                    $scope.customerList = data;
                });
                // start init Doctor List
                Restful.get('api/DoctorList').success(function(data){
                    $scope.doctors = data;
                });
                // start init customer type
                Restful.get('api/CustomerType').success(function(data){
                    $scope.customerType = data;
                });
            };
            $scope.init();
            $scope.edit = function(params){
                $scope.params = angular.copy(params);
                $scope.full_name = $scope.params.full_name;
                $scope.sex = $scope.params.sex;
                $scope.customer_type_id = $scope.params.customer_type[0].id;
                $scope.address = $scope.params.address;
                $scope.dob = $scope.params.dob;
                $scope.email = $scope.params.email;
                $scope.tel = $scope.params.tel;
                $scope.relative_contact = $scope.params.relative_contact;
                $scope.relative_tel = $scope.params.relative_tel;
                $scope.detail = $scope.params.detail;
                $scope.doctor_id = $scope.params.doctor_fields[0].id;
                $scope.id = $scope.params.id;console.log(params);
                $('#customer-list-popup').modal('show');
            };
            $scope.disable = true;
            $scope.save = function(){
                var data = {
                    tel: $scope.tel,
                    customer_type_id: $scope.customer_type_id,
                    sex: $scope.sex,
                    relative_contact: $scope.relative_contact,
                    relative_tel: $scope.relative_tel,
                    full_name: $scope.full_name,
                    doctor_id: $scope.doctor_id,
                    detail: $scope.detail,
                    email: $scope.email,
                    address: $scope.address,
                    dob: $scope.dob,
                };

                $scope.disable = false;
                if($scope.id) {console.log($scope.id);
                    Restful.put( url + $scope.id, data).success(function (data) {
                        $scope.init();
                        $scope.service.alertMessage('<strong>Success: </strong>', 'Update Success.', 'success');
                        $('#customer-list-popup').modal('hide');
                        $scope.close();
                        $scope.disable = true;
                    });
                }else {
                    Restful.save( url , data).success(function (data) {
                        $scope.init();
                        $('#customer-list-popup').modal('hide');
                        $scope.close();
                        $scope.service.alertMessage('<strong>Success: </strong>', 'Save Success.', 'success');
                        $scope.disable = true;
                    });
                }
            };

            $scope.search = function(id){
                params.name = $scope.name;
                params.id = $scope.id;
                $scope.init(params);
            };

            $scope.remove = function(id){
                if (confirm('Are you sure you want to delete this customer?')) {
                    Restful.delete(url + id ).success(function(data){
                        $scope.init();
                        $scope.service.alertMessage('<strong>Success: </strong>', 'Delete Success.', 'success');
                    });
                }
            };

            $scope.close = function(){
                $scope.disable = true;
                $scope.id = '';
                $scope.full_name = '';
                $scope.sex = '';
                $scope.customer_type_id = '';
                $scope.address = '';
                $scope.dob = '';
                $scope.email = '';
                $scope.tel = '';
                $scope.relative_contact = '';
                $scope.relative_tel = '';
                $scope.detail = '';
            };

            /**
             * start functionality pagination
             */
            var params = {};
            $scope.currentPage = 1;
            //get another portions of data on page changed
            $scope.pageChanged = function() {
                $scope.pageSize = 20 * ( $scope.currentPage - 1 );
                params.start = $scope.pageSize;
                $scope.init(params);
            };
        }
    ]);