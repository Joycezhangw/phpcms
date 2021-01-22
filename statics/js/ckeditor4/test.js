CKEDITOR.replace('content', {
    height: 200,
    pages: false,
    subtitle: false,
    textareaid: 'content',
    module: '',
    catid: '',
    h5upload: true,
    alowuploadexts: '',
    allowbrowser: '1',
    allowuploadnum: '10',
    authkey: 'b00210986b5e3d8dc9fdfaaaa7f53e8a',
    filebrowserUploadUrl: 'index.php?m=attachment&c=attachments&a=upload&module=&catid=&dosubmit=1',
    toolbar:
        [
            ['Source', '-', 'Templates'],
            ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'],
            ['Find', 'Replace', '-', 'SelectAll', '-', 'Scayt'],
            ['Image', 'Html5video', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe'],
            '/',
            ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat'],
            ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'],
            '/',
            ['Styles', 'Format', 'Font', 'FontSize'],
            ['TextColor', 'BGColor'],
            ['Maximize', 'ShowBlocks'],
        ]
});