<?php
/**
 * Created by IntelliJ IDEA.
 * User: soldi
 * Date: 05-10-16
 * Time: 20:59
 */

namespace Oz;


class JsonResponse
{
    public $error;
    public $message;

    public function __construct($error, $message) {
        $this->error = $error;
        $this->message = $message;
    }

}