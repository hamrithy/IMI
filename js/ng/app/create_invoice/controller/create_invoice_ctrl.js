app.controller(
    'create_invoice_ctrl', [
        '$scope'
        , 'Restful'
        , 'Services'
        , function ($scope, Restful, Services){
            'use strict';
            $scope.invoice_date = moment().format('YYYY-MM-DD');
            $scope.service = new Services();
            $scope.grand_total = 0;
            $scope.input_money = 0;
            $scope.sub_total = 0;
            $scope.discount = '';
            $scope.total_discount = 0;
            $scope.remaining = 0;
            $scope.init = function(params){
                // start init Doctor List
                Restful.get('api/DoctorList').success(function(data){
                    $scope.doctors = data;
                });
            };
            $scope.init();
            $scope.edit = function(params){
                alert('edit');
                //$('#create-invoice-popup').modal('show');
                //$scope.edit = params;
                //console.log(params);
            };
            $scope.disable = false;
            $scope.save = function(){
                console.log($scope.customer_list.length);
                var data = {
                    invoice: [{
                        invoice_no: 'test_invoice_no',
                        invoice_date: $scope.invoice_date,
                        customer_id: $scope.service_list.selected.id,
                        customer_type_id: $scope.service_list.selected.customer_type_id,
                        doctor_id: $scope.service_list.doctor_fields[0].id,
                        doctor_name: $scope.service_list.doctor_fields[0].name,
                        total: '',
                        noted: $scope.noted,
                        pay_type: $scope.pay_type,
                        sub_total: $scope.sub_total,
                        discount_type: $scope.value,
                        total_discount: $scope.total_discount,
                        discount: $scope.discount,
                        grand_total: $scope.grand_total,
                        deposit: $scope.payment,
                        balance: $scope.remaining
                    }],
                    invoice_detail: $scope.invoices
                };
                console.log(data);
                Restful.save( '' , data).success(function (data) {
                    $scope.init();
                    $scope.close();
                    $scope.service.alertMessage('<strong>Success: </strong>', 'Save Success.', 'success');
                    $scope.disable = true;
                });
            };

            $scope.remove = function($index){
                $scope.invoices.splice($index, 1);
            };
            $scope.invoices = [];
            $scope.add = function(){console.log($scope.service_list);
                if(!angular.isDefined( $scope.service_list.selected ) ){
                    return $scope.service.alertMessage(
                        'warning:','Please Select Service Name.','warning'
                    );
                }
                if(!angular.isDefined( $scope.unit ) ){
                    return $scope.service.alertMessage(
                        'warning:','Please Input Unit.','warning'
                    );
                }
                var unit_in_stock = parseInt($scope.service_list.selected.unit);
                //console.log(unit_in_stock);
                //console.log('qty in stock => ',$scope.service_list.selected.unit);
                // check if qty has in stock add
                //if($scope.unit < unit_in_stock ) {
                    // check if exist in list
                    for (var i = 0, l = $scope.invoices.length; i < l; i++) {
                        var obj = $scope.invoices[i];
                        //console.log(obj);
                        //console.log($scope.invoices);
                        if (obj.id === $scope.service_list.selected.id) {
                            var old_qty = parseInt(obj.unit) + parseInt($scope.unit);
                            // check again in existing object
                            //if( old_qty < unit_in_stock){
                                obj.unit = old_qty;
                                obj.dent_order = $scope.dent_order;
                                obj.color = $scope.color;
                                obj.total = obj.unit * obj.price;
                                $scope.getTotal();
                                $scope.close();
                                return;
                            //}else{
                            //    return  $scope.service.alertMessage(
                            //        'warning:','OPP! Out Off Stock. You Have Only ' + $scope.service_list.selected.unit +' Unit In Stock.','warning'
                            //    );
                            //}
                        }
                    }
                    $scope.invoices.push({
                        id: $scope.service_list.selected.id,
                        service_name: $scope.service_list.selected.service_name,
                        dent_order: $scope.dent_order,
                        color: $scope.color,
                        unit: $scope.unit,
                        price: $scope.service_list.selected.price,
                        total: $scope.service_list.selected.price * $scope.unit
                    });
                    $scope.getTotal();
                    $scope.close();
                //}else{
                //    return  $scope.service.alertMessage(
                //        'warning:','OPP! Out Off Stock. You Have Only ' + $scope.service_list.selected.unit +' Unit In Stock.','warning'
                //    );
                //}
            };

            // functional get total of all products
            $scope.getTotal = function(){
                $scope.sub_total = 0;
                for (var i = 0, l = $scope.invoices.length; i < l; i++) {
                    console.log($scope.invoices[i]);
                    var obj = $scope.invoices[i];
                    //var sub_total = obj.qty * obj.price;
                    $scope.sub_total = $scope.sub_total + (obj.unit * obj.price);
                }
                $scope.sub_total.toFixed(2);
                $scope.grand_total = $scope.sub_total.toFixed(2);
            };

            // calculate money payment
            $scope.inputMoney = function(){
                if($scope.sub_total){
                    $scope.remaining = ($scope.sub_total - $scope.input_money - $scope.total_discount).toFixed(2);
                }else{
                    $scope.remaining = '';
                }
            };
            // function calculate discount when change value
            $scope.inputDiscount = function(){
                //$scope.total_discount = $scope.discount;
                $scope.checkTypeDiscount();
                //$scope.grand_total = $scope.sub_total - $scope.total_discount;
            };
            $scope.value = 'dollar';
            // functionality calculate discount type
            $scope.checkTypeDiscount = function(value) {
                if($scope.value = "percent"){
                    $scope.total_discount = (($scope.discount / 100) * $scope.sub_total).toFixed(2);
                    $scope.grand_total = $scope.sub_total - $scope.total_discount;
                    $scope.remaining =  $scope.grand_total - $scope.input_money;
                    $scope.remaining.toFixed(2);
                    $scope.grand_total.toFixed(2);
                    console.log('discount: ', ($scope.discount / 100));
                    console.log('sub_total: ', $scope.sub_total);
                    console.log($scope.total_discount);
                }else{
                    console.log('show dollar');
                    $scope.total_discount = $scope.discount;
                    $scope.grand_total = $scope.sub_total - $scope.total_discount;
                    $scope.remaining = $scope.grand_total - $scope.input_money;
                    $scope.grand_total.toFixed(2);
                    $scope.remaining.toFixed(2);
                }
                console.log($scope.value);
            };

            $scope.changeUnit = function(params){
                console.log(params);
                $scope.getTotal();
                //if(params.unit < ){
                //    console.log('tasd');
                //}
                //console.log($scope.unit);
            };

            $scope.close = function(){
                $scope.disable = false;
                $scope.service_list = {};
                $scope.unit = '';
                $scope.dent_order = '';
                $scope.color = '';
                $scope.edit = '';
            };
            // customer filter
            $scope.customer_list = {};
            $scope.refreshCustomerList = function(customer_list) {
                var params = {name: customer_list, search_in_invoice: 'yes'};
                return Restful.get('api/CustomerList', params).then(function(response) {
                    $scope.CustomerList = response.data.elements;
                });
            };
            // service filter
            $scope.service_list = {};
            $scope.refreshServiceList = function(service) {
                var params = {name: service};
                return Restful.get('api/Service', params).then(function(response) {
                    $scope.serviceList = response.data.elements;
                });
            };
        }
    ]);
/**
 * AngularJS default filter with the following expression:
 * "person in people | filter: {name: $select.search, age: $select.search}"
 * performs a AND between 'name: $select.search' and 'age: $select.search'.
 * We want to perform a OR.
 */
app.filter('propsFilter', function() {
    return function(items, props) {
        var out = [];

        if (angular.isArray(items)) {
            items.forEach(function(item) {
                var itemMatches = false;

                var keys = Object.keys(props);
                for (var i = 0; i < keys.length; i++) {
                    var prop = keys[i];
                    var text = props[prop].toLowerCase();
                    if (item[prop].toString().toLowerCase().indexOf(text) !== -1) {
                        itemMatches = true;
                        break;
                    }
                }

                if (itemMatches) {
                    out.push(item);
                }
            });
        } else {
            // Let the output be the input untouched
            out = items;
        }

        return out;
    }
});