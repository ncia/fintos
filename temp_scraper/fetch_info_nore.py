import urllib.request
import json
import re

url = 'https://insure153.com/%EC%88%98%EC%88%A0%EB%AA%85-%EA%B2%80%EC%83%89/'
headers = {'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36'}

req = urllib.request.Request(url, headers=headers)
try:
    html = urllib.request.urlopen(req).read().decode('utf-8')
    print("Page fetched.")
    print("wpDataTables in HTML:", 'wpDataTables' in html)

    # Let's see if there's any wpDataTables configuration json
    match = re.search(r'wpDataTables\.config_\d+\s*=\s*(\{.*?\});', html, re.DOTALL)
    if match:
        print("Found wpDataTables config.")
        config = json.loads(match.group(1))
        if 'ajax' in config and config['ajax']:
            print("Ajax URL:", config['ajax']['url'])
            print("Ajax POST data (might be inside):", config['ajax'])
        else:
            print("No ajax URL found in config.")
    else:
        print("No wpdt config found.")
        # Print first few table tags if any
        tables = re.findall(r'<table.*?id="(.*?)".*?class="(.*?)".*?>', html)
        if tables:
            print("Tables found:", tables)
        else:
            print("No tables found!")
            
    with open('debug_insure153.html', 'w', encoding='utf-8') as f:
        f.write(html)
except Exception as e:
    print("Failed heavily", e)
