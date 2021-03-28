<?php


namespace SpyAgent\managers;

use SpyAgent\exceptions\StepNotFoundException;
use SpyAgent\Process;
use SpyAgent\SpyAgent;

class ProcessManager
{

    public function trackProcess(Process $aProcess)
    {
        $attributes = $aProcess->getAttributes();
        $attributes["status"] = "pending";
        $attributes["acceptanceCriteria"] = $aProcess->getAcceptanceCriteria();
        $aDocumentReference = SpyAgent::$firestoreInstance->collection('systems')
            ->document(SpyAgent::$selectedSystem);
        $processesCollection = $aDocumentReference->collection('processes');

        SpyAgent::$currentProcessDocumentId = $processesCollection->add($attributes)->id();

        SpyAgent::$activeProcess = $aProcess;
    }
    public function setSuccess(){
        $aDocumentReference = SpyAgent::$firestoreInstance->collection('systems')
            ->document(SpyAgent::$selectedSystem);
        $processesCollection = $aDocumentReference->collection('processes');
        $processDocument = $processesCollection->document(SpyAgent::$currentProcessDocumentId);
        $processDocument->set([
            'status' => 'success'
        ], ['merge' => true]);


    }
}
