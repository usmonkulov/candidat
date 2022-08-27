<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii 2 Framework yordamida proyekt</h1>
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
        git clone https://github.com/usmonkulov/candidate.git candidate <br>
        sudo cp .env.example .env <br>
    </p>    
    <br>
     <p>
        O'rnatish <br>
        sudo docker-compose build <br>
        Loyihani ko'tarish (Yoqish) <br>
        sudo docker-compose up -d <br>
        Loyihani yiqitish (O'chirish) <br>
        sudo docker-compose up -d <br>
    </p>    
    <p>
        Containerning ichiga kiramiz <br>
        sudo docker-compose ps (candidate_php-cli_1) <br>
        sudo docker exec -it candidate_php-cli_1 bash (container ichiga kirdik)<br>
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
        <img src="readme/2.png" height="400px">
        sudo chmod -R 777 api/runtime <br>
        <a href="http://localhost:8021">localhost:8021 (Endi adminkaga kirsak bo'ladi)</a> <br>
    </p>
</p>

DIRECTORY STRUCTURE
-------------------

```
common
    config/              contains shared configurations
    mail/                contains view files for e-mails
    models/              contains model classes used in both backend and frontend
    tests/               contains tests for common classes    
console
    config/              contains console configurations
    controllers/         contains console controllers (commands)
    migrations/          contains database migrations
    models/              contains console-specific model classes
    runtime/             contains files generated during runtime
backend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains backend configurations
    controllers/         contains Web controller classes
    docker/              docker uchun nginx sozlamalar
    models/              contains backend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for backend application    
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
frontend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains frontend configurations
    controllers/         contains Web controller classes
    docker/              docker uchun nginx sozlamalar
    models/              contains frontend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for frontend application
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
    widgets/             contains frontend widgets
api
    config/              contains backend configurations
    controllers/         contains Web controller classes
    docker/              docker uchun nginx sozlamalar
    models/              contains backend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for backend application    
    web/                 contains the entry script and Web resources
candidate
    entities/            Baza bilan bog'lanish uchun model
    forms/               formalar uchun
    readModels/          asosan gridviewlar uchun
    repositories/        faqat bazaga beriladigan so'rovlar shu yerda
    services/            qanaqadir servislar shu yerda 
    status/              holati uchun statik status bo'ladi 
vendor/                  contains dependent 3rd-party packages
environments/            contains environment-based overrides

Postgres Uchun sozlama
'db' => [
    `'class' => 'yii\db\Connection',
    'dsn' => 'pgsql:host=localhost;port=port_number;dbname=database_name',
    'username' => 'postgres',
    'password' => '123456',
    'charset' => 'utf8',
    'schemaMap' => [
        'pgsql'=> [
            'class'=>'yii\db\pgsql\Schema',
            //specify your schema here
            'defaultSchema' => 'public'
        ]
    ],
],`
```

