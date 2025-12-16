# Hướng dẫn thiết lập Google Sheets API

## Bước 1: Tạo Google Cloud Project

1. Truy cập: https://console.cloud.google.com/
2. Tạo project mới hoặc chọn project có sẵn
3. Vào "APIs & Services" > "Enable APIs and Services"
4. Tìm và enable "Google Sheets API"

## Bước 2: Tạo Service Account

1. Vào "APIs & Services" > "Credentials"
2. Click "Create Credentials" > "Service Account"
3. Điền tên service account (vd: nova-luyende-sheets)
4. Grant quyền "Editor" hoặc "Owner"
5. Click "Done"

## Bước 3: Tạo Key JSON

1. Click vào Service Account vừa tạo
2. Vào tab "Keys"
3. Click "Add Key" > "Create new key"
4. Chọn "JSON" và download file

## Bước 4: Cài đặt vào Laravel

1. Copy file JSON vừa download
2. Đổi tên thành `google-credentials.json`
3. Paste vào folder: `/home/dell/nova/luyende/storage/app/`

## Bước 5: Chia sẻ Google Sheets

1. Mở Google Sheets của bạn
2. Click "Share"
3. Thêm email của Service Account (trong file JSON, field "client_email")
4. Chọn quyền "Editor"
5. Click "Send"

## Bước 6: Kiểm tra cấu trúc Sheet

Đảm bảo sheet "Camp 1" có các cột:
- Cột A: STT
- Cột B: Họ và tên con
- Cột C: Khối học
- Cột D: Bộ đề mình (có zalo shop hay chưa nhé?)
- Cột E: SĐT
- Cột F: Email
- Cột G: Tham gia chùa đề cùng thi hay ko?
- Cột H: Tham gia group để được chăm đề miễn phí

## Bước 7: Test

Sau khi hoàn thành các bước trên, submit form và kiểm tra:
- Dữ liệu có vào database không
- Dữ liệu có vào Google Sheets không

## Lưu ý bảo mật

- File `google-credentials.json` chứa thông tin nhạy cảm
- Đừng commit file này lên Git
- Thêm vào .gitignore:
  ```
  storage/app/google-credentials.json
  ```
