#!/bin/bash

# === Konfigurasi ===
PROJECT_DIR="/home/dika/projectpweb2"
GIT_BRANCH="main"
PHP_BINARY=$(command -v php || echo "/usr/bin/php")
COMPOSER_BINARY=$(command -v composer || echo "/usr/local/bin/composer")

# === Warna ===
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
BLUE='\033[0;34m'
NC='\033[0m'

log_info() { echo -e "${BLUE}INFO:${NC} $1"; }
log_success() { echo -e "${GREEN}SUCCESS:${NC} $1"; }
log_warning() { echo -e "${YELLOW}WARNING:${NC} $1"; }
log_error() { echo -e "${RED}ERROR:${NC} $1" >&2; }

cleanup() {
    cd "$PROJECT_DIR" || return
    if [ -f "storage/framework/down" ]; then
        log_warning "Cleanup: Menonaktifkan Maintenance Mode..."
        "$PHP_BINARY" artisan up
    fi
}
trap cleanup EXIT

# Mulai
cd "$PROJECT_DIR" || { log_error "Tidak bisa cd ke $PROJECT_DIR"; exit 1; }

log_info "[1/8] Aktifkan maintenance mode"
"$PHP_BINARY" artisan down --retry=60 || log_warning "Mungkin sudah dalam maintenance mode"

log_info "[2/8] Git reset dan pull"
git reset --hard HEAD
git clean -fd
git pull origin "$GIT_BRANCH" || { log_error "Gagal git pull"; exit 1; }

log_info "[3/8] Composer install"
"$COMPOSER_BINARY" install --optimize-autoloader --no-dev --no-interaction || { log_error "Composer gagal"; exit 1; }

log_info "[4/8] NPM build (jika ada)"
if [ -f "package.json" ]; then
    command -v npm &>/dev/null && npm ci --no-audit --no-fund && npm run build || log_warning "NPM gagal atau tidak tersedia"
else
    log_info "package.json tidak ditemukan"
fi

log_info "[5/8] Migrasi DB"
"$PHP_BINARY" artisan migrate --force || { log_error "Migrasi gagal"; exit 1; }

log_info "[6/8] Optimasi cache"
"$PHP_BINARY" artisan optimize:clear
"$PHP_BINARY" artisan config:cache
"$PHP_BINARY" artisan route:cache
"$PHP_BINARY" artisan view:cache

log_info "[7/8] Queue restart (jika pakai queue)"
"$PHP_BINARY" artisan queue:restart || log_warning "Queue tidak aktif?"

log_info "[8/8] Nonaktifkan maintenance mode"
"$PHP_BINARY" artisan up

log_success "✅ Update selesai!"
exit 0
