<div ng-app="Actions">
    <span ng-controller="LikeController">
      
            <button class="btn btn-default like btn-login" ng-click="like()">
                <i class="fa fa-heart"></i>
                <span></span>
            </button>
      
    </span>
</div>
<script>
    var app = angular.module("Actions", []);
    app.controller("LikeController", function($scope, $http, $interpolateProvider) {

        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
        
        checkLike();
        $scope.like = function() {
            var post = {
                id: "<% $post->id %>",
            };
            $http.post('/api/palestra/like', post).success(function(result) {
                checkLike();
            });
        };
        function checkLike(){
            $http.get('/api/palestra/<% $palestra->id %>/islikedbyme').success(function(result) {
                if (result == 'true') {
                    $scope.like_btn_text = "Delete Like";
                } else {
                    $scope.like_btn_text = "Like";
                }
            });
        };
    });
</script>