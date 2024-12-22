# app-skeleton
The skeleton application for the alpha-zeta framework.

## Installation
1. `mkdir <your_root_project_folder>`
2. `cd <your_root_project_folder>`
3. `curl -L https://api.github.com/repos/JackRabbit911/app-skeleton/zipball/master > skeleton.zip`
4. `unzip skeleton.zip`
5. `mv JackRabbit911-app-skeleton* site.zone`
6. `rm skeleton.zip`
7. `cd site.zone` Here You need php ^8.2 cli and composer or composer.phar
8. `mkdir -p -m=777 storage storage/logs storage/sessions storage/uploads`
9. `composer require alpha-zeta/framework`
10. Edit Your .env and .gitignore files
11. Go to <your_root_project_folder> (`cd ../`)
12. Open repository: `https://github.com/JackRabbit911/Docker_php8.2`  
and follow the instructions to install the docker container.
13.  Up the container (`docker compose up -d` or `docker-compose up -d`)
14.  Open `http://localhost`, check page.
15.  Go to the UserGuide page for more useful information.

## Happy framework usage!
