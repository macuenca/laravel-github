<?php

namespace App\Http\Controllers;

use App\Helpers\RevisionControlServiceInterface;
use Illuminate\Http\Request;

class GitHubController extends Controller
{
    protected $githubService;

    /**
     * @param RevisionControlServiceInterface $gitHubService
     */
    public function __construct(RevisionControlServiceInterface $gitHubService)
    {
        $this->githubService = $gitHubService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        if (!$request->session()->has('github_token')) {
            return view('github/index');
        }

        return $this->repos($request);
    }

    /**
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function auth(Request $request)
    {
        $this->validate($request, [
            'token' => 'required|min:32',
        ]);

        $request->session()->set('github_token', $request->token);

        return $this->repos($request);
    }

    /**
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function repos(Request $request)
    {
        $authToken = $request->session()->get('github_token');
        $this->githubService->setAuthToken($authToken);
        $data = $this->githubService->getRepositories();

        return view('github/repos', ['repositoryData' => $data]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function issues(Request $request)
    {
        $authToken = $request->session()->get('github_token');
        $this->githubService->setAuthToken($authToken);

        $repoData = $this->githubService->getRepository($request->uri);
        $issuesData = $this->githubService->getIssues($request->uri);

        return view('github/issues', ['repoData' => $repoData, 'issueData' => $issuesData]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        $request->session()->clear();

        return redirect('/');
    }
}
