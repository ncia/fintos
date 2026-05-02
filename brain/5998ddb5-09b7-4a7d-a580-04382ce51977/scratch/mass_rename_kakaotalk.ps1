$folders = @("bbs", "adm", "skin", "theme", "lib", "eyoom")
foreach ($folder in $folders) {
    if (Test-Path $folder) {
        Get-ChildItem -Path $folder -Recurse -Include *.php,*.html.php | ForEach-Object {
            $content = [System.IO.File]::ReadAllText($_.FullName)
            if ($content -match 'mb_kakao_agree') {
                $content = $content -replace 'mb_kakao_agree_default', 'mb_kakaotalk_default'
                $content = $content -replace 'mb_kakao_agree_date', 'mb_kakaotalk_date'
                $content = $content -replace 'mb_kakao_agree', 'mb_kakaotalk'
                $content = $content -replace 'reg_mb_kakao_agree', 'reg_mb_kakaotalk'
                [System.IO.File]::WriteAllText($_.FullName, $content)
                Write-Host "Updated: $($_.FullName)"
            }
        }
    }
}
