<?php
/*
** 中间件接口
 */
interface Milldeware {
    public static function handle(Closure $next);
}

/*
** 中间件具体实现
*/
class VerfiyCsrfToekn implements Milldeware {

    public static function handle(Closure $next)
    {
        echo '验证csrf Token <br>';
        $next();
    }
}

class ShowErrorsFromSession implements Milldeware {
    public static function handle(Closure $next)
    {
        echo '共享session中的Error变量 <br>';
        $next();
    }
}

class StartSession implements Milldeware {
    public static function handle(Closure $next)
    {
        echo '开启session <br>';
        $next();
        echo '关闭ession <br>';
    }
}

class AddQueuedCookieToResponse implements Milldeware {
    public static function handle(Closure $next)
    {
        $next();
        echo '添加下一次请求需要的cookie <br>';
    }
}

class EncryptCookies implements Milldeware {
    public static function handle(Closure $next)
    {
        echo '解密cookie <br>';
        $next();
        echo '加密cookie <br>';
    }
}

class CheckForMaintenacceMode implements Milldeware {
    public static function handle(Closure $next)
    {
        echo '确定当前程序是否处于维护状态 <br>';
        $next();
    }
}


/*
** 执行上面各个中间件
*/
function then() {
    //中间件类名称,作为 array_reduce 的第二个参数的一部分
    $pipes = [
        'CheckForMaintenacceMode',
        'EncryptCookies',
        'AddQueuedCookieToResponse',
        'StartSession',
        'ShowErrorsFromSession',
        'VerfiyCsrfToekn'
    ];

    //用于递归闭包的最里面一层
    $firstSlice = function() {
        echo '请求向路由传递,返回相应 <br>';
    };

    //翻转数组
    $pipes       = array_reverse($pipes);
    $callback    = array_reduce($pipes, getSlice(), $firstSlice);
    
    //执行递归闭包
    call_user_func($callback);
}

/**
** $stack是闭包 
** $pipe是$pipes数组的一个元素
*/
function getSlice() {
    // 每次调用改方法,都返回一个闭包Closure
    // array_reduce里面调用 getSlice()相当于返回了下面5行代码.
    //
    // 等价于  array_reduce($pipes, 'callback', $firstSlice);
    //
    // function callback($stack, $pipe) {
    //    return function() use($stack, $pipe){
    //        return $pipe::handle($stack);
    //    };
    // };
    // 
    // object[Closure]#Num (2){['stack']=>Closure, 'pipe'=>$pipe}
    // 
    return function($stack, $pipe) {
        return function() use($stack, $pipe){
            return $pipe::handle($stack);
        };
    };

}


then();


// 递归闭包  $callback变量的值
// 每次调用闭包 返回的都是:去执行某一个类的handle静态方法
//
//
/*Closure Object
(
    [static] => Array
        (
            [stack] => Closure Object
                (
                    [static] => Array
                        (
                            [stack] => Closure Object
                                (
                                    [static] => Array
                                        (
                                            [stack] => Closure Object
                                                (
                                                    [static] => Array
                                                        (
                                                            [stack] => Closure Object
                                                                (
                                                                    [static] => Array
                                                                        (
                                                                            [stack] => Closure Object
                                                                                (
                                                                                    [static] => Array
                                                                                        (
                                                                                            [stack] => Closure Object
                                                                                                (
                                                                                                )
                                                                                            [pipe] => VerfiyCsrfToekn
                                                                                        )
                                                                                )
                                                                            [pipe] => ShowErrorsFromSession
                                                                        )
                                                                )
                                                            [pipe] => StartSession
                                                        )
                                                )
                                            [pipe] => AddQueuedCookieToResponse
                                        )
                                )
                            [pipe] => EncryptCookies
                        )
                )
            [pipe] => CheckForMaintenacceMode
        )
)*/