<?php
class StandupRemindersCommand extends CConsoleCommand {
    public function run($args) {
        $mail = Yii::app()->getModule('postman')->smtp;
        $projects = Project::model()->needingReminder()->findAll();
        $mail_template = $path = Yii::getPathOfAlias('postman.views').DIRECTORY_SEPARATOR.'reminder.php';

        foreach ( $projects as $project) {
            $mail->SetFrom('zinas.nikos.dev@gmail.com', 'Anakin Skywalker');
            $mail->Subject = $project->reminderTitle;

            foreach ($project->members as $member) {
                $mail->AddAddress($member->email, $member->fullname);
                $mailBody = $this->renderFile($mail_template, array(
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
}
?>