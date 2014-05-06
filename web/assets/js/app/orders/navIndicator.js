app.directive('orderNavIndicator', function () {
    return {
        restrict: 'C',
        controller: ['$scope', function ($scope) {
            $scope.count = 0;

            $scope.$on("UPDATE_ORDER_ITEM_COUNT", function (event, data) {
                $scope.count += data.count;
            });
        }],
        template: '<span data-ng-if="count > 0" class="badge">{{count}}</span>'
    };
});
