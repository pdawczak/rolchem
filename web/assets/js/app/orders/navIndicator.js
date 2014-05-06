app.directive('orderNavIndicator', function () {
    return {
        restrict: 'C',
        scope: {
            count: '='
        },
        controller: ['$scope', function ($scope) {
            $scope.count = parseInt($scope.count);

            $scope.$on("UPDATE_ORDER_ITEM_COUNT", function (event, message) {
                if (message.success) {
                    $scope.count += 1;
                }
            });
        }],
        template: '<span data-ng-if="count > 0" class="badge">{{count}}</span>'
    };
});
