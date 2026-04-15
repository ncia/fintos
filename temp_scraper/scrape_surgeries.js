const { chromium } = require('playwright');
const fs = require('fs');

(async () => {
    const browser = await chromium.launch({ headless: true });
    const page = await browser.newPage();
    await page.goto('https://insure153.com/%EC%88%98%EC%88%A0%EB%AA%85-%EA%B2%80%EC%83%89/');

    let allData = [];
    const maxPages = 90;

    for (let current_page = 1; current_page <= maxPages; current_page++) {
        console.log(`Scraping page ${current_page}...`);

        // Wait a bit to let it load and for any popups to appear
        await page.waitForTimeout(2000);

        // Check for popups
        try {
            // Dismiss ad popup if there is one (the popup in the image has a text "닫기")
            const closeX = await page.$('text="닫기"');
            if (closeX) {
                console.log('Popup found, attempting to close.');
                await closeX.click({ force: true });
                await page.waitForTimeout(1000);
            }
        } catch (e) {
            console.log('No popup or failed to close popup.', e.message);
        }

        // Try generic dismiss for iframe ads
        try {
            const iframes = page.frames();
            for (let frame of iframes) {
                const closeBtnInFrame = await frame.$('div[id^="dismiss-button"], #dismiss-button, .close-button, text="닫기"');
                if (closeBtnInFrame) {
                    await closeBtnInFrame.click({ force: true });
                    await page.waitForTimeout(1000);
                }
            }
        } catch(e) {}

        // Wait for the content table/list to be ready
        // (We assume there is a table or list of items here. If it fails, we will need to adjust the selector)
        // Let's first dump the HTML so I can analyze the exact DOM later, or just try a basic table extraction
        
        const dataOnPage = await page.evaluate(() => {
            let results = [];
            
            // Case 1: Simple table
            let rows = document.querySelectorAll('table tbody tr');
            if (rows.length > 0) {
                rows.forEach(row => {
                    let cols = row.querySelectorAll('td');
                    if (cols.length > 0) {
                        let rowData = {};
                        cols.forEach((col, i) => {
                            rowData[`col_${i}`] = col.innerText.trim();
                        });
                        results.push(rowData);
                    }
                });
            } else {
                // Case 2: Div based list
                // Try grabbing all elements that look like data items.
                // We'll collect all text from anything that looks like a row
                let divs = document.querySelectorAll('.elementor-widget-container div.row, .list-item, article');
                divs.forEach(div => {
                    results.push({ content: div.innerText.trim() });
                });
                
                // If we found nothing, let's grab the entire page text so we can see the data format if it fails
                if (results.length === 0) {
                    results.push({ raw_text_preview: document.body.innerText.substring(0, 500) });
                }
            }
            return results;
        });

        allData = allData.concat(dataOnPage);
        
        // Output partial HTML of the list on the first page to debug if needed
        if (current_page === 1) {
            const html = await page.content();
            fs.writeFileSync('page1_debug.html', html);
        }

        // Click 'Next' button
        try {
            // Need to find the Next / > / page number button
            // Usually it's something like .next, .paginate_button.next, a:has-text("Next")
            const nextButton = await page.$('.next, a.next, a:text-is("다음"), a.page-numbers:has-text("다음"), a:hover, a:has-text("›")');
            if (nextButton) {
                await nextButton.click();
            } else {
                // If there's no next button, maybe it's pagination numbers
                const nextPageNum = await page.$(`a.page-numbers:has-text("${current_page + 1}")`);
                if (nextPageNum) {
                    await nextPageNum.click();
                } else {
                    console.log('No next button found, stopping.');
                    break;
                }
            }
        } catch (e) {
             console.log('Error clicking next page:', e.message);
             break;
        }
    }

    fs.writeFileSync('../surgery_data.json', JSON.stringify(allData, null, 2));
    console.log(`Saved ${allData.length} records to surgery_data.json`);

    await browser.close();
})();
