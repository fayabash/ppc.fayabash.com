angular.module('appDep').directive('imgResize', function (baseUrl)
{
    function link(scope, element, attrs)
    {
        /*
        var src = 'image.php?';
        var props = {
            image:'imgResize',
            width:'imgWidth',
            height:'imgHeight',
            cropratio:'imgRatio'
        };
        
        for( var prop in props )
        {
            if(attrs.hasOwnProperty(props[prop]))
            {
                if( prop == 'image' )
                {
                    src += '&'+prop+'='+escape(baseUrl + 'app/webroot/' + attrs[props[prop]]);
                }else
                {
                    src += '&'+prop+'='+attrs[props[prop]];
                }
            }
        }
        attrs.$set('src',src);
        */
       attrs.$set('src',attrs.imgResize);
    }

    return {
        restrict: 'A',
        scope: {},
        link: link
    };
});