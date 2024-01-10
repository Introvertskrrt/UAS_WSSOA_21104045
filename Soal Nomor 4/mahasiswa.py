import requests
import json

# URL endpoint ke server PHP
url = "http://localhost/ittelkom/soap_mahasiswa.php"

# Data yang akan dikirimkan sebagai JSON payload
data = {
    "nim": "21104045",
    "password": "rizky123"
}

# Konversi data menjadi format JSON
json_data = json.dumps(data)

# Tentukan header yang sesuai
headers = {'Content-Type': 'application/json'}

# Kirim permintaan POST
response = requests.post(url, data=json_data, headers=headers)

# Cek apakah permintaan berhasil atau tidak
if response.status_code == 200:
    # Tampilkan hasil response dari server PHP
    print(response.text)
else:
    print("Gagal mengirimkan permintaan. Kode status:", response.status_code)
