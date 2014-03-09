<?php
Yii::import('application.vendor.*');
require_once('EmailReplyParser/Parser/EmailParser.php');
require_once('EmailReplyParser/EmailReplyParser.php');

class GetStandupRepliesCommand extends CConsoleCommand {
    public function run($args) {
        $emails = Yii::app()->getModule('postman')->gmail->fetch();

        foreach ($emails as $email) {
            $projectMember = Project_Member::model()->with('member', 'project')->find(
                'project.name=:name AND member.email=:email',
                array(':name'=>$email['project'], ':email'=>$email['from'])
            );

            if ( !$projectMember->id ) continue;

            if (!$projectMember->hasDoneStandupToday) {
                $projectMember->createStandupFromMail($email);
            }
        }
    }
}
?>