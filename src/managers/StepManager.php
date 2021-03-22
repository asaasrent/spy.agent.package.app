<?php


namespace SpyAgent\managers;

use SpyAgent\exceptions\StepNotFoundException;
use SpyAgent\SpyAgent;

class StepManager
{
    public function trackStep($stepName, array $payload)
    {
        $acceptanceCriteria = SpyAgent::$activeProcess->getAcceptanceCriteria();
        if (!in_array($stepName, $acceptanceCriteria)) {
            throw new StepNotFoundException();
        }
        $attributes = $payload;
        $attributes["name"] = $stepName;
        $stepCollection = SpyAgent::$firestoreInstance
            ->collection('systems/' . SpyAgent::$selectedSystem .
                '/processes/' . SpyAgent::$currentProcessDocumentId . '/steps');

        $stepCollection->add($attributes);

    }
}
