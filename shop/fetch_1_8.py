import urllib.request
import re
import json

url = 'https://insure153.com/1-8%ec%a2%85-%ec%88%98%ec%88%a0-%eb%b6%84%eb%a5%98%ed%91%9c/'
headers = {'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 Chrome/115.0.0.0 Safari/537.36'}
req = urllib.request.Request(url, headers=headers)
html = urllib.request.urlopen(req).read().decode('utf-8')

# Find embedded tables
tables = re.findall(r'<table.*?id="(.*?)".*?>(.*?)</table>', html, re.DOTALL)

data = []

for table_id, table_content in tables:
    thead_match = re.search(r'<thead.*?>(.*?)</thead>', table_content, re.DOTALL)
    headers = []
    if thead_match:
        th_tags = re.findall(r'<th.*?>(.*?)</th>', thead_match.group(1), re.DOTALL)
        for th in th_tags:
            cl_th = re.sub(r'<.*?>', '', th).strip()
            headers.append(cl_th)
            
    tbody_match = re.search(r'<tbody.*?>(.*?)</tbody>', table_content, re.DOTALL)
    if tbody_match:
        tr_tags = re.findall(r'<tr.*?>(.*?)</tr>', tbody_match.group(1), re.DOTALL)
        for tr in tr_tags:
            td_tags = re.findall(r'<td.*?>(.*?)</td>', tr, re.DOTALL)
            row_data = {}
            for i, td in enumerate(td_tags):
                cl_td = re.sub(r'<.*?>', '', td).strip()
                col_name = headers[i] if i < len(headers) else f'col_{i}'
                row_data[col_name] = cl_td
            if row_data:
                data.append(row_data)

# Usually the table columns are: "코드", "수술명", "종류"
# Save directly to JSON
with open('c:/xampp/htdocs/gnu/shop/surgery_1_8_data.json', 'w', encoding='utf-8') as f:
    json.dump(data, f, ensure_ascii=False, indent=4)
print("Parsed and saved 1-8 surgery data to surgery_1_8_data.json")
