$files = Get-ChildItem 'C:\Users\ncia\Downloads\20260507_*.xlsx'
if ($files.Count -eq 0) {
    Write-Host "Error: No matching file found"
    exit
}
$filePath = $files[0].FullName
Write-Host "Found file: $filePath"

$Excel = New-Object -ComObject Excel.Application
$Excel.Visible = $false
$Excel.DisplayAlerts = $false
try {
    $Workbook = $Excel.Workbooks.Open($filePath)
    $csvPath = 'C:\Users\ncia\Downloads\temp_dictionary.csv'
    $Workbook.SaveAs($csvPath, 6) # 6 = CSV
    $Workbook.Close($false)
    Write-Host "Success: File converted to CSV at $csvPath"
} catch {
    Write-Host "Error: $($_.Exception.Message)"
} finally {
    $Excel.Quit()
    [System.Runtime.Interopservices.Marshal]::ReleaseComObject($Excel) | Out-Null
}
