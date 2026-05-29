import os
import glob

target_dir = r'c:\xampp\htdocs\gnu\theme\eb4_shop_020\skin\member\basic'
files = glob.glob(os.path.join(target_dir, '*.skin.html.php'))

for filepath in files:
    with open(filepath, 'r', encoding='utf-8') as f:
        content = f.read()

    original_content = content

    # 개인정보 수집ㆍ활용 동의 (필수) -> (필수) 개인정보 수집ㆍ활용 동의
    content = content.replace('개인정보 수집ㆍ활용 동의 (필수)', '(필수) 개인정보 수집ㆍ활용 동의')

    if content != original_content:
        with open(filepath, 'w', encoding='utf-8') as f:
            f.write(content)
        print(f'Updated: {os.path.basename(filepath)}')
