<?php
class Project extends CActiveRecord {

    public function relations() {
        return array(
            'projectMembers'=>array(self::HAS_MANY, 'Project_Member', 'project_id'),
            'members'=>array(self::HAS_MANY, 'Member', 'member_id', 'through' => 'projectMembers'),
        );
    }

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'projects';
    }
}
?>