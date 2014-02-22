<?php
class MembersController extends ApiController
{
    // Actions
    public function actionList() {
        $models = Member::model()->findAll();

        // Prepare response
        $rows = array();
        foreach($models as $model)
            $rows[] = $model->attributes;
        // Send the response
        $this->success($rows);
    }

    public function actionView() {
        $model = Member::model()->findByPk($_GET['id']);
        $this->success($model);
    }

    public function actionCreate() {
        echo "this is create";
    }

    public function actionUpdate() {
        echo "this is update";
    }

    public function actionDelete() {
        echo "this is delete";
    }

}
?>