#!/usr/bin/env bash
set -e

SERVICE="laravel.test"
COMPOSE="docker compose -f compose.yaml"

echo "============================================"
echo "📦 Pulling new image..."
echo "============================================"
$COMPOSE pull $SERVICE

echo "============================================"
echo "🛑 Stopping old containers..."
echo "============================================"
$COMPOSE down --remove-orphans

echo "============================================"
echo "🚀 Starting new containers..."
echo "============================================"
$COMPOSE up -d --scale $SERVICE=2

echo "============================================"
echo "⏳ Waiting for MySQL to be ready..."
echo "============================================"

# Wait for db container, NOT the Laravel container
for i in {1..30}; do
    docker exec day5 mysql -u"$DB_USERNAME" -p"$DB_PASSWORD" -e "select 1" && break
    echo "Waiting for DB... ($i/30)"
    sleep 2
done

echo "============================================"
echo "🧹 Clearing Laravel cache..."
echo "============================================"
$COMPOSE exec -T $SERVICE php artisan optimize:clear

echo "============================================"
echo "🗄️ Running migrations..."
echo "============================================"
$COMPOSE exec -T $SERVICE php artisan migrate --force

echo "============================================"
echo "📅 Running Laravel scheduler once..."
echo "============================================"
$COMPOSE exec -T $SERVICE php artisan schedule:run

echo "============================================"
echo "🔍 Checking logs..."
echo "============================================"
$COMPOSE logs --tail=100 $SERVICE

echo "============================================"
echo "🎉 Deployment successful!"
echo "============================================"
