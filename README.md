# GitHub Demo Web App

[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/d/total.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

This is a demo Web App which lists your public repositories and some details about them. It is built with Laravel 5.3.

## Quick Start

Install the project and navigate to the home page. Provide a GitHub Personal Authorization Token and you're ready to go.
The token is never (permanently) stored in the server, the demo uses file sessions to interact with the API.
Make sure the scope of your Authorization Token is exclusively limited to browsing your public repositories in read-only mode.
