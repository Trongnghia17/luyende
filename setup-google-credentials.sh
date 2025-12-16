#!/bin/bash

# Script để thêm Google Sheets credentials vào .env

CREDENTIALS_FILE="storage/app/google-credentials.json"
ENV_FILE=".env"

if [ ! -f "$CREDENTIALS_FILE" ]; then
    echo "❌ File $CREDENTIALS_FILE không tồn tại!"
    exit 1
fi

# Đọc và nén JSON thành 1 dòng
CREDENTIALS_JSON=$(cat "$CREDENTIALS_FILE" | tr -d '\n' | tr -d ' ')

# Kiểm tra xem đã có GOOGLE_SHEETS_CREDENTIALS trong .env chưa
if grep -q "GOOGLE_SHEETS_CREDENTIALS=" "$ENV_FILE"; then
    echo "⚠️  GOOGLE_SHEETS_CREDENTIALS đã tồn tại trong .env"
    echo "Bạn có muốn ghi đè không? (y/n)"
    read -r response
    if [[ "$response" != "y" ]]; then
        echo "Hủy bỏ."
        exit 0
    fi
    # Xóa dòng cũ
    sed -i '/GOOGLE_SHEETS_CREDENTIALS=/d' "$ENV_FILE"
fi

# Thêm credentials vào .env
echo "" >> "$ENV_FILE"
echo "# Google Sheets API Credentials" >> "$ENV_FILE"
echo "GOOGLE_SHEETS_SPREADSHEET_ID=1-bA8gpCF3OUh3gpgVO-tqV3OZU0s7uDtQ63Xa-ppWdI" >> "$ENV_FILE"
echo "GOOGLE_SHEETS_CREDENTIALS='$CREDENTIALS_JSON'" >> "$ENV_FILE"

echo "✅ Đã thêm Google Sheets credentials vào .env!"
echo ""
echo "📝 Lưu ý:"
echo "   - File .env sẽ được push lên server"
echo "   - Khi deploy, đảm bảo .env trên server có credentials này"
echo "   - Chạy: php artisan config:clear sau khi cập nhật .env"
