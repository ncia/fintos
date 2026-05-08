import os

files = [
    r'c:\xampp\htdocs\gnu\theme\eb4_shop_020\shop\shop.head.html.php',
    r'c:\xampp\htdocs\gnu\theme\eb4_shop_020\head.html.php'
]

target_str = 'healthcare_dictionary.php" class="dropdown-item nav-link"><i class="fas fa-fw fa-file-medical m-r-5 text-primary"></i>의료 용어 사전</a>'
new_menu = """
                                            <li class="dropdown-submenu">
                                                <a href="<?php echo G5_SHOP_URL ?>/economy_dictionary.php" class="dropdown-item nav-link"><i class="fas fa-fw fa-chart-line m-r-5 text-success"></i>경제 용어 사전</a>
                                            </li>"""

for file_path in files:
    if not os.path.exists(file_path):
        print(f"File not found: {file_path}")
        continue
        
    with open(file_path, 'r', encoding='utf-8') as f:
        content = f.read()
    
    if 'economy_dictionary.php' in content:
        print(f"Already updated: {file_path}")
        continue
        
    # Find the closing </li> of the healthcare dictionary
    # The healthcare dictionary is inside an <li>...</li>
    # Let's find the healthcare string and then find the next </li>
    pos = content.find('healthcare_dictionary.php')
    if pos != -1:
        end_li_pos = content.find('</li>', pos)
        if end_li_pos != -1:
            insertion_pos = end_li_pos + 5
            new_content = content[:insertion_pos] + new_menu + content[insertion_pos:]
            with open(file_path, 'w', encoding='utf-8') as f:
                f.write(new_content)
            print(f"Successfully updated: {file_path}")
        else:
            print(f"Could not find closing </li> in {file_path}")
    else:
        print(f"Could not find healthcare_dictionary.php in {file_path}")
