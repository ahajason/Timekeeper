<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception $exception
     * @return void
     * @throws Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof ValidationException) {
            $result = [
                "success" => false,
                "code" => $exception->status,
                //这里使用 $exception->errors() 得到验证的所有错误信息，是一个关联二维数组，所以使用了array_values()取得了数组中的值，而值也是一个数组，所以用的两个 [0][0]
                "msg" => array_values($exception->errors())[0][0],
            ];
            return response()->json($result)->setEncodingOptions(JSON_UNESCAPED_UNICODE);
        } else if (!empty($exception->getMessage()) && !empty($exception->getCode())) {
            $result = [
                "success" => false,
                "code" => $exception->getCode(),
                "msg" => $exception->getMessage(),
            ];
            return response()->json($result)->setEncodingOptions(JSON_UNESCAPED_UNICODE);
        }
        return parent::render($request, $exception);
    }
}
