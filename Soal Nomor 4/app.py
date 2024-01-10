from flask import Flask, render_template, request, jsonify
import requests
import json

app = Flask(__name__)

@app.route('/')
def index():
    return render_template('mahasiswa.html')

@app.route('/login', methods=['POST'])
def login():
    nim = request.form['nim']
    password = request.form['password']

    # Data yang akan dikirimkan sebagai JSON payload
    data = {
        "nim": nim,
        "password": password
    }

    # Konversi data menjadi format JSON
    json_data = json.dumps(data)

    # Tentukan header yang sesuai
    headers = {'Content-Type': 'application/json'}

    # Kirim permintaan POST
    response = requests.post("http://localhost/ittelkom/soap_mahasiswa.php", data=json_data, headers=headers)

    # Cek apakah permintaan berhasil atau tidak
    if response.status_code == 200:
        # Tampilkan hasil response dari server PHP
        return jsonify(result=response.text)
    else:
        return jsonify(error="Gagal mengirimkan permintaan. Kode status: {}".format(response.status_code))

@app.route('/akademik')
def akademik():
    # URL endpoint ke server PHP
    php_url = "http://localhost/ittelkom/soap_akademik.php"

    # Kirim permintaan POST ke server PHP
    response = requests.post(php_url)

    # Cek apakah permintaan berhasil atau tidak
    if response.status_code == 200:
        # Mengembalikan response dari server PHP sebagai JSON
        result = response.json()
        return render_template('akademik.html', akademikList=result)
    else:
        return jsonify(error="Gagal mengirimkan permintaan. Kode status: {}".format(response.status_code))

if __name__ == '__main__':
    app.run(debug=True)
