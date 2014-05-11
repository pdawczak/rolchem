app.directive('orderNavIndicator', function () {
    return {
        restrict: 'C',
        scope: {
            count: '='
        },
        controller: ['$scope', function ($scope) {
            $scope.renderCount = parseInt($scope.count);

            $scope.$on("UPDATE_ORDER_ITEM_COUNT", function (event, message) {
                $scope.renderCount += message.count;
            });

            $scope.$on("CLEAN_ORDER_ITEMS", function (event) {
                $scope.renderCount = 0;
            });
        }],
        template: '<span data-ng-if="renderCount > 0" class="badge">{{renderCount}}</span>'
    };
});
