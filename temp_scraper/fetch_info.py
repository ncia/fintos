import urllib.request
import json
import re
from bs4 import BeautifulSoup

url = 'https://insure153.com/%EC%88%98%EC%88%A0%EB%AA%85-%EA%B2%80%EC%83%89/'
headers = {'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)'}

req = urllib.request.Request(url, headers=headers)
html = urllib.request.urlopen(req).read().decode('utf-8')

print("Page fetched.")
print("wpDataTables in HTML:", 'wpDataTables' in html)

soup = BeautifulSoup(html, 'html.parser')
tables = soup.find_all('table')
print(f"Found {len(tables)} tables.")

for t in tables:
    print("Table ID:", t.get('id', 'N/A'), "Class:", t.get('class', []))

# Let's see if there's any wpDataTables configuration json
match = re.search(r'wpDataTables\.config_\d+\s*=\s*(\{.*?\});', html, re.DOTALL)
if match:
    print("Found wpDataTables config.")
    config = json.loads(match.group(1))
    if 'ajax' in config and config['ajax']:
        print("Ajax URL:", config['ajax']['url'])
    else:
        print("No ajax URL found in config.")
else:
    print("No wpdt config found.")
    
# Let's also save the HTML for debugging
with open('debug_insure153.html', 'w', encoding='utf-8') as f:
    f.write(html)
