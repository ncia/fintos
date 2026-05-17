(function (factory) {
    if (typeof define === 'function' && define.amd) {
        define(['jquery'], factory);
    } else if (typeof module === 'object' && module.exports) {
        module.exports = factory(require('jquery'));
    } else {
        factory(window.jQuery);
    }
}(function ($) {
    $.extend($.summernote.options, {
        emoji: {
            icon: '<i class="far fa-smile"></i>',
            list: [
                "😀", "😃", "😄", "😁", "😆", "😅", "😂", "🤣", "😊", "😇", "🙂", "🙃", "😉", "😌", "😍", "🥰", "😘", "😗", "😙", "😚", "😋", "😛", "😝", "😜", "🤪", "🤨", "🧐", "🤓", "😎", "🤩", "🥳", "😏", "😒", "😞", "😔", "😟", "😕", "🙁", "☹️", "😣", "😖", "😫", "😩", "🥺", "😢", "😭", "😤", "😠", "😡", "🤬", "🤯", "😳", "🥵", "🥶", "😱", "😨", "😰", "😥", "😓", "🤗", "🤔", "🤭", "🤫", "🤥", "😶", "😐", "😑", "😬", "🙄", "😯", "😦", "😧", "😮", "😲", "🥱", "😴", "🤤", "😪", "😵", "🤐", "🥴", "🤢", "🤮", "🤧", "😷", "🤒", "🤕", "🤑", "🤠", "😈", "👿", "👹", "👺", "🤡", "👻", "💀", "☠️", "👽", "👾", "🤖", "🎃", "😺", "😸", "😻", "😼", "😽", "🙀", "😿", "😾"
            ]
        }
    });

    $.extend($.summernote.plugins, {
        'emoji': function (context) {
            var self = this;
            var ui = $.summernote.ui;
            var options = context.options.emoji;

            context.memo('button.emoji', function () {
                var button = ui.buttonGroup([
                    ui.button({
                        className: 'dropdown-toggle',
                        contents: options.icon,
                        tooltip: '이모티콘',
                        data: {
                            toggle: 'dropdown'
                        }
                    }),
                    ui.dropdown({
                        className: 'dropdown-emoji-grid-wrap',
                        contents: function () {
                            var $container = $('<div class="note-emoji-grid-container" style="width: 320px !important; padding: 10px !important; background: #fff !important; border: 1px solid #ddd !important; border-radius: 8px !important; box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;"></div>');
                            var $header = $('<div style="padding: 0 0 10px 0 !important; border-bottom: 1px solid #f0f0f0 !important; margin-bottom: 10px !important; font-size: 13px !important; font-weight: bold !important; color: #666 !important; text-align: left !important;">표정 및 감정</div>');
                            
                            // 테이블 방식 도입 (격자 고정)
                            var $table = $('<table style="width: 100% !important; border-collapse: collapse !important; table-layout: fixed !important; margin: 0 !important; padding: 0 !important; border: none !important;"></table>');
                            var $tbody = $('<tbody></tbody>');
                            $table.append($tbody);
                            
                            var cols = 7;
                            var $tr;
                            
                            $.each(options.list, function (idx, item) {
                                if (idx % cols === 0) {
                                    $tr = $('<tr style="border: none !important;"></tr>');
                                    $tbody.append($tr);
                                }
                                var $td = $('<td style="padding: 2px !important; border: none !important; text-align: center !important;"></td>');
                                var $btn = $('<button type="button" class="note-emoji-item" style="font-size: 20px !important; background: none !important; border: none !important; cursor: pointer !important; padding: 0 !important; margin: 0 !important; width: 38px !important; height: 38px !important; line-height: 38px !important; border-radius: 4px !important; display: block !important; margin: 0 auto !important; transition: background 0.15s !important; float: none !important;">' + item + '</button>');
                                
                                $btn.on('click', function (e) {
                                    e.preventDefault();
                                    context.invoke('editor.insertText', item);
                                });
                                
                                $td.append($btn);
                                $tr.append($td);
                            });
                            
                            var $scrollArea = $('<div style="max-height: 220px !important; overflow-y: auto !important; overflow-x: hidden !important; width: 100% !important;"></div>');
                            $scrollArea.append($table);
                            
                            $container.append($header).append($scrollArea);
                            return $container;
                        }
                    })
                ]);
                return button.render();
            });
        }
    });
}));
