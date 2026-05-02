<?php
if (!defined('_GNUBOARD_')) exit;

// Composer autoload
$vendor_autoload = G5_PATH . '/vendor/autoload.php';
if (file_exists($vendor_autoload)) {
    require_once $vendor_autoload;
}

/**
 * 구글 시트에 데이터 추가
 * @param string $sheet_id : 구글 시트 ID
 * @param string $range : 시트 범위 (예: '시트1!A:I')
 * @param array $values : 추가할 데이터 배열
 */
function update_google_sheet($sheet_id, $range, $values) {
    global $g5;

    $key_file = G5_DATA_PATH . '/google_api/google_key.json';
    if (!file_exists($key_file)) {
        file_put_contents(G5_DATA_PATH.'/google_sheet_log.txt', date('Y-m-d H:i:s')." - Error: Key file not found at $key_file\n", FILE_APPEND);
        return false;
    }

    try {
        if (!class_exists('Google_Client')) {
            file_put_contents(G5_DATA_PATH.'/google_sheet_log.txt', date('Y-m-d H:i:s')." - Error: Google_Client class not found. Please check vendor/autoload.php\n", FILE_APPEND);
            return false;
        }
        $client = new \Google_Client();
        $client->setApplicationName('Fintos Google Sheet Integration');
        $client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
        $client->setAuthConfig($key_file);
        $client->setAccessType('offline');

        $service = new \Google_Service_Sheets($client);
        
        $body = new \Google_Service_Sheets_ValueRange([
            'values' => [$values]
        ]);
        
        $params = [
            'valueInputOption' => 'USER_ENTERED'
        ];
        
        $result = $service->spreadsheets_values->append($sheet_id, $range, $body, $params);
        return $result;
    } catch (Exception $e) {
        // 에러 로그 기록
        file_put_contents(G5_DATA_PATH.'/google_sheet_log.txt', date('Y-m-d H:i:s').' - Google API Error: '.$e->getMessage()."\n", FILE_APPEND);
        return false;
    }
}
?>
