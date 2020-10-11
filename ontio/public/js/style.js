// 公共js
(function () {
    var public=angular.module("public",[],function($provide,$httpProvider, $filterProvider){
        // Use x-www-form-urlencoded Content-Type
        $httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';

        /**
         * The workhorse; converts an object to x-www-form-urlencoded serialization.
         * @param {Object} obj
         * @return {String}
         */
        var param = function (obj) {
            var query = '', name, value, fullSubName, subName, subValue, innerObj, i;

            for (name in obj) {
                value = obj[name];

                if (value instanceof Array) {
                    for (i = 0; i < value.length; ++i) {
                        subValue = value[i];
                        fullSubName = name + '[' + i + ']';
                        innerObj = {};
                        innerObj[fullSubName] = subValue;
                        query += param(innerObj) + '&';
                    }
                }
                else if (value instanceof Object) {
                    for (subName in value) {
                        subValue = value[subName];
                        fullSubName = name + '[' + subName + ']';
                        innerObj = {};
                        innerObj[fullSubName] = subValue;
                        query += param(innerObj) + '&';
                    }
                }
                else if (value !== undefined && value !== null)
                    query += encodeURIComponent(name) + '=' + encodeURIComponent(value) + '&';
            }
            return query.length ? query.substr(0, query.length - 1) : query;
        };

        // Override $http service's default transformRequest
        $httpProvider.defaults.transformRequest = [function (data) {
            return angular.isObject(data) && String(data) !== '[object File]' ? param(data) : data;
        } ];
    });
//配置cookie
    function addCookie(name,value,expireHours){
        var cookieString=name+"="+escape(value)+"; path=/";
        //判断是否设置过期时间
        if( (name=='key' || name == 'username') && !expireHours){
            expireHours = 720;//30 days
        }
        if(expireHours>0){
            var date=new Date();
            date.setTime(date.getTime()+expireHours*3600*1000);
            cookieString=cookieString+";expires="+date.toGMTString();
        }
        document.cookie=cookieString;
    }

    function getCookie(name){
        var strcookie=document.cookie;
        var arrcookie=strcookie.split("; ");
        for(var i=0;i<arrcookie.length;i++){
            var arr=arrcookie[i].split("=");
            if(arr[0]==name && arr[1]!='undefined' && arr[1]!='null'){
                return unescape(arr[1]);
            }
        }
        return null;
    }
//公用语言切换模块
    public.controller("language",function($scope,$interval,$location,$http,$rootScope){
        $scope.key=getCookie("lang");
        $scope.syskey = (navigator.systemLanguage?navigator.systemLanguage:navigator.language);
        $scope.syskey = $scope.syskey.substr(0,2)
        if($scope.key){
            $http.get("/i18n/"+$scope.key+".json").success(function(data){
                $rootScope.language=data;
            });
            if($scope.key=="cn" || $scope.key=="zh" ){
                $scope.key_lang='中文';
            }else{
                if($scope.key=="ko"){
                    $scope.key_lang='Korean';
                }else{
                    if($scope.key=="jp"){
                        $scope.key_lang='Japanese';
                    }else{
                        $scope.key_lang='English';
                    }
                }
            }
        }else{
            if($scope.syskey){
                if($scope.syskey=="cn" || $scope.syskey=="zh"){
                    $http.get("/i18n/cn.json").success(function(data){
                        $rootScope.language=data;
                    });
                    $scope.key_lang='中文';
                    addCookie("lang","cn");
                }else{
                    if($scope.key=="ko"){
                        $http.get("/i18n/ko.json").success(function(data){
                            $rootScope.language=data;
                        });
                        $scope.key_lang='Korean';          
                        addCookie("lang","ko");  
                    }else{
                        if($scope.key=="jp"){
                            $http.get("/i18n/jp.json").success(function(data){
                                $rootScope.language=data;
                            });
                            $scope.key_lang='Japanese';          
                            addCookie("lang","jp");  
                        }else{
                            $http.get("/i18n/en.json").success(function(data){
                                $rootScope.language=data;
                            });
                            $scope.key_lang='English';          
                            addCookie("lang","en");  
                        }
                    }
                }              
            }else{
                $scope.key_lang='English';
                $scope.key='en';
                addCookie("lang",'en');
                $http.get("/i18n/en.json").success(function(data){
                    $rootScope.language=data;
                })
            }
        }
        $scope.lang=function(key){
            $scope.key=key;
            addCookie("lang",key);
            $http.get("/i18n/"+$scope.key+".json").success(function(data){
                $rootScope.language=data;
            });
            if($scope.key=="cn"){
                $scope.key_lang='中文';
            }else{
                if($scope.key=="ko"){
                    $scope.key_lang='Korean';     
                }else{
                    if($scope.key=="jp"){
                        $scope.key_lang='Japanese';     
                    }else{
                        $scope.key_lang='English'; 
                    }
                }
            }
        }

    });
})();

// 导航导航公告脚本
(function () {
    var onOff = true;
    var offOn = true;
    $('#nav .mobile_btn').click(function () {
        if(onOff){
            $('#mobile_nav').css({
                'z-index': '999',
                'opacity': '1'
            })
        }else{
            $('#mobile_nav').css({
                'z-index': '-1',
                'opacity': '0'
            })
        }
        onOff = !onOff;
    });
    $('#mobile_nav ul.menu>li').eq(12).click(function () {
        if(offOn){
            $(this).find('ul.lang_menu').addClass('active');
        }else{
            $(this).find('ul.lang_menu').removeClass('active');
        }
        offOn = !offOn;
    });
    $('#mobile_nav ul.menu>li').eq(12).find('ul.lang_menu>li').click(function(){
        $('#mobile_nav').css({'z-index': '-1','opacity': '0'});
    });
})();

