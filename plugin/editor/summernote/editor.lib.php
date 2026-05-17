<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

function editor_html($id, $content, $is_dhtml_editor=true)
{
    global $g5, $config, $w, $board, $write;
    static $js = true;

    if( 
        $is_dhtml_editor && $content && 
        (
        (!$w && (isset($board['bo_insert_content']) && !empty($board['bo_insert_content'])))
        || ($w == 'u' && isset($write['wr_option']) && strpos($write['wr_option'], 'html') === false )
        )
    ){
        if( preg_match('/\r|\n/', $content) && $content === strip_tags($content, '<a><strong><b>') ) {
            $content = nl2br($content);
        }
    }

    $html = "";
    $html .= "<span class=\"sound_only\">웹에디터 시작</span>";

    if ($is_dhtml_editor && $js) {
        // Summernote CDN
        $html .= "\n".'<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">';
        // 부트스트랩 및 테마 충돌 수정
        $html .= "\n".'<style>
            .note-editor .dropdown-toggle::after { display: none !important; }
            .note-editor .note-editable { pointer-events: auto !important; background-color: #fff !important; }
            .note-editor.note-frame { position: relative; z-index: 1; }
            /* 이윰 테마 .textarea 클래스 내부의 에디터 보정 */
            .textarea .note-editor { margin-bottom: 0; border: none; }
            .textarea:after, .textarea:before { display: none !important; } /* 가상 레이어 제거 */
            /* 이모지 선택창 격자 레이아웃 강제 */
            .dropdown-emoji-grid-wrap { min-width: 340px !important; padding: 0 !important; border: none !important; background: transparent !important; box-shadow: none !important; }
            .note-emoji-grid-container table { border-collapse: collapse !important; width: 100% !important; table-layout: fixed !important; }
            .note-emoji-item:hover { background-color: #f0f7ff !important; transform: scale(1.1) !important; outline: 1px solid #4169e1 !important; z-index: 10; border-radius: 4px !important; }
            .dropdown-emoji-grid-wrap:before, .dropdown-emoji-grid-wrap:after { display: none !important; }
        </style>';
        $html .= "\n".'<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>';
        $html .= "\n".'<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/lang/summernote-ko-KR.min.js"></script>';
        $html .= "\n".'<script src="'.G5_EDITOR_URL.'/summernote/summernote-ext-emoji.js?v='.time().'"></script>';
        $js = false;
    }

    $summernote_class = $is_dhtml_editor ? "summernote" : "";
    $html .= "\n<textarea id=\"$id\" name=\"$id\" class=\"$summernote_class\" style=\"display:none\">$content</textarea>";
    
    if ($is_dhtml_editor) {
        $html .= "\n<script>";
        $html .= "
        $(function(){
            $('#$id').summernote({
                placeholder: '내용을 입력해주세요.',
                tabsize: 2,
                height: 300,
                lang: 'ko-KR',
                toolbar: [
                  ['style', ['style']],
                  ['font', ['bold', 'underline', 'clear']],
                  ['color', ['color']],
                  ['para', ['ul', 'ol', 'paragraph']],
                  ['table', ['table']],
                  ['insert', ['link', 'picture', 'video', 'emoji']],
                  ['view', ['fullscreen', 'codeview', 'help']]
                ],
                callbacks: {
                    onImageUpload: function(files) {
                        // GnuBoard image upload logic can be added here if needed
                    }
                }
            });
        });";
        $html .= "\n</script>";
    } else {
        $html .= "\n<style>#$id { display:block !important; width:100%; height:300px; }</style>";
    }

    $html .= "\n<span class=\"sound_only\">웹 에디터 끝</span>";
    return $html;
}

function get_editor_js($id, $is_dhtml_editor=true)
{
    if ($is_dhtml_editor) {
        return "var {$id}_editor_data = $('#{$id}').summernote('code');\nif($('#{$id}').summernote('isEmpty')){document.getElementById('{$id}').value='';}else{document.getElementById('{$id}').value = {$id}_editor_data;}\n";
    } else {
        return "var {$id}_editor = document.getElementById('{$id}');\n";
    }
}

function chk_editor_js($id, $is_dhtml_editor=true)
{
    if ($is_dhtml_editor) {
        return "if ($('#{$id}').summernote('isEmpty')) { alert(\"내용을 입력해 주십시오.\"); $('#{$id}').summernote('focus'); return false; }\n";
    } else {
        return "if (!{$id}_editor.value) { alert(\"내용을 입력해 주십시오.\"); {$id}_editor.focus(); return false; }\n";
    }
}
?>
