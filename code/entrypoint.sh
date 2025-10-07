#!/bin/sh
set -e

echo "🔧 Starting Symfony entrypoint..."

# Wait for DB to be ready (with a 60s timeout)
echo "⏳ Waiting for MySQL at ${DB_HOST}:${DB_PORT}..."
timeout=60
while ! nc -z "$DB_HOST" "$DB_PORT"; do
  sleep 2
  timeout=$((timeout - 2))
  [ "$timeout" -le 0 ] && echo "❌ Timeout waiting for MySQL" && exit 1
done
echo "✅ MySQL is available."

# Build DATABASE_URL dynamically
export DATABASE_URL="mysql://${DB_USER}:${DB_PASSWORD}@${DB_HOST}:${DB_PORT}/${DB_NAME}?serverVersion=${DB_SERVER_VERSION}"
echo "🔑 DATABASE_URL: $DATABASE_URL"

# Optional: run Symfony migrations or clear cache
# echo "⚙️ Running Symfony migrations..."
# php bin/console doctrine:migrations:migrate --no-interaction --allow-no-migration || true

# echo "🧹 Clearing cache..."
# php bin/console cache:clear || true

echo "🚀 Starting main process..."
exec "$@"
