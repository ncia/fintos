import json
import re

with open('debug_insure153.html', 'r', encoding='utf-8') as f:
    html = f.read()

# Find the tables
tables = re.findall(r'<table.*?id="(.*?)".*?>(.*?)</table>', html, re.DOTALL)
print(f"Found {len(tables)} tables.")

data = []

for table_id, table_content in tables:
    print(f"Parsing table {table_id}")
    
    # Extract headers
    thead_match = re.search(r'<thead.*?>(.*?)</thead>', table_content, re.DOTALL)
    headers = []
    if thead_match:
        th_tags = re.findall(r'<th.*?>(.*?)</th>', thead_match.group(1), re.DOTALL)
        for th in th_tags:
            # remove inner tags
            cl_th = re.sub(r'<.*?>', '', th).strip()
            headers.append(cl_th)
            
    print("Headers:", headers)
    
    # Extract body rows
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
                # Add which table it came from just in case
                row_data['table_id'] = table_id
                data.append(row_data)

print(f"Total extracted rows: {len(data)}")

with open('surgery_data.json', 'w', encoding='utf-8') as f:
    json.dump(data, f, ensure_ascii=False, indent=4)
    
print("Saved to surgery_data.json.")
