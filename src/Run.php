<?php

namespace Api\Base;

class Run
{

    public function run() {

        if(array_shift($this->requestUri) !== 'api' || array_shift($this->requestUri) !== $this->apiName){
            throw new RuntimeException('API Not Found', 404);
        }
        $this->action = $this->getAction();

        if (method_exists($this, $this->action)) {
            return $this->{$this->action}();
        } else {
            throw new RuntimeException('Invalid Method', 405);
        }
    }
    //abstract protected function indexAction();
    //abstract protected function viewAction();
    //abstract protected function createAction();
    //abstract protected function updateAction();
    //abstract protected function deleteAction();
}
