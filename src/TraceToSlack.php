<?php namespace Lfelin\TraceToSlack;

use Exception;
use Illuminate\Support\Facades\Request;
use Ixudra\Curl\Facades\Curl;

class TraceToSlack
{
    /**
     * All params for payload.
     *
     * @var array
     */
    protected $payload;

    /**
     * Webhook_url.
     *
     * @var string
     */
    protected $webhook_url;

    /**
     * $exception trace message
     *
     * @var string
     */
    protected $exception_trace_message;

    /**
     * $exception line
     *
     * @var string
     */
    protected $exception_line;

    /**
     * $exception file
     *
     * @var string
     */
    protected $exception_file;

    /**
     * $exception message
     *
     * @var string
     */
    protected $exception_message;

    /**
     * $exception class
     *
     * @var string
     */
    protected $exception_class;


    public function trace(Exception $e){
        if(self::hasWebHookUrl() && self::notifyIsEnabled()){
            // Set infos error exception
            $this->exception_trace_message = $e->getTraceAsString();
            $this->exception_line = $e->getLine();
            $this->exception_file = $e->getFile();
            $this->exception_message = $e->getMessage();
            $this->exception_class = get_class($e);
            //build
            self::build();
            //notify
            self::notify();
        }
    }

    public function notify(){
        Curl::to($this->webhook_url)
            ->withData( ["payload" => json_encode($this->payload)] )
            ->post();
    }


    public function build(){
        $this->payload = [];
        $this->payload['mrkdwn'] = true;
        $this->webhook_url = self::getTraceConfig('webhook_url');
        self::constructPayload();
        self::formatTextForPayload();
    }


    public function constructPayload(){
        $array_config = ['username'      => 'John Bot',
                         'icon_emoji'    => ':bug:',
                         'icon_url'      => null,
                         'other_channel' => null];
        foreach($array_config as $key => $value){
            $value_config = self::getTraceConfig($key);
            if(empty($value_config)){
                $value_config = $value;
            }
            $this->payload[$key] = $value_config;
            // Do not use icon_emoji if icon_url exist
            if(!empty($this->payload['icon_url'])){
                unset($this->payload['icon_emoji']);
            }
            //Filter array
            $this->payload = array_filter($this->payload);
        }
    }

    public function formatTextForPayload(){
        $text = Request::url()."\n";
        $text .= "Line ".$this->exception_line.": *".$this->exception_class."* in ".$this->exception_file."\n";
        $text .= "*".$this->exception_message."*\n\n";
        $text .= "```".$this->exception_trace_message."```";
        $this->payload['text'] = $text;
    }

    public function hasWebHookUrl(){
        return (empty(config('tracetoslack.webhook_url')) ? false : true);
    }

    public function notifyIsEnabled(){
        $app_debug = config('app.debug');
        $active_on_debug = self::getTraceConfig('active_on_debug');
        return ((!$app_debug || $active_on_debug) ? true : false);
    }

    public function getTraceConfig($key){
        return config('tracetoslack.'.$key);
    }


}
