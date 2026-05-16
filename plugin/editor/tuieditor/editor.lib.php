<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

/**
 * Toast UI Editor for GnuBoard
 * 이 에디터는 마크다운 입력을 지원하며, DB에는 HTML 형식으로 저장되어 기존 스킨과 호환됩니다.
 */

function editor_html($id, $content, $is_dhtml_editor=true)
{
    global $config;
    static $js = true;
    $html = "";
    
    if ($js) {
        $html .= '<link rel="stylesheet" href="https://uicdn.toast.com/editor/v2.11.0/toastui-editor.min.css" />';
        $html .= '<style>
            /* 토스트 UI 2.x 레이아웃 보정 */
            .tuieditor-container { width: 100% !important; max-width: 100% !important; min-width: 0 !important; box-sizing: border-box !important; position: relative !important; overflow: hidden !important; background-color: #fff; }
            .tui-editor-defaultUI { width: 100% !important; min-width: 0 !important; border: 1px solid #ddd !important; }
            .tui-editor-defaultUI .te-toolbar { flex-wrap: wrap !important; height: auto !important; }
            
            /* 이윰 테마 간섭 차단 */
            .textarea:has(.tuieditor-container):after, 
            .textarea:has(.tuieditor-container):before { display: none !important; }
            .textarea { padding: 0 !important; border: none !important; background: transparent !important; display: block !important; }
        </style>';
        $html .= '<script src="https://uicdn.toast.com/editor/v2.11.0/toastui-editor-all.min.js"></script>';
        $html .= '<script>var toast_editors = {};</script>';
        $js = false;
    }

    $html .= '<div class="tuieditor-container"><div id="editor_'.$id.'" class="toast-ui-editor"></div></div>';
    $html .= '<textarea id="'.$id.'" name="'.$id.'" style="display:none;">'.htmlspecialchars($content).'</textarea>';
    $html .= '<script>
    $(function() {
        toast_editors["'.$id.'"] = new toastui.Editor({
            el: document.querySelector("#editor_'.$id.'"),
            height: "400px",
            initialEditType: "wysiwyg",
            previewStyle: "vertical",
            initialValue: document.getElementById("'.$id.'").value,
            usageStatistics: false
        });
    });
    </script>';
    
    return $html;
}

// textarea 로 값을 넘긴다. javascript 반드시 필요
function get_editor_js($id, $is_dhtml_editor=true)
{
    // DB 호환성을 위해 HTML로 저장합니다. 
    // 마크다운 원본이 필요하다면 getMarkdown()을 사용하세요.
    return "if(toast_editors['{$id}']) { document.getElementById('{$id}').value = toast_editors['{$id}'].getHTML(); }\n";
}

// textarea 의 값이 비어 있는지 검사
function chk_editor_js($id, $is_dhtml_editor=true)
{
    return "if (toast_editors['{$id}'] && !toast_editors['{$id}'].getMarkdown().trim()) { alert('내용을 입력해 주십시오.'); toast_editors['{$id}'].focus(); return false; }\n";
}
?>
