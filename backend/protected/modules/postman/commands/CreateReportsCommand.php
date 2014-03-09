<?php
class CreateReportsCommand extends CConsoleCommand {
    public function run($args) {
        $mail = Yii::app()->getModule('postman')->smtp;
        $projects = Project::model()
            ->needingReminder()
            ->with('standups:today')
            ->with('members')
            ->findAll();

        $mail_template = $path = Yii::getPathOfAlias('postman.views').DIRECTORY_SEPARATOR.'report.php';

        foreach ($projects as $project) {
            $mail->SetFrom('zinas.nikos.dev@gmail.com', 'Anakin Skywalker');
            $mail->Subject = $project->reportTitle;

            foreach ($project->members as $member) {
                $mail->AddAddress($member->email, $member->fullname);
            }

            $mailBody = $this->renderFile($mail_template, array(
                'title' => $project->reportTitle,
                // TODO: pass more variables
            ), true);
            $mail->MsgHTML($mailBody);
            $mail->Send();

            // TODO: update report flag
        }
    }
}
?>