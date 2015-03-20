var libraryApp = angular.module('libraryApp', ['infinite-scroll']);

libraryApp.controller('AuthorListController', function ($scope, $http) {
    $scope.authors = new Array();
    $scope.loadingData = false;

    $scope.loadMore = function () {
        if ( $scope.loadingData ) {
            return;
        }
        $scope.loadingData = true;

        $http.get( '/api/v1/authors/next/' + $scope.authors.length ).
            success( function ( data, status, headers, config ) {
                if ( typeof data == "object") {
                    $scope.authors.push( data );
                }
                $scope.loadingData = false;
            }).
            error( function ( data, status, headers, config ) {
                alert('Can`t load data');
            });
    }
});