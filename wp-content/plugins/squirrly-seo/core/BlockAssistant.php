<?php

class SQ_Core_BlockAssistant extends SQ_Classes_BlockController {

    public function hookGetContent(){
        echo $this->getView('Blocks/Assistant');
    }
}
