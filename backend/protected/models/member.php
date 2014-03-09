<?php
class Member extends CActiveRecord {

    public function tableName() {return 'members';}
    public static function model($className=__CLASS__) {return parent::model($className);}

    public function getFullname() {
        return $this->firstname.' '.$this->lastname;
    }
}
?>