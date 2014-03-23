<?php
/**
 * Base controller for all the API controllers. Takes care of sending the response in the proper format.
 */
class ApiController extends CController {

    /**
     * Sends a successful response in a json format
     *
     * @param  mixed  $response response data
     * @param  integer $code     response code
     * @return null
     */
    public function respond($response, $code = 200) {
        if ($response === true || $response === false) {
            $this->__sendResponse(CJSON::encode(array('success' => $response)), $code);
        } else {
            $this->__sendResponse(CJSON::encode($response), $code);
        }
    }

    /**
     * Responds with the proper error code
     * @param  integer $code response code
     * @return null
     */
    public function error($code = 500) {
        $this->__sendResponse(CJSON::encode(array('success' => false, 'reason' => $this->__getStatusCodeDescription($code))), $code);
    }

    /**
     * Sends the reponse to the client
     *
     * @param  string  $body         response body
     * @param  integer $status       http status code
     * @param  string  $content_type content type of the response
     * @return null
     */
    private function __sendResponse($body, $status = 200, $content_type = 'text/json') {
        // set the status
        $status_header = 'HTTP/1.1 ' . $status . ' ' . $this->__getStatusCodeMessage($status);
        header($status_header);
        // and the content type
        header('Content-type: ' . $content_type);
        echo $body;
        Yii::app()->end();
    }

    /**
     * Returns the status code message
     * @param  int $status http status code
     * @return string
     */
    private function __getStatusCodeMessage($status) {
        $codes = Array(
            // 2xx -> Success codes
            200 => 'OK',
            201 => 'Created',
            204 => 'No Content',

            // 4xx -> Client error codes
            400 => 'Bad Request',
            401 => 'Unauthorized',
            403 => 'Forbidden',
            404 => 'Not Found',
            405 => 'Method Not Allowed',

            // 5xx -> server error codes
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
        );
        return (isset($codes[$status])) ? $codes[$status] : '';
    }

    /**
     * Returns the status code message
     * @param  int $status http status code
     * @return string
     */
    private function __getStatusCodeDescription($status) {
        $codes = Array(
            // 2xx -> Success codes
            200 => 'The request was successful',
            201 => 'The item has been created successfully',
            204 => '',

            // 4xx -> Client error codes
            400 => 'There was a problem with the request data',
            401 => 'You are not authorized to view this',
            403 => 'You do not have access to this url',
            404 => 'The item you are looking for could not be found',
            405 => 'This method is not allowed',

            // 5xx -> server error codes
            500 => 'There was a problem on the server side',
            501 => 'This method is not yet implemented (but it should be)',
        );
        return (isset($codes[$status])) ? $codes[$status] : '';
    }

    /**
     * Gets the json data that were submitted by POST and decodes them
     * @return array
     */
    public function getSubmittedData() {
        return CJSON::decode(file_get_contents('php://input'),true);
    }

    /**
     * Finds the "with" attribute in the GET params and explodes it in an array
     * @return array
     */
    public function getWithParams() {
        return !is_null($_GET['with'])?explode(',', $_GET['with']):array();
    }
}