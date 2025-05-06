#!/usr/bin/env bash

# ========== CONFIGURATION ==========
APP_NAME="MyCoolApp"                                  # Nama aplikasi .app kamu
DMG_FILE_NAME="${APP_NAME}-Installer.dmg"             # Nama file DMG output
VOLUME_NAME="${APP_NAME} Installer"                   # Nama volume saat DMG dibuka
SOURCE_FOLDER_PATH="build/"                           # Folder berisi .app (dan asset lainnya)

# Path ke create-dmg
CREATE_DMG="$(pwd)/test/create-dmg"

# ========== CLEANUP ==========
echo "🧹 Menghapus DMG lama jika ada..."
[[ -f "${DMG_FILE_NAME}" ]] && rm "${DMG_FILE_NAME}"

# ========== BUILD DMG ==========
echo "📦 Membuat file DMG: ${DMG_FILE_NAME}"
"${CREATE_DMG}" \
  --volname "${VOLUME_NAME}" \
  --window-pos 200 120 \
  --window-size 800 400 \
  --icon-size 100 \
  --icon "${APP_NAME}.app" 200 190 \
  --hide-extension "${APP_NAME}.app" \
  --app-drop-link 600 185 \
  "${DMG_FILE_NAME}" \
  "${SOURCE_FOLDER_PATH}"

# ========== DONE ==========
if [[ -f "${DMG_FILE_NAME}" ]]; then
  echo "✅ Sukses! File DMG tersedia di: ${DMG_FILE_NAME}"
else
  echo "❌ Gagal membuat DMG. Periksa konfigurasi dan path!"
fi

