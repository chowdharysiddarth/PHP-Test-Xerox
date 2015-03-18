<?php

abstract class MasterService {

    abstract protected function getCommitCount($username, $password, $repositoryName, $contributorUserName);
}
