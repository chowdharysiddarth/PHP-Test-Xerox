<?php

namespace Github;

require_once 'Master.php';

class GitService extends \MasterService {

    public function getCommitCount($username, $password, $repositoryName, $contributorUserName) {
		$status = 202;
		while ($status == 202) {
			$url = "https://api.github.com/repos/$username/$repositoryName/stats/contributors";
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			curl_setopt($curl, CURLOPT_USERPWD, "$username:$password");
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl, CURLOPT_USERAGENT, "$username");
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
			$result = curl_exec($curl);
			$info = curl_getinfo($curl);
			curl_close($curl);
			$status = (int) $info['http_code'];
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
			if ($status != 202 )
				echo PHP_EOL . PHP_EOL . "Total Commit Count for user $contributorUserName in Repository $repositoryName : " . $count . PHP_EOL . PHP_EOL;
		}
    }

}
