<?php
Yii::import('application.vendor.*');
require_once('EmailReplyParser/Parser/EmailParser.php');
require_once('EmailReplyParser/EmailReplyParser.php');

class MailController extends CController
{
    // Actions
    /**
     * Read the latest mails the bot has received
     * @return null
     */
    public function actionRead() {
        $emails = $this->module->gmail->fetch();
        CVarDumper::dump($emails, 10, true);
    }
}
?>