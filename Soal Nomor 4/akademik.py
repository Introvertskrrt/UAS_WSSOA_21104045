import requests
import json

# URL endpoint ke server PHP
url = "http://localhost/ittelkom/soap_akademik.php"

# Kirim permintaan POST
response = requests.post(url)

# Cek apakah permintaan berhasil atau tidak
if response.status_code == 200:
    # Tampilkan hasil response dari server PHP
    print(response.text)
else:
    print("Gagal mengirimkan permintaan. Kode status:", response.status_code)
