<?php
class Project extends ActiveRecord {

    public function tableName() {return 'projects';}
    public static function model($className=__CLASS__) {return parent::model($className);}

    public function relations() {
        return array(
            'standups'=>array(self::HAS_MANY, 'Standup', 'project_id'),
            'projectMembers'=>array(self::HAS_MANY, 'Project_Member', 'project_id'),
            'members'=>array(self::HAS_MANY, 'Member', 'member_id', 'through' => 'projectMembers'),
        );
    }

    public function rules() {
        return array(
            array('name, standup_time', 'required'),
        );
    }

    /**
     * Returns a properly formatted string, to be used at the subject of the reminder email
     * @return string
     */
    public function getReminderTitle() {
        return '[Daily Standup Reminder] '.$this->name;
    }

    /**
     * Returns a properly formatted string, to be used at the subject of the report email
     * @return string
     */
    public function getReportTitle() {
        return '[Daily Standup] '.$this->name;
    }

    /**
     * Named scope to filter all the projects that are due to send reminders to their members
     *
     * @return array array of Projects
     */
    public function needingReminder() {
        $from = date('H:i:s', time()-5*60*60);
        $to = date('H:i:s', time()+15*60);

        $this->getDbCriteria()->mergeWith(array(
            'condition'=>'last_reminder <> :today AND standup_time BETWEEN :from AND :to',
            'params'=>array(':from'=>$from, ':to'=>$to, ':today'=>date('Y-m-d')),
        ));
        return $this;
    }

    /**
     * Named scope to filter all the projects that are due to send the daily report to their members
     *
     * @return array array of Projects
     */
    public function needingReport() {
        $from = date('H:i:s', time()-5*60*60);
        $to = date('H:i:s', time()+15*60);

        $this->getDbCriteria()->mergeWith(array(
            'condition'=>'last_report <> :today AND standup_time BETWEEN :from AND :to',
            'params'=>array(':from'=>$from, ':to'=>$to, ':today'=>date('Y-m-d')),
        ));
        return $this;
    }
}
?>