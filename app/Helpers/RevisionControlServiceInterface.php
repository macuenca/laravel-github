<?php

namespace App\Helpers;


Interface RevisionControlServiceInterface
{
    public function setAuthToken($authToken);
    public function getAuthToken();
    public function getRepositories();
    public function getRepository($uri);
    public function getIssues($uri);
}