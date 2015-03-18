<?php

require_once 'GitService.php';
require_once 'BitBucketService.php';

use Github\GitService;
use Bitbucket\BitBucketService;

if (defined('STDIN')) {
    $validationMessage = '';
    $validationMessage .= (!isset($argv[1]) || strlen($argv[1]) <= 0) ? "username(1st param) missing" . PHP_EOL : '';
    $validationMessage .= (!isset($argv[2]) || strlen($argv[2]) <= 0) ? "password(2nd param) missing" . PHP_EOL : '';
    $validationMessage .= (!isset($argv[3]) || strlen($argv[3]) <= 0) ? "repositoryUrl(3rd param) missing" . PHP_EOL : '';
    $validationMessage .= (!isset($argv[4]) || strlen($argv[4]) <= 0) ? "contributorUserName(4th param) missing" . PHP_EOL : '';
    if (strlen($validationMessage) > 0) {
        echo $validationMessage;
        exit();
    }
    $choice = explode('/', $argv[3]);
    switch ($choice[2]) {
        case "github.com":
            $githubService = new GitService();
            return $githubService->getCommitCount($argv[1], $argv[2], $choice[4], $argv[4]);
        case "bitbucket.org":
            $bitbucketService = new BitBucketService();
            return $bitbucketService->getCommitCount($argv[1], $argv[2], $choice[4], $argv[4]);
        #add a case here if we want to extend the functionality			
        default:
            echo PHP_EOL . 'Invalid url supplied !!' . PHP_EOL . PHP_EOL;
            exit();
    }
} else {
    echo 'script created for command line interface !!';
}
?>