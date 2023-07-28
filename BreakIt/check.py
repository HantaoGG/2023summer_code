# -*- coding:utf8 -*-
import sys
import re
from requests import *
import pymysql

#除了返回的正常/错误，其余不输出任何信息，且需要设置超时时间！
# 检查登陆页面 SQL注入漏洞
def check1(url):
    try:
        sub_url = url + "/index.html"
        res = get(sub_url, timeout=10)
        if res.status_code == 200 and "CUC" in res.text:
            return True
        else:
            return False
    except Exception as e:
        raise Exception("Check1 error, 登陆页面存在错误...") from e
# 检查文件上传页面 文件上传漏洞
def check2(url):
    try:
        sub_url = url + "/form.php"
        res = get(sub_url, timeout=10)
        if res.status_code == 200 and "请先登录!" in res.text and "upload" in res.text:
            return True
        else:
            return False
    except Exception as e:
        raise Exception("Check2 error, 文件上传页面存在异常...") from e
# 检查新建文章页面 XSS漏洞
def check3(url):
    try:
        sub_url = url + "/new_article.html"
        res = get(sub_url, timeout=10)
        #print(res.text)
        if res.status_code == 200 and "title" in res.text:
            return True
        else:
            return False
    except Exception as e:
        raise Exception("Check3 error, 新建文章页面存在异常...") from e
# 检查数据库是否正常运行
def check4(host):
    try:
        conn = pymysql.connect(host='192.168.157.138', port=int("9906"), user="MYSQL_USER", password="MYSQL_PASSWORD", database="blog")
        with conn.cursor() as cursor:
            cursor.execute("SELECT 1")
            result = cursor.fetchone()
            # 如果查询结果为 1，则认为数据库正常运行
            if result[0] == 1:
                return True
            else:
                return False
    except Exception as e:
        raise Exception("Check4 error, 数据库存在异常...") from e
def checker(host, port):
    try:
        url = "http://"+ip+":"+str(port)
        #print(url)
        if check1(url) and check2(url) and check3(url) and check4(host):
            return (True,"IP: "+host+" OK")
    except Exception as e:
        return (False, "IP: "+host+" is down, "+str(e))

if __name__ == '__main__':
    ip=sys.argv[1]
    port=int(sys.argv[2])
    print(checker(ip, port))
    
        

