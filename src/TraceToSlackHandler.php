<?php namespace Lfelin\TraceToSlack;

use Exception;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Lfelin\TraceToSlack\Facades\TraceToSlack;

class Handler extends ExceptionHandler
{

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        if(self::shouldReport($e)){
            TraceToSlack::trace($e);
        }
        return parent::report($e);
    }

}
