# Telegram replier bot

<h2>How to start bot</h2>
<p>Dont forget to rename .env.example to .env and set your telegram bot token</p>

``
TELEGRAM_BOT_TOKEN=""
``
<p>And then you can run next command</p>

``
docker compose up --build -d 
``

<p>This command will run few container, one for running migrations,
another one for web api, and last 3 containers is used to run background tasks
such as jobs and scheduler
</p>

<h2>Api Documentation</h2>
<p>When you successfully started all needed container, you can visit OpenApi docs</p>

``http://localhost:8000/api/documentation``

<h2>How to test code</h2>

<h3>Locally</h3>
<p>Install dependencies via composer</p>

``composer install``

<p>Run tests using laravel artisan</p>

``php artisan test``

<h3>Using docker</h3>
<p>Run tests inside app container</p>

``docker compose exec -i app php artisan test``
