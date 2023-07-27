import re
import requests
from bs4 import BeautifulSoup

# 创建一个会话对象
session = requests.Session()

# 发送一个 POST 请求，并自动处理重定向
response = session.post('http://192.168.157.138:8000/login.php', data={'username': "2112", 'password': 'free'})

# 打印响应的文本内容
#print(response.text)

# 发送一个 GET 请求，并自动处理重定向
response = session.get('http://192.168.157.138:8000/personal.php')

response.encoding = 'utf8'
outcome = response.text.encode('gbk', 'ignore').decode('gbk')
soup = BeautifulSoup(outcome, 'html.parser')
flag = None
for tag in soup.find_all('p', {'class': 'info_show'}):

    pattern = r'flag\{[^\}]+\}'
    matches = re.findall(pattern, tag.text)
    if(matches):
        for match in matches:
            print(match)
