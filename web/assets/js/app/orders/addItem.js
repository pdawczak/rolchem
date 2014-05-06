app.directive('addItem', function () {
    return {
        restrict: 'C',
        controller: ['$scope', function ($scope) {
            $scope.addItem = function () {
                this.$emit("ORDER_ITEM_ADDED");
            };
        }],
        template: '<button data-ng-click="addItem()">ADD AN ITEM</button>'
    };
});
