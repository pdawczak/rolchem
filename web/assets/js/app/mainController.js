app.controller('mainController', ['$scope', function ($scope) {
    $scope.$on("ORDER_ITEM_ADDED", function (event, message) {
        $scope.$broadcast("UPDATE_ORDER_ITEM_COUNT", message);
    });
}]);
