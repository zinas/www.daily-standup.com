<?php
class Standup extends CActiveRecord {

    public function tableName() {return 'standups';}
    public static function model($className=__CLASS__) {return parent::model($className);}

    /**
     * Named scope to filter all the daily standups
     *
     * @return $this
     */
    public function today() {
        $this->getDbCriteria()->mergeWith(array(
            'condition'=>'report_date = :today',
            'params'=>array(':today'=>date('Y-m-d')),
        ));
        return $this;
    }
}
?>