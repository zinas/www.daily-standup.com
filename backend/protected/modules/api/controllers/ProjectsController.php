<?php
class ProjectsController extends ApiController
{
    // Actions
    public function actionList() {
        $models = Project::model()->findAll();

        // Prepare response
        $rows = array();
        foreach($models as $model)
            $rows[] = $model->attributes;
        // Send the response
        $this->success($rows);
    }

    public function actionView() {
            $model = Project::model()->findByPk($_GET['id']);
            $response = array(
                'project' => $model,
                'members' => array()
            );
            foreach ($model->members as $member) {
                $response['members'][] = $member;
            }
            $this->success($response);
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