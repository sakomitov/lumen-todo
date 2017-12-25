<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\JsonResponse;


class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    protected $statusCode = 200;


    public function getStatusCode()

    {
        return $this->statusCode;
    }

    public function setStatusCode($statusCode)

    {
        $this->statusCode = $statusCode;
        return $this;
    }


    public function respondNotFound($message = 'Not Found!')
    {
        return $this->setStatusCode(400)->respondWithError($message);
    }

    public function respond($data, $headers=[])
    {
        return JsonResponse::create($data, $this->getStatusCode(), $headers);
    }

    public function respondWithError($message)
    {
        return $this->respond([
            'error' => $message,
            'status_code' => $this->getStatusCode()
        ]);
    }


    //
}
