import csv
import json

csv_file = r'C:\Users\ncia\Downloads\temp_dictionary.csv'
json_file = r'C:\Users\ncia\Downloads\economic_dictionary.json'

data = []
try:
    # Try cp949 first (standard Korean Windows ANSI)
    with open(csv_file, mode='r', encoding='cp949') as f:
        reader = csv.reader(f)
        for row in reader:
            if len(row) >= 3:
                # Based on the head, it seems like [Index, Category, Term, Definition] or similar
                # We want a dictionary format. Let's try to map them.
                entry = {
                    "term": row[2] if len(row) > 2 else "",
                    "definition": row[3] if len(row) > 3 else "",
                    "category": row[1] if len(row) > 1 else "일반"
                }
                # Clean up the definition (it might contain newlines or quotes)
                entry["definition"] = entry["definition"].replace('\n', ' ').strip()
                if entry["term"]:
                    data.append(entry)
except Exception as e:
    print(f"Error reading with cp949: {e}")
    # Try utf-8 as fallback
    data = []
    try:
        with open(csv_file, mode='r', encoding='utf-8') as f:
            reader = csv.reader(f)
            for row in reader:
                if len(row) >= 3:
                    entry = {
                        "term": row[2] if len(row) > 2 else "",
                        "definition": row[3] if len(row) > 3 else "",
                        "category": row[1] if len(row) > 1 else "일반"
                    }
                    entry["definition"] = entry["definition"].replace('\n', ' ').strip()
                    if entry["term"]:
                        data.append(entry)
    except Exception as e2:
        print(f"Error reading with utf-8: {e2}")

# Remove the header if it exists
if data and (data[0]["term"] == "용어" or data[0]["term"] == "Term"):
    data.pop(0)

# Save to JSON
with open(json_file, mode='w', encoding='utf-8') as f:
    json.dump(data, f, ensure_ascii=False, indent=4)

print(f"Successfully converted {len(data)} terms to JSON.")
