<?php

class SQ_Core_BlockKnowledgeBase extends SQ_Classes_BlockController {

    public function hookGetContent(){
        echo $this->getView('Blocks/KnowledgeBase');
    }
}
