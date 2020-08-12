var app = angular.module('CompanyUpdateModel', []);
app.controller('CompanyUpdateController', function($scope,$http) {
    $scope.tab = 'company';
    $scope.opentab = function(tab){
        $('.nav a').removeClass('active');
        $('#nav_'+tab).addClass('active');
        $scope.tab = tab;
        if(tab=='company'){

        }
        if(tab=='workers'){

        }

    }
    $scope.addItem =function(){
        console.log($scope.tab)
    }
    $scope.companyFormData={};
    $scope.getCompanyMainData = function(){
        $http.get("/companies/get-company").then(function (response) {
            if (response != null) {
                $scope.company = response.data.company;
                $scope.companySettings = response.data.companySettings;
                console.log( $scope.company )

            }
        });
    }
    $scope.getCompanyMainData();
    $scope.saveCompany =function(){
        console.log($scope.company);

        var req = {
            method: 'POST',
            url: '/companies/update-company',
            data: {
                company:$scope.company,
                companySettings:$scope.companySettings,
            }
        }

        $http(req).then(function(response){
            console.log(response);
            }
        );
    }
    var img = document.getElementById('companies-imagefile');
    img.addEventListener('change',function () {

        var FR= new FileReader();
        FR.addEventListener('load', function(e) {
            $scope.vehicleImg = e.target.result;
            console.log(e.target.result);
            document.getElementById("company_logo").src = e.target.result;
        });
        FR.readAsDataURL(img.files[0]);
    });

    $scope.home = 'dddd';
})