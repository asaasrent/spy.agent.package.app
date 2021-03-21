<?php
namespace SpyAgent;
require dirname(__DIR__, 1) . '\vendor\autoload.php';

use Kreait\Firebase\Factory;
use SpyAgent\managers\ProcessManager;
use SpyAgent\managers\StepManager;

class SpyAgent
{
    public static $firestoreInstance = null;
    public static $selectedSystem = null;
    public static $createdAt = null;
    public static $currentProcessDocumentId = null;
    public static $activeProcess = null;

    public static function init(String $keyPath , String $selectedSystem)
    {
        $factory = (new Factory())->withServiceAccount($keyPath);
        self::$firestoreInstance = $factory->createFirestore()->database();
        self::$selectedSystem = $selectedSystem;
        self::$createdAt = time() ;
    }

    public static function trackProcess(Process $aProcess)
    {
        $aManager = new ProcessManager();
        $aManager->trackProcess($aProcess);
    }

    public static function trackStep($stepName,Array $payload)
    {
        $aManager = new StepManager();
        $aManager->trackStep($stepName,$payload);
    }

    public static function getActiveProcess(){
        return self::$activeProcess;
    }
}
