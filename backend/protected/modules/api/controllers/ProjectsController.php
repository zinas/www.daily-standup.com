<?php
class ProjectsController extends ApiController
{
    // Actions
    public function actionList() {
        $projects = Project::model()
                        ->findAllAsArray(array(
                            'with' => $this->withParams
                        ));

        $this->respond(array('success'=>true, 'projects' => $projects), 200);
    }

    public function actionView($id) {
        $project = Project::model()
                        ->findByPkAsArray($id, array(
                            'with' => $this->withParams
                        ));

        $this->respond(array('success'=>true, 'project' => $project), 200);
    }

    public function actionCreate() {
        $project = new Project();
        $project->setAttributes($this->submittedData); // TODO: useSafe, after validation has been implemented

        if ($project->save()) {
            $this->respond(true, 201);
        } else {
            $this->respond(array('success'=>false, 'errors'=>$project->getErrors()), 400);
        }
    }

    public function actionUpdate($id) {
        $project = Project::model()->findByPk($id);

        if (!$project) {
            $this->error(404);
        }
        $project->setAttributes($this->submittedData); // TODO: useSafe, after validation has been implemented

        if ($project->save()) {
            $this->respond(true, 200);
        } else {
            $this->respond(array('success'=>false, 'errors'=>$project->getErrors()), 400);
        }
    }

    public function actionDelete($id) {
        $project = Project::model()->findByPk($id);

        if (!$project) {
            $this->error(404);
        }

        if ($project->delete()) {
            $this->respond(true, 200);
        } else {
            $this->respond(array('success'=>false, 'errors'=>$project->getErrors()), 400);
        }
    }

}
?>