$folders = @("bbs", "adm", "skin", "theme", "lib", "eyoom")
foreach ($folder in $folders) {
    if (Test-Path $folder) {
        Get-ChildItem -Path $folder -Recurse -Include *.php,*.html.php | ForEach-Object {
            $content = [System.IO.File]::ReadAllText($_.FullName)
            if ($content -match 'mb_mailling') {
                $content = $content -replace 'mb_mailling_default', 'mb_kakao_agree_default'
                $content = $content -replace 'mb_mailling_date', 'mb_kakao_agree_date'
                $content = $content -replace 'mb_mailling', 'mb_kakao_agree'
                [System.IO.File]::WriteAllText($_.FullName, $content)
                Write-Host "Updated: $($_.FullName)"
            }
        }
    }
}
