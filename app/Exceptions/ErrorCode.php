<?php
/**
 * Created by Jason.
 * Date: 2019/4/12
 * Time: 13:55
 */

namespace App\Exceptions;


class ErrorCode
{
    const ERROR_INTERNAL_ERROR = 10000;//内部错误
    const ERROR_AUTH_FAIL = 10001;//权限错误
    const ERROR_MISSING_PARAMETER = 10002;//参数缺失
    const ERROR_FILE_NOT_FOUND = 10003;//文件不存在
    const ERROR_INCORRECT_USERNAME_OR_PASSWORD= 10004;//账号或密码错误

}