# Setup project

1. Clone the repository.
2. Copy your .env.example file to .env.
    ```bash 
    cp .env.example .env
    ```
3. Make sure to set the correct `WWWGROUP` for your OS system in the `.env` file.
    1. For ubuntu: `1000`
    2. For MacOS: `20`

## use of sail with docker
1. Install composer packages if no composer is installed on your machine:
    ```bash
    docker run --rm \
        -u "$(id -u):$(id -g)" \
        -v "$(pwd):/var/www/html" \
        -w /var/www/html \
        laravelsail/php83-composer:latest \
        composer install --ignore-platform-reqs
    ```
2. Now that composer dependencies are installed, we can start the project.
    1. For starting the container and/or execute commands in the container, you can use the following command:
    ```bash
    ./vendor/bin/sail up -d # For starting the container via docker
    ./vendor/bin/sail artisan <command> # For executing artisan commands in the container
    ```
    2. To make your life easier, you can add the following alias to your .bashrc or .zshrc file:
       ```alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'```

3. Add a APP_KEY to your .env file
    ```bash
    ./vendor/bin/sail artisan key:generate
    ```

4. Execute your migrations with the data seeder
```bash
./vendor/bin/sail artisan migrate:fresh --seed
```

5. If Traefik is installed you application is live on: https://filament-issue.localhost
6. If you don't have Traefik installed you can access the application on: http://localhost:8080 (port depends on your .env config)

## Access the default panel (Admin)

To go to your panel you need to have an account. After that you can go to the following
URL: https://filament-issue.localhost/admin
USER: `admin@example.com`
PASS: `password`

