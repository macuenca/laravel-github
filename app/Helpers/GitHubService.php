<?php

namespace App\Helpers;

use GuzzleHttp\Client;

class GitHubService implements RevisionControlServiceInterface
{
    // URI's for GitHub's API endpoints
    const URI_REPOS = 'https://api.github.com/user/repos?access_token=%s';
    const URI_ISSUES= 'https://api.github.com/user/issues?access_token=%s';

    /**
     * Fields to maintain from the repo response after sanitation
     *
     * @var array
     */
    protected $repoFields = [
        'id' => true,
        'name' => true,
        'fullname' => true,
        'html_url' => true,
        'description' => true,
        'url' => true,
        'stargazers_count' => true,
        'open_issues' => true,
    ];

    /**
     * Fields to maintain from the repo response after sanitation
     *
     * @var array
     */
    protected $issueFields = [
        'id' => true,
        'title' => true,
        'user' => true,
        'body' => true,
        'state' => true,
        'html_url' => true,
        'comments' => true,
    ];

    /**
     * Instance of the Personal Access Token
     *
     * @var string
     */
    protected $authToken;

    /**
     * @var Client
     */
    protected $httpClient;

    /**
     * Filters out all properties not present in the fields param from the JSON response
     *
     * @param string $response
     * @param array $fields
     * @return array
     */
    protected function sanitizeResponse($response, $fields)
    {
        $sanitizedResponse = [];
        $response = json_decode($response, true);

        foreach ($response as $repo) {
            $sanitizedResponse[] = array_intersect_key($repo, $fields);
        }

        return $sanitizedResponse;
    }

    /**
     * Service constructor
     */
    public function __construct()
    {
        $this->httpClient = new Client();
    }

    /**
     * @param string $authToken
     */
    public function setAuthToken($authToken)
    {
        $this->authToken = $authToken;
    }

    /**
     * @return string
     */
    public function getAuthToken()
    {
        return $this->authToken;
    }

    /**
     * @return array
     */
    public function getRepositories()
    {
        $res = $this
            ->httpClient
            ->request(
                'GET',
                sprintf(self::URI_REPOS, $this->getAuthToken())
            );

        return $this
            ->sanitizeResponse(
                (string)$res->getBody(),
                $this->repoFields
            );
    }

    /**
     * @param string $uri
     * @return array
     */
    public function getRepository($uri)
    {
        $res = $this
            ->httpClient
            ->request(
                'GET',
                sprintf('%s?access_token=%s', $uri, $this->getAuthToken())
            );

        return json_decode((string)$res->getBody(), true);
    }

    /**
     * @param string $uri
     * @return array
     */
    public function getIssues($uri)
    {
        $res = $this
            ->httpClient
            ->request(
                'GET',
                sprintf('%s/issues?access_token=%s', $uri, $this->getAuthToken())
            );

        return $this
            ->sanitizeResponse(
                (string)$res->getBody(),
                $this->issueFields
            );
    }
}