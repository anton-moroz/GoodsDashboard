# Symfony Project: Dashboard of Goods for a Shop

This Symfony project is a dashboard of goods for a shop, which allows you to add, edit, and delete goods. It uses Symfony 6.1, Doctrine ORM, and Twig templating engine.
## Installation

To install this project, follow these steps:

1. Clone the repository: git clone https://github.com/anton-moroz/GoodsDashboard
2. Setup server and project data/dependencies: `make setup`

## Usage

You can log into admin account with credentials:

login: `symfony_admin`, password: `symfony_admin_password`

## Makefile

The project includes a Makefile with several commands to simplify common tasks:

    start: Start the docker containers
    stop: Stop the docker containers
    restart: Restart the docker containers
    env: Create the .env file
    chmod: Set the correct permissions on the project directory
    good: Install dependencies, compile frontend assets, create and run migrations, and load fixtures
    composer-install: Install the PHP dependencies using Composer
    migration-make: Create a new Doctrine migration
    migration-migrate: Run the Doctrine migrations
    seed: Load the fixtures using Doctrine fixtures
    cache-clear: Clear the Symfony cache
    npm-install: Install the frontend dependencies using npm
    npm-update: Update the frontend dependencies using npm
    npm-dev: Compile the frontend assets in development mode
    npm-watch: Compile the frontend assets in watch mode
    npm-prod: Compile the frontend assets in production mode
    npm-cs-check: Check the frontend code style using ESLint
    npm-cs-fix: Fix the frontend code style using ESLint
    phpcs: Check the PHP code style using PHP CodeSniffer
    phpcbf: Fix the PHP code style using PHP CodeSniffer

## Development

This project follows the PSR coding standards and uses Gitflow workflow. The master branch contains the latest stable release.

## License

This project is licensed under the MIT License. See the LICENSE file for more information.