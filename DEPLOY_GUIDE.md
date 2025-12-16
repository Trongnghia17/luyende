# Hướng dẫn deploy Google Sheets lên Server

## Bước 1: SSH vào server
```bash
ssh novateenld@luyende.novateen.vn
cd /home/novateenld/domains/luyende.novateen.vn/public_html
```

## Bước 2: Pull code mới nhất
```bash
git pull origin master
```

## Bước 3: Cài đặt dependencies (QUAN TRỌNG)
```bash
composer install --no-dev --optimize-autoloader
```

Hoặc nếu đã có composer.lock:
```bash
composer update google/apiclient
```

## Bước 4: Cập nhật file .env trên server
Đảm bảo file `.env` trên server có 2 dòng này:
```env
GOOGLE_SHEETS_SPREADSHEET_ID=1-bA8gpCF3OUh3gpgVO-tqV3OZU0s7uDtQ63Xa-ppWdI
GOOGLE_SHEETS_CREDENTIALS='{"type":"service_account","project_id":"gg-sheet-481407",...}'
```

Copy toàn bộ 2 dòng từ file `.env` local sang server.

## Bước 5: Clear cache
```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

## Bước 6: Set quyền (nếu cần)
```bash
chmod -R 755 storage bootstrap/cache
chown -R novateenld:novateenld storage bootstrap/cache
```

## Bước 7: Test
Submit form và kiểm tra:
- Database có dữ liệu
- Google Sheets có dữ liệu

## Lưu ý:
- Đảm bảo `composer.json` và `composer.lock` đã được commit và push
- Package `google/apiclient` phải có trong `composer.json`
- Server cần có PHP >= 7.4 và các extensions: json, curl, openssl
