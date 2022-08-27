<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii 2 Framework yordamida loyiha yaratildi</h1>
    <br>
    <b> Ubuntu 20.04.4 LTS </b>
    <br>
    <h3>Birinchi o'rinda <b>docker<b> va </b>docker-compose</b> ni o'rnatamiz</h3>
    <p>
        docker --version <br>
        Docker version 20.10.16
    </p>
    <p>
        docker-compose --version <br>
        docker-compose version 1.29.2
    </p>
    <p>
        git --version <br>
        git version 2.25.1
    </p>
    <p>
        git clone https://github.com/usmonkulov/candidat.git candidat <br>
        sudo cp .env.example .env <br>
    </p>    
    <br>
     <p>
        O'rnatish <br>
        sudo docker-compose build <br>
        Loyihani ko'tarish (Yoqish) <br>
        sudo docker-compose up -d <br>
        Loyihani yiqitish (O'chirish) <br>
        sudo docker-compose down <br>
    </p>    
    <p>
        Containerning ichiga kiramiz <br>
        sudo docker-compose ps (candidat_php-cli_1) <br>
        sudo docker exec -it candidat_php-cli_1 bash (container ichiga kirdik)<br>
        composer install <br>
        php init <br>
        [0] Development (Tanlaymiz) <br>
        yes (ni kiritamiz)
        php yii migrate <br>
        [yes] <br>
        php yii migrate <br>
        <a href="http://localhost:8022">localhost:8022 (Frontend) Urlga kiramiz va ro'yxatdan o'tamiz</a> <br>
        <img src="readme/1.png" height="400px">
    </p> <br>
    <p>
        <a href="http://localhost:8021">localhost:8021 (Backend)</a> <br> 
        <a href="http://localhost:8022">localhost:8022 (Frontend)</a> <br> 
        <a href="http://localhost:8023">localhost:8023 (Api)</a> <br> 
    </p>
    <p>
        php yii role/assign <br>
        Username: test (Ro'yxatdan o'tgan usernamengizni kiritasiz) <br>
        Role: [user,admin,?]: admin (Admin yoki User ni tanlaymiz) <br>
        Done! <br>
        exit <br>
        <img src="readme/2.png" height="100px">
        sudo chmod -R 777 api/runtime <br>
        <a href="http://localhost:8021">localhost:8021 (Endi adminkaga kirsak bo'ladi)</a> <br>
    </p>
    <p>
        <a href="http://localhost:8023">localhost:8023 (Api ni ishlatamiz birinchi quyidagi postmon collactionni import qilib oling)</a> <br>
    </p>
</p>

Fayillar strukturasi
-------------------

```
common
    auth
    bootstrap
    config
    fixtures
    mail
    tests
    widgets
console
    config
    controllers
    migrations
    models
    runtime
backend
    assets
    bootstrap
    config
    controllers
    docker
    forms
    runtime
    tests
    views
    web
    widgets
frontend
    assets
    bootstrap
    config
    controllers
    docker
    runtime
    tests
    views
    web
api
    bootstrap
    config
    controllers
    docker
    helpers
    providers
    runtime
    tests
    web
candidate
    access
    behaviors
    dispatchers
    entities
    forms
    helpers
    jobs
    readModels
    repositories
    services
    status
    useCases
vendor/                  contains dependent 3rd-party packages
environments/            contains environment-based overrides
```

