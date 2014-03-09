<?php
Yii::import('application.vendor.*');
require_once('EmailReplyParser/Parser/EmailParser.php');
require_once('EmailReplyParser/EmailReplyParser.php');

class MailController extends CController {

    public $layout='//layouts/mail';

    // Actions
    /**
     * Read the latest mails the bot has received
     * @return null
     */
    public function actionRead() {
        $emails = $this->module->gmail->fetch();

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

    public function actionReminder() {
        $mail=$this->module->smtp;

        foreach (Project::model()->findAllNeedingReminder() as $project) {
            $mail->SetFrom('zinas.nikos.dev@gmail.com', 'Anakin Skywalker');
            $mail->Subject = $project->reminderTitle;
            foreach ($project->members as $member) {
                $mail->AddAddress($member->email, $member->fullname);
                $mailBody = $this->renderPartial('/reminder', array(
                    'title' => $project->reminderTitle,
                    'firstname' => $member->firstname,
                    'lastname' => $member->lastname,
                    'projectName' => $project->name
                ), true);
                $mail->MsgHTML($mailBody);
                $mail->Send();
            }

            // TODO: Update project flag
        }
    }

    // public function actionReminder() {
    //     $mail=$this->module->smtp;

    //     foreach (Project::model()->findAllNeedingReport() as $project) {
    //         $mail->SetFrom('zinas.nikos.dev@gmail.com', 'Anakin Skywalker');
    //         $mail->Subject = $project->reminderTitle;
    //         foreach ($project->members as $member) {
    //             $mail->AddAddress($member->email, $member->fullname);
    //             $mailBody = $this->renderPartial('/report', array(
    //                 'title' => $project->reminderTitle,
    //                 'firstname' => $member->firstname,
    //                 'lastname' => $member->lastname,
    //                 'projectName' => $project->name
    //             ), true);
    //             $mail->MsgHTML($mailBody);
    //             $mail->Send();
    //         }

    //         // TODO: Update project flag
    //     }
    // }
}
?>