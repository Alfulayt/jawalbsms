<?php

namespace Abdualrhmanio\JawalbSms;


use Illuminate\Support\Facades\Facade;

class JawalbSmsFacade extends Facade {

    protected static function getFacadeAccessor() {
        return 'jawalbsms';
    }

}
