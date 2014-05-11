app.directive('orderForm', function () {
    return {
        restrict: 'C',
        templateUrl: '/assets/templates/orderForm.html',
        scope: {
            feed: '=',
            removeUrl: '='
        },
        controller: ['$scope', '$http', function ($scope, $http) {
            $scope.loading = true;
            $scope.items = [];
            $scope.order = {};
            $scope.orderPlaced = false;

            $http.get($scope.feed).then(function (response) {
                $scope.items = response.data;
                $scope.loading = false;
            });

            $scope.remove = function (index) {
                var product = $scope.items[index];
                $http.post(
                    $scope.removeUrl,
                    $.param({ productId: product.id }),
                    { headers: {'Content-Type': 'application/x-www-form-urlencoded'} }
                ).then(function (response) {
                    $scope.$emit("ORDER_ITEM_REMOVED", {
                        title: product.name,
                        message: 'Produkt usunięto z zamówienia',
                        image: product.image
                    });
                    $scope.items.splice(index, 1);
                });
            };

            $scope.orderSubmit = function () {
                $scope.loading = true;
                $http.post(
                    '/zamowienie/place',
                    $.param({ orderDetails: $scope.order, orderItems: $scope.items }),
                    { headers: {'Content-Type': 'application/x-www-form-urlencoded'} }
                ).then(function (response) {
                    $scope.$emit("ORDER_ITEMS_CLEARED");
                    $scope.loading = false;
                    $scope.orderPlaced = true;
                });
            };
        }]
    };
});
