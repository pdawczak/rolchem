app.controller('mainController', ['$scope', function ($scope) {
    $scope.$on("ORDER_ITEM_ADDED", function (event, message) {
        message.count = 1;
        $scope.$broadcast("UPDATE_ORDER_ITEM_COUNT", message);
    });
    $scope.$on("ORDER_ITEM_REMOVED", function (event, message) {
        message.count = -1;
        $scope.$broadcast("UPDATE_ORDER_ITEM_COUNT", message);
    });
    $scope.$on("ORDER_ITEMS_CLEARED", function (event) {
        $scope.$broadcast("CLEAN_ORDER_ITEMS");
    });
}]);
