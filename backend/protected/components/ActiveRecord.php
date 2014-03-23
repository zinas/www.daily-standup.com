<?php
class ActiveRecord extends CActiveRecord {

    public function findAllAsArray($condition='', $params=array()) {
        $items = $this->findAll($condition, $params);
        $rows = array();
        foreach($items as $item) {
            $row = $item->attributes;
            foreach ($condition['with'] as $relation) {
                    foreach ($item->getRelated($relation) as $rel) {
                        $row[$relation][] = $rel->attributes;
                    }
            }

            $rows[] = $row;
        }

        return $rows;
    }

    public function findByPkAsArray($pk, $condition='', $params=array()) {
        $item = $this->findByPk($pk, $condition, $params);

        $row = $item->attributes;
        foreach ($condition['with'] as $relation) {
                foreach ($item->getRelated($relation) as $rel) {
                    $row[$relation][] = $rel->attributes;
                }
        }

        return $row;
    }
}