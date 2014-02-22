<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class ApiController extends CController
{
    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/main'
     */
    public $layout='//layouts/api';

    /**
     * Key which has to be in HTTP USERNAME and PASSWORD headers
     */
    Const APPLICATION_ID = 'DAILYSTANDUP';

    /**
     * Default response format
     * either 'json' or 'xml'
     */
    private $format = 'json';

    /**
     * Send a 200 response with the results
     * @param  mixed $response the resultset
     * @return null
     */
    public function success($response) {
        $this->__sendResponse(CJSON::encode($response), 200);
    }

    /**
     * Send a 200 response with the results
     * @param  mixed $response the resultset
     * @return null
     */
    public function error($message, $status = 500) {
        $response = $this->__constructErrorResponse($status, $message);
        $this->__sendResponse(CJSON::encode($response), $status);
    }

    /**
     * Constructs the appropriate error response, based on the status and the message
     *
     * @param  int $status  http status code
     * @param  string $message optional error message. if omitted, there is one constructed based on the $status
     * @return null
     */
    private function __constructErrorResponse($status, $message = '') {
        if (!$message) {
            switch($status) {
                case 401:
                    $message = 'You must be authorized to view this page.';
                    break;
                case 404:
                    $message = 'The requested URL ' . $_SERVER['REQUEST_URI'] . ' was not found.';
                    break;
                case 500:
                    $message = 'The server encountered an error processing your request.';
                    break;
                case 501:
                    $message = 'The requested method is not implemented.';
                    break;
            }
        }
        $signature = ($_SERVER['SERVER_SIGNATURE'] == '') ? $_SERVER['SERVER_SOFTWARE'] . ' Server at ' . $_SERVER['SERVER_NAME'] . ' Port ' . $_SERVER['SERVER_PORT'] : $_SERVER['SERVER_SIGNATURE'];
        $response = array(
            'status' => $status,
            'codeMessage' => $this->__getStatusCodeMessage($status),
            'message' => $message,
            'signature' => $signature

        );

        return $response;
    }


    /**
     * [_sendResponse description]
     * @param  integer $status       [description]
     * @param  string  $body         [description]
     * @param  string  $content_type [description]
     * @return [type]                [description]
     */
    private function __sendResponse($body, $status = 200, $content_type = 'text/html') {
        // set the status
        $status_header = 'HTTP/1.1 ' . $status . ' ' . $this->__getStatusCodeMessage($status);
        header($status_header);
        // and the content type
        header('Content-type: ' . $content_type);

        // pages with body are easy
        if($body != '') {
            // send the body
            echo $body;
        } else {
            // create some body messages
            $message = '';

            // this is purely optional, but makes the pages a little nicer to read
            // for your users.  Since you won't likely send a lot of different status codes,
            // this also shouldn't be too ponderous to maintain


            echo $body;
        }
        Yii::app()->end();
    }

    /**
     * [_getStatusCodeMessage description]
     * @param  [type] $status [description]
     * @return [type]         [description]
     */
    private function __getStatusCodeMessage($status) {
        // these could be stored in a .ini file and loaded
        // via parse_ini_file()... however, this will suffice
        // for an example
        $codes = Array(
            200 => 'OK',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            402 => 'Payment Required',
            403 => 'Forbidden',
            404 => 'Not Found',
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
        );
        return (isset($codes[$status])) ? $codes[$status] : '';
    }
}