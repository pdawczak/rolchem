app.directive('addItem', ['$http', function ($http) {
    return {
        restrict: 'C',
        link: function (scope, element, attrs) {
            element.on('click', function (e) {
                e.preventDefault();
                $http.post(attrs.href, {}).then(function (response) {
                    var message = response.data;
                    message.title = message.name;
                    scope.$emit("ORDER_ITEM_ADDED", message);
                });
            });
        }
    };
}]);
