<?php namespace Lfelin\TraceToSlack\Facades;

use Illuminate\Support\Facades\Facade;

class TraceToSlack extends Facade {

    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'TraceToSlack';
    }

}