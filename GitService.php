<?php

namespace Github;

require_once 'Master.php';

class GitService extends \MasterService {

    public function getCommitCount($username, $password, $repositoryName, $contributorUserName) {
        $url = "https://api.github.com/repos/$username/$repositoryName/stats/contributors";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, "$username:$password");
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_USERAGENT, "$username");
        $result = curl_exec($curl);
        curl_close($curl);
        $arrResult = json_decode(json_encode(json_decode($result)), true);
        $arrCount = count($arrResult);
        $count = 0;
        if (isset($arrResult['message'])) {
            echo PHP_EOL . PHP_EOL . $arrResult['message'] . PHP_EOL . PHP_EOL;
            exit();
        }
        for ($i = 0; $i < $arrCount; $i++) {
            if ($arrResult[$i]['author']['login'] == $contributorUserName) {
                $count = $arrResult[$i]['total'];
            }
        }
        echo PHP_EOL . PHP_EOL . "Total Commit Count for user $contributorUserName in Repository $repositoryName : " . $count . PHP_EOL . PHP_EOL;
    }

}
