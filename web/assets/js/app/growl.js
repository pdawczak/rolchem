app.directive('growl', function () {
    return {
        restrict: 'C',
        link: function (scope, element, attrs) {
            scope.$on("UPDATE_ORDER_ITEM_COUNT", function (event, message) {
                $.gritter.add({
                    title: message.title,
                    text: message.message,
                    image: message.image
                });
            });
        }
    };
});
