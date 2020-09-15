<?php

namespace Src\Traits;

use Exception;

/**
 *
 * @Schema(
 *   schema="meta",
 *   type="object",
 *   allOf={
 *       @Schema(
 *          @Property (property= "msg", type="string"),
 *          @Property (property= "status", type="string"),
 *       )
 *   }
 * )
 *
 * Trait ApiResponse
 * @package Src\Traits
 */

trait ApiResponse
{

    protected $httpCode;
    protected $meta = [];
    protected $data = null;


    /**
     * @param $data
     * @param array $meta
     * @return $this
     * @throws Exception
     */
    public function setMetaData($data, array $meta = [])
    {
        if ( isset($meta["msg"]) || isset($meta["status"]) )
            throw new Exception("you can't set meta[msg] or meta[status] from this method. use customResponse to set msg and status manually");
        $this->meta = $meta;
        $this->data = $data;
        return $this;
    }

    private function setMsgAndStatus($msg, $status, int $statusCode = 0)
    {
        $this->meta["msg"]       	 = $msg;
        $this->meta["status"]    	 = $status;
        $this->meta["statusCode"]    = $statusCode;
    }


    public function response()
    {
		$data = [
			'meta'      => $this->meta,
			'data'      => array_values(is_array($this->data) ? $this->data : []),
		];
        echo json_encode($data);
        return true;
    }


    public function successResponse()
    {
         $this->setMsgAndStatus('Your request Successfully handled.','Success');

         $this->httpCode = 200;
         header( 'HTTP/1.1 200 OK');


        return $this->response();
    }


    public function notFoundResponse()
    {
        $this->setMsgAndStatus('Your requested resource was not found.','Failed');

        $this->httpCode    = 404;

        return $this->response();

    }


    public function failedResponse()
    {
        $this->setMsgAndStatus('Sorry. Internal server error.','Failed');

        $this->httpCode    = 500;

        return $this->response();

    }


    public function notAuthenticatedResponse()
    {
        $this->setMsgAndStatus('Not Authenticated. Make sure your token is valid','Failed');

        $this->httpCode    = 401;

        return $this->response();

    }


    public function methodNotAllowedHttpException()
    {
        $this->setMsgAndStatus('Method not allowed!','Failed');

        $this->httpCode    = 405;

        return $this->response();

    }


    public function notAuthorizedResponse()
    {
        $this->setMsgAndStatus('You are not authorized!','Failed');

        $this->httpCode    = 403;

        return $this->response();

    }


    public function badRequestResponse()
    {
        $this->setMsgAndStatus('The request is not in accepted format','Failed');

        $this->httpCode    = 400;

        return $this->response();

    }



    /**
     * @param string $msg
     * @param string $status
     * @param int $httpCode
     * @param int|null $statusCode
     * @param null $data
     * @return
     */
    public function customResponse(string $msg, string $status, int $httpCode, int $statusCode = 0,$data = [])
    {
        $this->setMsgAndStatus($msg, $status, $statusCode);

        $this->httpCode    = $httpCode;
        $this->data        = $data;

        return $this->response();

    }

}
