<?php

namespace Bitbucket;

require_once 'Master.php';

class BitBucketService extends \MasterService {

    function getCommitCount($username, $password, $repositoryName, $contributorUserName) {
        $url = "https://bitbucket.org/api/1.0/repositories/$username/$repositoryName/events";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        curl_close($ch);
        $arrResult = json_decode(json_encode(json_decode($data)), true);
        if ($arrResult === NULL) {
            echo PHP_EOL . PHP_EOL . 'No response Received From The bitbucket api,Please check the parameters supplied and try again !!' . PHP_EOL . PHP_EOL;
            exit();
        }
        $count = 0;
        for ($i = 0; $i < $arrResult['count']; $i++) {
            if ($arrResult['events'][$i]['user']['username'] == $contributorUserName) {
                $count += $arrResult['events'][$i]['description']['total_commits'];
            }
        }
        echo PHP_EOL . PHP_EOL . "Total Commit Count for user $contributorUserName in Repository $repositoryName : " . $count . PHP_EOL . PHP_EOL;
    }

}
