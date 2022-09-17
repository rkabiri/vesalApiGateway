<?php


/**
 *  ***************************************************************************************************************
 */

if (! function_exists('returnExceptionApiResponse')){
    function returnExceptionApiResponse(){
        return response()->json([
            'status'=>1001, // * CUSTOM ERROR FOR UNKNOWN ERROR
            'success'=>false,
            'data'=>[
                'msg'=>__('خطا در انجام عملیات درخواستی')
            ]
        ],500);
    }
}


if (! function_exists('getCustomValidatorErrors')){
    function getCustomValidatorErrors($errors)
    {
        $validatorErrors = [] ;
        foreach ($errors as $error){
            foreach ($error as $errorText){
                $validatorErrors[]=$errorText;
            }
        }
        return $validatorErrors;
    }
}

/**
 *  ***************************************************************************************************************
 */

