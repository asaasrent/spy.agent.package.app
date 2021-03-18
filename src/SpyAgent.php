<?php


namespace SpyAgent;
require dirname(__DIR__, 1) . '\vendor\autoload.php';

use Kreait\Firebase\Factory;

class SpyAgent
{
    public static $firestore = null;
    public static $documentProcessId = null;

    public static function init($serviceAccount)
    {
        $factory = (new Factory())->withServiceAccount($serviceAccount);
        self::$firestore = $factory->createFirestore()->database();
    }

    public static function startProcess($processData = null)
    {

        $aDocumentReference = self::$firestore->collection('systems')
            ->document('PROPERTY_MANAGEMENT_SYSTEM');
        $processesCollection = $aDocumentReference->collection('processes');
        self::$documentProcessId = $processesCollection->add($processData)->id();
    }

    public static function stepCompleted($stepData = null)
    {
        $stepCollection = self::$firestore
            ->collection('systems/PROPERTY_MANAGEMENT_SYSTEM/processes/' . self::$documentProcessId . '/steps');
        $stepCollection->add($stepData);

        dd('Done');
    }
}
