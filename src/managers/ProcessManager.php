<?php


namespace SpyAgent\managers;

use SpyAgent\Process;
use SpyAgent\SpyAgent;

class ProcessManager
{

    public function trackProcess(Process $aProcess)
    {
        $attributes = $aProcess->getAttributes();
        $attributes["acceptanceCriteria"] = $aProcess->getAcceptanceCriteria();
        $aDocumentReference = SpyAgent::$firestoreInstance->collection('systems')
            ->document(SpyAgent::$selectedSystem);
        $processesCollection = $aDocumentReference->collection('processes');

        SpyAgent::$currentProcessDocumentId = $processesCollection->add($attributes)->id();

        SpyAgent::$activeProcess = $aProcess;
    }
}
