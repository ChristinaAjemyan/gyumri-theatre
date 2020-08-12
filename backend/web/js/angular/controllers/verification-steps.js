var app = angular.module('myApp', []);
app.controller('verification', function($scope,$http) {
    $scope.progress = 15;
    $scope.company = {};
    $scope.progressColor = 'danger';
    $scope.chooseType = function (companyType) {
        $scope.company.type=companyType;

        $http.post("/companies/change-type",
            {
                type:companyType
            }
            ).then(function (data) {

                if(data.data.success ){

                    window.location.href = "/companies/company-update/";
                }


        });
        // var req = {
        //     method: 'POST',
        //     url: '/companies/change-type',
        //     data: { type: $scope.company.type }
        // }
        //
        // $http(req).then(function(){}, function(){});
        // window.location.href = "/companies/company-update/";
        // $("#coose_type").hide();
        // $("#company_form").show();
        // $scope.progress = 30;

    }

});