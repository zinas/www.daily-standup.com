<?php
class Project_Member extends CActiveRecord {

    public function tableName() {return 'projects_members';}
    public static function model($className=__CLASS__) {return parent::model($className);}


    public function relations() {
        return array(
            'member'=>array(self::BELONGS_TO, 'Member', 'member_id'),
            'project'=>array(self::BELONGS_TO, 'Project', 'project_id'),
            'standups'=>array(self::HAS_MANY, 'Standup', 'project_id,member_id')
        );
    }

    public function getHasDoneStandupToday() {
        $count = Project_Member::model()->with('standups')->count('standups.report_date=:date', array(':date'=>date('Y-m-d')));

        return $count>0?true:false;
    }

    public function getTodayStandup() {
        return Project_Member::model()->with('standups')->find('standups.report_date=:date', array(':date'=>date('Y-m-d')));
    }

    public function createStandupFromMail($email) {
        $s = new Standup;
        $s->project_id = $this->project_id;
        $s->member_id = $this->member_id;
        $s->report_date = date('Y-m-d');

        $s->full_report = trim($email['body']);

        $report = explode('#', $email['body']);
        if (count($report)===3) {
            $s->did = trim($report[0]);
            $s->willdo = trim($report[1]);
            $s->blockers = trim($report[2]);
        }

        return $s->save();
    }
}
?>